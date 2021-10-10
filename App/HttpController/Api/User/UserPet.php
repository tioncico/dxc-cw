<?php

namespace App\HttpController\Api\User;

use App\Model\BaseModel;
use App\Model\Game\GoodsModel;
use App\Model\Game\UserExtraLimitModel;
use App\Model\Game\UserPetModel;
use App\Service\Game\BackpackService;
use App\Service\Game\PetService;
use App\Utility\Assert\Assert;
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
use EasySwoole\Http\Message\Status;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\Validate\Validate;

/**
 * UserPet
 * Class UserPet
 * Create With ClassGeneration
 * @ApiGroup(groupName="宠物功能")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserPet extends UserBase
{
    /**
     * @Api(name="add",path="/Api/User/UserPet/add")
     * @ApiDescription("新增数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="petId",lengthMax="11",required="")
     * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",optional="")
     * @Param(name="name",alias="宠物名称",description="宠物名称",lengthMax="255",optional="")
     * @Param(name="type",alias="宠物类型 1金2木3土4水5火6光7暗",description="宠物类型 1金2木3土4水5火6光7暗",lengthMax="255",optional="")
     * @Param(name="isUse",alias="是否携带宠物",description="是否携带宠物",lengthMax="11",optional="")
     * @Param(name="description",alias="怪物介绍",description="怪物介绍",lengthMax="255",optional="")
     * @Param(name="level",alias="怪物等级",description="怪物等级",lengthMax="11",optional="")
     * @Param(name="exp",alias="怪物经验",description="怪物经验",lengthMax="11",optional="")
     * @Param(name="isBest",alias="是否为极品宠物",description="是否为极品宠物",lengthMax="1",optional="")
     * @Param(name="hp",alias="血量",description="血量",lengthMax="11",optional="")
     * @Param(name="mp",alias="法力",description="法力",lengthMax="11",optional="")
     * @Param(name="attack",alias="攻击力",description="攻击力",lengthMax="11",optional="")
     * @Param(name="defense",alias="防御力",description="防御力",lengthMax="11",optional="")
     * @Param(name="endurance",alias="耐力",description="耐力",lengthMax="11",optional="")
     * @Param(name="intellect",alias="智力",description="智力",lengthMax="11",optional="")
     * @Param(name="strength",alias="力量",description="力量",lengthMax="11",optional="")
     * @Param(name="enduranceQualification",alias="耐力资质",description="耐力资质",lengthMax="11",optional="")
     * @Param(name="intellectQualification",alias="智力资质",description="智力资质",lengthMax="11",optional="")
     * @Param(name="strengthQualification",alias="力量资质",description="力量资质",lengthMax="11",optional="")
     * @Param(name="criticalRate",alias="暴击率",description="暴击率",lengthMax="11",optional="")
     * @Param(name="criticalStrikeDamage",alias="暴击伤害",description="暴击伤害",lengthMax="11",optional="")
     * @Param(name="hitRate",alias="命中率",description="命中率",lengthMax="11",optional="")
     * @Param(name="dodgeRate",alias="闪避率",description="闪避率",lengthMax="11",optional="")
     * @Param(name="penetrate",alias="穿透力",description="穿透力",lengthMax="11",optional="")
     * @Param(name="attackSpeed",alias="攻击速度",description="攻击速度",lengthMax="11",optional="")
     * @Param(name="userElement",alias="角色元素",description="角色元素",lengthMax="11",optional="")
     * @Param(name="attackElement",alias="攻击元素",description="攻击元素",lengthMax="11",optional="")
     * @Param(name="jin",alias="金",description="金",lengthMax="11",optional="")
     * @Param(name="mu",alias="木",description="木",lengthMax="11",optional="")
     * @Param(name="tu",alias="土",description="土",lengthMax="11",optional="")
     * @Param(name="sui",alias="水",description="水",lengthMax="11",optional="")
     * @Param(name="huo",alias="火",description="火",lengthMax="11",optional="")
     * @Param(name="light",alias="光",description="光",lengthMax="11",optional="")
     * @Param(name="dark",alias="暗",description="暗",lengthMax="11",optional="")
     */
    public function add()
    {
        $param = ContextManager::getInstance()->get('param');
        $data = [
            'petId'                  => $param['petId'],
            'userId'                 => $param['userId'] ?? '',
            'name'                   => $param['name'] ?? '',
            'type'                   => $param['type'] ?? '',
            'isUse'                  => $param['isUse'] ?? '',
            'description'            => $param['description'] ?? '',
            'level'                  => $param['level'] ?? '',
            'exp'                    => $param['exp'] ?? '',
            'isBest'                 => $param['isBest'] ?? '',
            'hp'                     => $param['hp'] ?? '',
            'mp'                     => $param['mp'] ?? '',
            'attack'                 => $param['attack'] ?? '',
            'defense'                => $param['defense'] ?? '',
            'endurance'              => $param['endurance'] ?? '',
            'intellect'              => $param['intellect'] ?? '',
            'strength'               => $param['strength'] ?? '',
            'enduranceQualification' => $param['enduranceQualification'] ?? '',
            'intellectQualification' => $param['intellectQualification'] ?? '',
            'strengthQualification'  => $param['strengthQualification'] ?? '',
            'criticalRate'           => $param['criticalRate'] ?? '',
            'criticalStrikeDamage'   => $param['criticalStrikeDamage'] ?? '',
            'hitRate'                => $param['hitRate'] ?? '',
            'dodgeRate'              => $param['dodgeRate'] ?? '',
            'penetrate'              => $param['penetrate'] ?? '',
            'attackSpeed'            => $param['attackSpeed'] ?? '',
            'userElement'            => $param['userElement'] ?? '',
            'attackElement'          => $param['attackElement'] ?? '',
            'jin'                    => $param['jin'] ?? '',
            'mu'                     => $param['mu'] ?? '',
            'tu'                     => $param['tu'] ?? '',
            'sui'                    => $param['sui'] ?? '',
            'huo'                    => $param['huo'] ?? '',
            'light'                  => $param['light'] ?? '',
            'dark'                   => $param['dark'] ?? '',
        ];
        $model = new UserPetModel($data);
        $model->save();
        $this->writeJson(Status::CODE_OK, $model->toArray(), "新增成功");
    }


    /**
     * @Api(name="update",path="/Api/User/UserPet/update")
     * @ApiDescription("更新数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
     * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
     * @Param(name="userPetId",lengthMax="11",required="")
     * @Param(name="petId",lengthMax="11",optional="")
     * @Param(name="userId",alias="用户id",description="用户id",lengthMax="11",optional="")
     * @Param(name="name",alias="宠物名称",description="宠物名称",lengthMax="255",optional="")
     * @Param(name="type",alias="宠物类型 1金2木3土4水5火6光7暗",description="宠物类型 1金2木3土4水5火6光7暗",lengthMax="255",optional="")
     * @Param(name="isUse",alias="是否携带宠物",description="是否携带宠物",lengthMax="11",optional="")
     * @Param(name="description",alias="怪物介绍",description="怪物介绍",lengthMax="255",optional="")
     * @Param(name="level",alias="怪物等级",description="怪物等级",lengthMax="11",optional="")
     * @Param(name="exp",alias="怪物经验",description="怪物经验",lengthMax="11",optional="")
     * @Param(name="isBest",alias="是否为极品宠物",description="是否为极品宠物",lengthMax="1",optional="")
     * @Param(name="hp",alias="血量",description="血量",lengthMax="11",optional="")
     * @Param(name="mp",alias="法力",description="法力",lengthMax="11",optional="")
     * @Param(name="attack",alias="攻击力",description="攻击力",lengthMax="11",optional="")
     * @Param(name="defense",alias="防御力",description="防御力",lengthMax="11",optional="")
     * @Param(name="endurance",alias="耐力",description="耐力",lengthMax="11",optional="")
     * @Param(name="intellect",alias="智力",description="智力",lengthMax="11",optional="")
     * @Param(name="strength",alias="力量",description="力量",lengthMax="11",optional="")
     * @Param(name="enduranceQualification",alias="耐力资质",description="耐力资质",lengthMax="11",optional="")
     * @Param(name="intellectQualification",alias="智力资质",description="智力资质",lengthMax="11",optional="")
     * @Param(name="strengthQualification",alias="力量资质",description="力量资质",lengthMax="11",optional="")
     * @Param(name="criticalRate",alias="暴击率",description="暴击率",lengthMax="11",optional="")
     * @Param(name="criticalStrikeDamage",alias="暴击伤害",description="暴击伤害",lengthMax="11",optional="")
     * @Param(name="hitRate",alias="命中率",description="命中率",lengthMax="11",optional="")
     * @Param(name="dodgeRate",alias="闪避率",description="闪避率",lengthMax="11",optional="")
     * @Param(name="penetrate",alias="穿透力",description="穿透力",lengthMax="11",optional="")
     * @Param(name="attackSpeed",alias="攻击速度",description="攻击速度",lengthMax="11",optional="")
     * @Param(name="userElement",alias="角色元素",description="角色元素",lengthMax="11",optional="")
     * @Param(name="attackElement",alias="攻击元素",description="攻击元素",lengthMax="11",optional="")
     * @Param(name="jin",alias="金",description="金",lengthMax="11",optional="")
     * @Param(name="mu",alias="木",description="木",lengthMax="11",optional="")
     * @Param(name="tu",alias="土",description="土",lengthMax="11",optional="")
     * @Param(name="sui",alias="水",description="水",lengthMax="11",optional="")
     * @Param(name="huo",alias="火",description="火",lengthMax="11",optional="")
     * @Param(name="light",alias="光",description="光",lengthMax="11",optional="")
     * @Param(name="dark",alias="暗",description="暗",lengthMax="11",optional="")
     */
    public function update()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserPetModel();
        $info = $model->get(['userPetId' => $param['userPetId']]);
        if (empty($info)) {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
            return false;
        }
        $updateData = [];

        $updateData['petId'] = $param['petId'] ?? $info->petId;
        $updateData['userId'] = $param['userId'] ?? $info->userId;
        $updateData['name'] = $param['name'] ?? $info->name;
        $updateData['type'] = $param['type'] ?? $info->type;
        $updateData['isUse'] = $param['isUse'] ?? $info->isUse;
        $updateData['description'] = $param['description'] ?? $info->description;
        $updateData['level'] = $param['level'] ?? $info->level;
        $updateData['exp'] = $param['exp'] ?? $info->exp;
        $updateData['isBest'] = $param['isBest'] ?? $info->isBest;
        $updateData['hp'] = $param['hp'] ?? $info->hp;
        $updateData['mp'] = $param['mp'] ?? $info->mp;
        $updateData['attack'] = $param['attack'] ?? $info->attack;
        $updateData['defense'] = $param['defense'] ?? $info->defense;
        $updateData['endurance'] = $param['endurance'] ?? $info->endurance;
        $updateData['intellect'] = $param['intellect'] ?? $info->intellect;
        $updateData['strength'] = $param['strength'] ?? $info->strength;
        $updateData['enduranceQualification'] = $param['enduranceQualification'] ?? $info->enduranceQualification;
        $updateData['intellectQualification'] = $param['intellectQualification'] ?? $info->intellectQualification;
        $updateData['strengthQualification'] = $param['strengthQualification'] ?? $info->strengthQualification;
        $updateData['criticalRate'] = $param['criticalRate'] ?? $info->criticalRate;
        $updateData['criticalStrikeDamage'] = $param['criticalStrikeDamage'] ?? $info->criticalStrikeDamage;
        $updateData['hitRate'] = $param['hitRate'] ?? $info->hitRate;
        $updateData['dodgeRate'] = $param['dodgeRate'] ?? $info->dodgeRate;
        $updateData['penetrate'] = $param['penetrate'] ?? $info->penetrate;
        $updateData['attackSpeed'] = $param['attackSpeed'] ?? $info->attackSpeed;
        $updateData['userElement'] = $param['userElement'] ?? $info->userElement;
        $updateData['attackElement'] = $param['attackElement'] ?? $info->attackElement;
        $updateData['jin'] = $param['jin'] ?? $info->jin;
        $updateData['mu'] = $param['mu'] ?? $info->mu;
        $updateData['tu'] = $param['tu'] ?? $info->tu;
        $updateData['sui'] = $param['sui'] ?? $info->sui;
        $updateData['huo'] = $param['huo'] ?? $info->huo;
        $updateData['light'] = $param['light'] ?? $info->light;
        $updateData['dark'] = $param['dark'] ?? $info->dark;
        $info->update($updateData);
        $this->writeJson(Status::CODE_OK, $info, "更新数据成功");
    }


    /**
     * @Api(name="getOne",path="/Api/User/UserPet/getOne")
     * @ApiDescription("获取一条数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="userPetId",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.userPetId",description="")
     * @ApiSuccessParam(name="result.petId",description="")
     * @ApiSuccessParam(name="result.userId",description="用户id")
     * @ApiSuccessParam(name="result.name",description="宠物名称")
     * @ApiSuccessParam(name="result.type",description="宠物类型 1金2木3土4水5火6光7暗")
     * @ApiSuccessParam(name="result.isUse",description="是否携带宠物")
     * @ApiSuccessParam(name="result.description",description="怪物介绍")
     * @ApiSuccessParam(name="result.level",description="怪物等级")
     * @ApiSuccessParam(name="result.exp",description="怪物经验")
     * @ApiSuccessParam(name="result.isBest",description="是否为极品宠物")
     * @ApiSuccessParam(name="result.hp",description="血量")
     * @ApiSuccessParam(name="result.mp",description="法力")
     * @ApiSuccessParam(name="result.attack",description="攻击力")
     * @ApiSuccessParam(name="result.defense",description="防御力")
     * @ApiSuccessParam(name="result.endurance",description="耐力")
     * @ApiSuccessParam(name="result.intellect",description="智力")
     * @ApiSuccessParam(name="result.strength",description="力量")
     * @ApiSuccessParam(name="result.enduranceQualification",description="耐力资质")
     * @ApiSuccessParam(name="result.intellectQualification",description="智力资质")
     * @ApiSuccessParam(name="result.strengthQualification",description="力量资质")
     * @ApiSuccessParam(name="result.criticalRate",description="暴击率")
     * @ApiSuccessParam(name="result.criticalStrikeDamage",description="暴击伤害")
     * @ApiSuccessParam(name="result.hitRate",description="命中率")
     * @ApiSuccessParam(name="result.dodgeRate",description="闪避率")
     * @ApiSuccessParam(name="result.penetrate",description="穿透力")
     * @ApiSuccessParam(name="result.attackSpeed",description="攻击速度")
     * @ApiSuccessParam(name="result.userElement",description="角色元素")
     * @ApiSuccessParam(name="result.attackElement",description="攻击元素")
     * @ApiSuccessParam(name="result.jin",description="金")
     * @ApiSuccessParam(name="result.mu",description="木")
     * @ApiSuccessParam(name="result.tu",description="土")
     * @ApiSuccessParam(name="result.sui",description="水")
     * @ApiSuccessParam(name="result.huo",description="火")
     * @ApiSuccessParam(name="result.light",description="光")
     * @ApiSuccessParam(name="result.dark",description="暗")
     */
    public function getOne()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserPetModel();
        $info = $model->get(['userPetId' => $param['userPetId']]);
        $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
    }

    /**
     * @Api(name="宠物上阵",path="/Api/User/UserPet/usePet")
     * @ApiDescription("宠物上阵")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="userPetId",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.userPetId",description="")
     */
    public function usePet()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserPetModel();
        $info = $model->where('userId', $this->who->userId)->get(['userPetId' => $param['userPetId']]);
        Assert::assert(!!$info, '宠物数据不存在');
        PetService::getInstance()->usePet($info);
        $this->writeJson(Status::CODE_OK, [], "上阵成功.");
    }

    /**
     * @Api(name="宠物下场",path="/Api/User/UserPet/noUsePet")
     * @ApiDescription("宠物下场")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="userPetId",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.userPetId",description="")
     */
    public function noUsePet()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserPetModel();
        $info = $model->where('userId', $this->who->userId)->get(['userPetId' => $param['userPetId']]);
        Assert::assert(!!$info, '宠物数据不存在');
        PetService::getInstance()->noUsePet($info);
        $this->writeJson(Status::CODE_OK, [], "上阵成功.");
    }

    /**
     * @Api(name="宠物分解",path="/Api/User/UserPet/decompose")
     * @ApiDescription("宠物分解")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="userPetId",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.userPetId",description="")
     */
    public function decompose()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserPetModel();
        $info = $model->where('userId', $this->who->userId)->get(['userPetId' => $param['userPetId']]);
        Assert::assert(!!$info, '宠物数据不存在');
        Assert::assert($info->isUse == 0, '已上阵宠物不能分解');
        PetService::getInstance()->decompose($info);
        $this->writeJson(Status::CODE_OK, [], "分解成功.");
    }

    /**
     * @Api(name="获取宠物进阶所需物品",path="/Api/User/UserPet/getUpClassLevelGoodsList")
     * @ApiDescription("获取宠物进阶所需物品")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="userPetId",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.userPetId",description="")
     */
    public function getUpClassLevelGoodsList()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserPetModel();
        $info = $model->where('userId', $this->who->userId)->get(['userPetId' => $param['userPetId']]);
        Assert::assert(!!$info, '宠物数据不存在');
        $data = PetService::getInstance()->getUpClassLevelNeedGoods($info);
        $this->writeJson(Status::CODE_OK, $data, "获取数据成功.");
    }

    /**
     * @Api(name="宠物进阶",path="/Api/User/UserPet/upClassLevel")
     * @ApiDescription("宠物进阶")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="userPetId",lengthMax="11",required="")
     * @ApiSuccessParam(name="result.userPetId",description="")
     */
    public function upClassLevel()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserPetModel();
        $info = $model->where('userId', $this->who->userId)->get(['userPetId' => $param['userPetId']]);
        Assert::assert(!!$info, '宠物数据不存在');
        Assert::assert($info->isUse == 0, '已上阵宠物不能进阶');
        $data = PetService::getInstance()->upClassLevel($info);
        $this->writeJson(Status::CODE_OK, $data, "进阶成功.");
    }


    /**
     * @Api(name="获取用户宠物列表",path="/Api/User/UserPet/getList")
     * @ApiDescription("获取数据列表")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
     * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
     * @Param(name="type", from={GET,POST}, description="宠物类型 1金2木3土4水5火6光7暗", optional="")
     * @Param(name="page", from={GET,POST}, alias="页数", optional="")
     * @Param(name="pageSize", from={GET,POST}, alias="每页总数", optional="")
     * @ApiSuccessParam(name="result[].userPetId",description="")
     * @ApiSuccessParam(name="result[].petId",description="")
     * @ApiSuccessParam(name="result[].userId",description="用户id")
     * @ApiSuccessParam(name="result[].name",description="宠物名称")
     * @ApiSuccessParam(name="result[].type",description="宠物类型 1金2木3土4水5火6光7暗")
     * @ApiSuccessParam(name="result[].isUse",description="是否携带宠物")
     * @ApiSuccessParam(name="result[].description",description="怪物介绍")
     * @ApiSuccessParam(name="result[].level",description="怪物等级")
     * @ApiSuccessParam(name="result[].exp",description="怪物经验")
     * @ApiSuccessParam(name="result[].isBest",description="是否为极品宠物")
     * @ApiSuccessParam(name="result[].hp",description="血量")
     * @ApiSuccessParam(name="result[].mp",description="法力")
     * @ApiSuccessParam(name="result[].attack",description="攻击力")
     * @ApiSuccessParam(name="result[].defense",description="防御力")
     * @ApiSuccessParam(name="result[].endurance",description="耐力")
     * @ApiSuccessParam(name="result[].intellect",description="智力")
     * @ApiSuccessParam(name="result[].strength",description="力量")
     * @ApiSuccessParam(name="result[].enduranceQualification",description="耐力资质")
     * @ApiSuccessParam(name="result[].intellectQualification",description="智力资质")
     * @ApiSuccessParam(name="result[].strengthQualification",description="力量资质")
     * @ApiSuccessParam(name="result[].criticalRate",description="暴击率")
     * @ApiSuccessParam(name="result[].criticalStrikeDamage",description="暴击伤害")
     * @ApiSuccessParam(name="result[].hitRate",description="命中率")
     * @ApiSuccessParam(name="result[].dodgeRate",description="闪避率")
     * @ApiSuccessParam(name="result[].penetrate",description="穿透力")
     * @ApiSuccessParam(name="result[].attackSpeed",description="攻击速度")
     * @ApiSuccessParam(name="result[].userElement",description="角色元素")
     * @ApiSuccessParam(name="result[].attackElement",description="攻击元素")
     * @ApiSuccessParam(name="result[].jin",description="金")
     * @ApiSuccessParam(name="result[].mu",description="木")
     * @ApiSuccessParam(name="result[].tu",description="土")
     * @ApiSuccessParam(name="result[].sui",description="水")
     * @ApiSuccessParam(name="result[].huo",description="火")
     * @ApiSuccessParam(name="result[].light",description="光")
     * @ApiSuccessParam(name="result[].dark",description="暗")
     */
    public function getList()
    {
        $param = ContextManager::getInstance()->get('param');
        $page = (int)($param['page'] ?? 1);
        $pageSize = (int)($param['pageSize'] ?? 99999);
        $model = new UserPetModel();
        $model->where('userId', $this->who->userId);
        if (isset($param['type'])) {
            $model->where('type', $param['type']);
        }
        $data = $model->with(['skillList'],false)->order('isUse', 'desc')->order('level', 'desc')->getList($page, $pageSize);
        $data['maxNum'] = UserExtraLimitModel::create()->getPetNum($this->who->userId);
        $data['addMaxNumGoodsList'] = [
            [
                'onceUpNum' => 5,
                'num'       => 50,
                'goodsInfo' => GoodsModel::create()->getInfoByCode('money'),
            ]
        ];

        $this->writeJson(Status::CODE_OK, $data, '获取列表成功');
    }


    /**
     * @Api(name="delete",path="/Api/User/UserPet/delete")
     * @ApiDescription("删除数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="userPetId",lengthMax="11",required="")
     */
    public function delete()
    {
        $param = ContextManager::getInstance()->get('param');
        $model = new UserPetModel();
        $info = $model->get(['userPetId' => $param['userPetId']]);
        if (!$info) {
            $this->writeJson(Status::CODE_OK, $info, "数据不存在.");
            return false;
        }
        $info->destroy();
        $this->writeJson(Status::CODE_OK, [], "删除成功.");
    }

    /**
     * @Api(name="addPetMaxNum",path="/Api/User/UserPet/addPetNum")
     * @ApiDescription("新增宠物数量上限")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"新增成功"})
     * @ApiFail({"code":400,"result":[],"msg":"新增失败"})
     * @Param(name="userPetId",lengthMax="11",required="")
     */
    public function addPetNum()
    {
        $goodsInfo = GoodsModel::create()->getInfoByCode('money');
        $goodsNum = 50;
        $info = UserExtraLimitModel::create()->getInfo($this->who->userId);
        BaseModel::transaction(function () use ($goodsInfo, $goodsNum, $info) {
            BackpackService::getInstance()->decGoods($this->who->userId, $goodsInfo, $goodsNum);
            $info->update([
                'petNum' => QueryBuilder::inc(5)
            ]);
        });

        $this->writeJson(Status::CODE_OK, ['maxNum' => $info->petNum], "扩充成功.");
    }
}

