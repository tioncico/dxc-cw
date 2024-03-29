<?php


namespace App\HttpController\Api\User;


use App\Model\BaseModel;
use App\Model\Game\UserAttributeModel;
use App\Model\Game\UserBackpackModel;
use App\Model\Game\UserBaseAttributeModel;
use App\Model\Game\UserLevelConfigModel;
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
     * @ApiSuccessParam(name="result.attribute.userId",description="")
     * @ApiSuccessParam(name="result.attribute.level",description="等级")
     * @ApiSuccessParam(name="result.attribute.exp",description="经验")
     * @ApiSuccessParam(name="result.attribute.hp",description="血量")
     * @ApiSuccessParam(name="result.attribute.mp",description="法力值")
     * @ApiSuccessParam(name="result.attribute.attack",description="攻击力")
     * @ApiSuccessParam(name="result.attribute.defense",description="防御力")
     * @ApiSuccessParam(name="result.attribute.endurance",description="耐力")
     * @ApiSuccessParam(name="result.attribute.intellect",description="智力")
     * @ApiSuccessParam(name="result.attribute.strength",description="力量")
     * @ApiSuccessParam(name="result.attribute.enduranceQualification",description="耐力资质")
     * @ApiSuccessParam(name="result.attribute.intellectQualification",description="智力资质")
     * @ApiSuccessParam(name="result.attribute.strengthQualification",description="力量资质")
     * @ApiSuccessParam(name="result.attribute.criticalRate",description="暴击率")
     * @ApiSuccessParam(name="result.attribute.criticalStrikeDamage",description="暴击伤害")
     * @ApiSuccessParam(name="result.attribute.hitRate",description="命中率")
     * @ApiSuccessParam(name="result.attribute.dodgeRate",description="闪避率")
     * @ApiSuccessParam(name="result.attribute.penetrate",description="穿透")
     * @ApiSuccessParam(name="result.attribute.attackSpeed",description="攻击速度")
     * @ApiSuccessParam(name="result.attribute.userElement",description="角色元素")
     * @ApiSuccessParam(name="result.attribute.attackElement",description="攻击元素")
     * @ApiSuccessParam(name="result.attribute.jin",description="金")
     * @ApiSuccessParam(name="result.attribute.mu",description="木")
     * @ApiSuccessParam(name="result.attribute.tu",description="土")
     * @ApiSuccessParam(name="result.attribute.sui",description="水")
     * @ApiSuccessParam(name="result.attribute.huo",description="火")
     * @ApiSuccessParam(name="result.attribute.light",description="光")
     * @ApiSuccessParam(name="result.attribute.dark",description="暗")
     * @ApiSuccessParam(name="result.attribute.luck",description="幸运值")
     * @ApiSuccessParam(name="result.attribute.physicalStrength",description="体力")
     */
    public function userInfo()
    {
        //获取用户数据
        $userAttributeInfo = UserAttributeModel::create()->get($this->who->userId);
        $userGoldInfo = UserBackpackModel::create()->getUseGoldInfo($this->who->userId);
        $userMoneyInfo = UserBackpackModel::create()->getUseMoneyInfo($this->who->userId);
        $data = [
            'attributeInfo' => $userAttributeInfo,
            'goldNum'       => $userGoldInfo->num,
            'moneyNum'      => $userMoneyInfo->num,
            'levelExpInfo'   => UserLevelConfigModel::create()->get(['level' => $userAttributeInfo->level + 1])];
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
