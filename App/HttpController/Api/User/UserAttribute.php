<?php

namespace App\HttpController\Api\User;

use App\Model\Game\UserAttributeModel;
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
use EasySwoole\Validate\Validate;

/**
 * UserAttribute
 * Class UserAttribute
 * Create With ClassGeneration
 * @ApiGroup(groupName="/Api/User.UserAttribute")
 * @ApiGroupAuth(name="")
 * @ApiGroupDescription("")
 */
class UserAttribute extends UserBase
{

	/**
	 * @Api(name="getOne",path="/Api/User/UserAttribute/getOne")
	 * @ApiDescription("获取一条数据")
	 * @Method(allow={GET,POST})
	 * @InjectParamsContext(key="param")
	 * @ApiSuccessParam(name="code",description="状态码")
	 * @ApiSuccessParam(name="result",description="api请求结果")
	 * @ApiSuccessParam(name="msg",description="api提示信息")
	 * @ApiSuccess({"code":200,"result":[],"msg":"获取成功"})
	 * @ApiFail({"code":400,"result":[],"msg":"获取失败"})
	 * @Param(name="userId",lengthMax="11",required="")
	 * @ApiSuccessParam(name="result.userId",description="")
	 * @ApiSuccessParam(name="result.level",description="等级")
	 * @ApiSuccessParam(name="result.exp",description="经验")
	 * @ApiSuccessParam(name="result.hp",description="血量")
	 * @ApiSuccessParam(name="result.mp",description="法力值")
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
	 * @ApiSuccessParam(name="result.penetrate",description="穿透")
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
	 * @ApiSuccessParam(name="result.luck",description="幸运值")
	 * @ApiSuccessParam(name="result.physicalStrength",description="体力")
	 */
	public function getOne()
	{
		$param = ContextManager::getInstance()->get('param');
		$model = new UserAttributeModel();
		$info = $model->get(['userId' => $param['userId']??$this->who()->userId]);
		if ($info) {
		    $this->writeJson(Status::CODE_OK, $info, "获取数据成功.");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '数据不存在');
		}
	}

}

