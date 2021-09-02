<?php
/**
 * Created by PhpStorm.
 * User: fushu
 * Date: 2020/8/26
 * Time: 9:32
 */

namespace App\HttpController\Api\Common;

use App\Model\Article\ArticleCategoryModel;
use App\Utility\Assert\Assert;
use EasySwoole\Http\Message\Status;
use EasySwoole\HttpAnnotation\AnnotationTag\Api;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroup;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroupAuth;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroupDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiRequestExample;
use EasySwoole\HttpAnnotation\AnnotationTag\InjectParamsContext;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiSuccess;
use EasySwoole\HttpAnnotation\AnnotationTag\Param;


/**
 * Class ArticleCategory
 * @package App\HttpController\Api\Common
 * @ApiGroup(groupName="Api.Common.ArticleCategory")
 * @ApiGroupDescription("文章分类列表")
 */
class ArticleCategory extends CommonBase
{

    /**
     * @Api(name="getAll",path="/Api/Common/ArticleCategory/getAll")
     * @ApiDescription("文章分类列表")
     * @Param(name="pid",description="父类Id",optional="")
     * @Param(name="page",description="页数",optional="")
     * @ApiSuccess({"code":200,"result":{"data":{"list":null,"total":null}},"msg":"success"})

     */
    public function getAll($pid,$page)
    {
        $model = new ArticleCategoryModel();
        $pageSize = 20;
        if($pid){
            $model->where(['pid'=>$pid]);
        }
        $data = $model->getList($page??1,$pageSize);
        $this->writeJson(Status::CODE_OK, $data, 'success');
    }
}