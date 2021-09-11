<?php


namespace App\HttpController\Api\User;


use App\Model\BaseModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserMapModel;
use App\Utility\Assert\Assert;
use EasySwoole\Http\Message\Status;
use EasySwoole\Component\Context\ContextManager;
use EasySwoole\HttpAnnotation\AnnotationTag\Api;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiFail;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroup;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroupAuth;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroupDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiRequestExample;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiSuccess;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiSuccessParam;
use EasySwoole\HttpAnnotation\AnnotationTag\InjectParamsContext;
use EasySwoole\HttpAnnotation\AnnotationTag\Method;
use EasySwoole\HttpAnnotation\AnnotationTag\Param;

/**
 * RealNameAuthentication
 * Class RealNameAuthentication
 * Create With ClassGeneration
 * @ApiGroup(groupName="游戏")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class Game extends UserBase
{
    /**
     * @Api(name="玩家信息获取",path="/Api/User/Game/userInfo")
     * @ApiDescription("玩家信息获取")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":{"attributeInfo":{"userId":1,"level":1,"name":"测试文本0aDtCM","exp":0,"hp":100,"mp":100,"attack":10,"defense":0,"endurance":0,"intellect":0,"strength":0,"enduranceQualification":1,"intellectQualification":1,"strengthQualification":1,"criticalRate":0,"criticalStrikeDamage":200,"hitRate":50,"dodgeRate":0,"penetrate":0,"attackSpeed":1,"userElement":null,"attackElement":null,"jin":0,"mu":0,"tu":0,"sui":0,"huo":0,"light":0,"dark":0,"luck":0,"physicalStrength":100},"goldNum":650,"moneyNum":0},"msg":"获取数据成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     */
    public function userInfo()
    {
        //获取用户数据
        $userAttributeInfo = UserAttributeModel::create()->getInfo($this->who->userId);
        $userGoldInfo = UserBackpackModel::create()->getUseGoldInfo($this->who->userId);
        $userMoneyInfo = UserBackpackModel::create()->getUseMoneyInfo($this->who->userId);
        $data = [
            'attributeInfo' => $userAttributeInfo,
            'goldNum'       => $userGoldInfo->num,
            'moneyNum'      => $userMoneyInfo->num,
        ];
        $this->writeJson(Status::CODE_OK, $data, "获取数据成功");
    }

    /**
     * @Api(name="创建角色",path="/Api/User/Game/add")
     * @ApiDescription("创建角色")
     * @Method(allow={GET,POST})
     * @Param(name="name",betweenMbLen={3,10},required="")
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":{"attributeInfo":{"userId":1,"level":1,"name":"测试文本0aDtCM","exp":0,"hp":100,"mp":100,"attack":10,"defense":0,"endurance":0,"intellect":0,"strength":0,"enduranceQualification":1,"intellectQualification":1,"strengthQualification":1,"criticalRate":0,"criticalStrikeDamage":200,"hitRate":50,"dodgeRate":0,"penetrate":0,"attackSpeed":1,"userElement":null,"attackElement":null,"jin":0,"mu":0,"tu":0,"sui":0,"huo":0,"light":0,"dark":0,"luck":0,"physicalStrength":100},"goldNum":650,"moneyNum":0},"msg":"创建角色成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     */
    public function add()
    {
        $param = ContextManager::getInstance()->get('param');
        //判断是否存在数据
        $userInfo = UserBaseAttributeModel::create()->get($this->who->userId);
        Assert::assert(!$userInfo, '你已创建角色');
        $userInfo = UserBaseAttributeModel::create()->get(['name' => $param['name']]);
        Assert::assert(!$userInfo, '玩家信息已存在!');

        BaseModel::transaction(function () use ($param) {
            //新增一条游戏数据
            UserBaseAttributeModel::create()->addData($this->who->userId, $param['name']);
            UserAttributeModel::create()->addData($this->who->userId, $param['name']);
            //新增玩家初始地图权限
            UserMapModel::create()->addData($this->who->userId, 1);
        });
        //获取用户数据
        $userAttributeInfo = UserAttributeModel::create()->getInfo($this->who->userId);
        $userGoldInfo = UserBackpackModel::create()->getUseGoldInfo($this->who->userId);
        $userMoneyInfo = UserBackpackModel::create()->getUseMoneyInfo($this->who->userId);
        $data = [
            'attributeInfo' => $userAttributeInfo,
            'goldNum'       => $userGoldInfo->num,
            'moneyNum'      => $userMoneyInfo->num,
        ];
        $this->writeJson(Status::CODE_OK, $data, "创建角色成功");
    }

}
