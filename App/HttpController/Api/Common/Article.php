<?php
/**
 * Created by PhpStorm.
 * User: fushu
 * Date: 2020/8/26
 * Time: 9:32
 */

namespace App\HttpController\Api\Common;

use App\HttpController\Api\Common\CommonBase;
use App\Model\Article\ArticleModel;
use App\Utility\Assert\Assert;
use EasySwoole\Component\Context\ContextManager;
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
 * Class Article
 * @package App\HttpController\Api\CommonBase
 * @ApiGroup(groupName="Api.Common.Article")
 * @ApiGroupDescription("文章列表")
 */
class Article extends CommonBase
{
    /**
     * @Api(name="getAll",path="/Api/Common/Article/getAll")
     * @ApiDescription("文章列表")
     * @Param(name="categoryId",description="分类ID",optional="")
     * @Param(name="categoryName",description="分类名字",optional="")
     * @Param(name="articleCode",description="文章code",optional="")
     * @Param(name="page",description="页数",optional="")
     * @ApiSuccess({"code":200,"result":{"data":{"list":null,"total":null}},"msg":"success"})
     */
    public function getAll($categoryId,$categoryName,$articleCode,$page)
    {
        $model = new ArticleModel();
        $pageSize = 20;
        if ($categoryId){
            $model->where(['categoryId'=>$categoryId]);
        }
        if ($categoryName){
            $model->where(['categoryName'=>$categoryName]);
        }
        if ($articleCode){
            $model->where(['articleCode'=>$articleCode]);
        }
        $data = $model->getList($page??1,$pageSize);
        $this->writeJson(Status::CODE_OK, $data, 'success');
    }
    /**
     * @Api(name="getOne",path="/Api/Common/Article/getOne")
     * @ApiDescription("获取一条文章数据")
     * @Param(name="articleId",description="文章ID",optional="")
     * @Param(name="articleCode",description="文章code",optional="")
     */
    public function getOne($articleId,$articleCode){
        $model = new ArticleModel();
        if (empty($articleCode)&&empty($articleId)){
            $this->writeJson(Status::CODE_BAD_REQUEST, '', '文章ID或文章code必须传一个');
        }
        if ($articleCode){
            $model->where(['articleCode'=>$articleCode]);
        }
        if ($articleId){
            $model->where(['articleId'=>$articleId]);
        }
        $data=$model->get();
        $this->writeJson(Status::CODE_OK, $data, 'success');
    }
}