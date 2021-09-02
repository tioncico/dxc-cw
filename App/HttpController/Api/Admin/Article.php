<?php
/**
 * Created by PhpStorm.
 * User: fushu
 * Date: 2020/8/26
 * Time: 9:32
 */

namespace App\HttpController\Api\Admin;

use App\Model\Article\ArticleCategoryModel;
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
 * @package App\HttpController\Api\Admin
 * @ApiGroup(groupName="Api.Admin.Article")
 * @ApiGroupDescription("文章列表接口")
 */
class Article extends AdminBase
{

    /**
     * @Api(name="add",path="/Api/Admin/Article/add")
     * @ApiDescription("新增文章")
     * @InjectParamsContext(key="data")
     * @Param(name="categoryId", description="分类id", required="", integer="")
     * @Param(name="title", description="标题", required="")
     * @Param(name="description", description="简介", optional="")
     * @Param(name="imgUrl", description="缩略图")
     * @Param(name="author", description="作者", optional="")
     * @Param(name="content", description="内容", optional="")
     * @Param(name="state", description="状态", optional="", inArray={0,1})
     * @Param(name="note", description="文章备注", optional="")
     * @Param(name="articleCode", description="文章code", optional="")
     * @ApiSuccess({"code":200,"result":{"data":{"list":null,"total":null}},"msg":"success"})
     */
    public function add()
    {
        $param = ContextManager::getInstance()->get('data');
        $model = new ArticleModel();
        $categoryModel = new ArticleCategoryModel();
        $categoryInfo = $categoryModel->get(['categoryId' => $param['categoryId']]);
        Assert::assert(!!$categoryInfo, '分类不存在');
        $data = [
            'adminId'      => $this->who->adminId,
            'categoryId'   => $param['categoryId'],
            'title'        => $param['title'],
            'description'  => $param['description'] ?? '',
            'imgUrl'       => $param['imgUrl'] ?? '',
            'author'       => $param['author'] ?? AdminModel::create()->get(['adminId' => $this->who()->adminId])->adminName,
            'content'      => $param['content'] ?? '',
            'state'        => $param['state'] ?? ArticleModel::STATE_NORMAL,
            'articleCode'  => $param['articleCode'] ?? '',
            'categoryName' => $categoryInfo->categoryName,
            'note'         => $param['note'],
            'addTime'      => time(),
        ];

        $model = $model::create($data);
        $model->save();
        $this->writeJson(Status::CODE_OK, [], "添加文章成功");
    }

    /**
     * @Api(name="update",path="/Api/Admin/Article/update")
     * @ApiDescription("修改文章")
     * @InjectParamsContext(key="data")
     * @Param(name="articleId", description="文章id", required="",)
     * @Param(name="categoryId", description="分类id", optional="", )
     * @Param(name="title", description="标题", optional="")
     * @Param(name="description", description="简介", optional="")
     * @Param(name="imgUrl", description="缩略图")
     * @Param(name="author", description="作者", optional="")
     * @Param(name="content", description="内容", optional="")
     * @Param(name="state", description="状态 0:隐藏 1:正常", optional="", inArray={0,1})
     * @Param(name="note", description="文章备注", optional="")
     * @ApiSuccess({"code":200,"result":{"data":{"list":null,"total":null}},"msg":"success"})
     */
    public function update()
    {
        $data = ContextManager::getInstance()->get('data');
        $model = new ArticleModel();
//        $articleInfo = $model->get(['articleId' => $data['articleId'], 'adminId' => $this->who()->adminId]);
//        Assert::assert(!!$articleInfo, '文章不存在或不属于你');
        $articleInfo = $model->get(['articleId' => $data['articleId']]);
        Assert::assert(!!$articleInfo, '文章不存在');

        $categoryModel = new ArticleCategoryModel();
        if ($data['categoryId']) {
            $categoryInfo = $categoryModel->get(['categoryId' => $data['categoryId']]);
            Assert::assert(!!$categoryInfo, '分类不存在');
            $data['categoryName'] = $categoryInfo->categoryName;
        }
        $data['categoryId'] = $data['categoryId'] ?? $articleInfo->categoryId;
        $data['updateTime'] = time();
        $data['title'] = $data['title'] ?? $articleInfo->title;
        $data['description'] = $data['description'] ?? $articleInfo->description;
        $data['imgUrl'] = $data['imgUrl'] ?? $articleInfo->imgUrl;
        $data['author'] = $data['author'] ?? $articleInfo->author;
        $data['content'] = $data['content'] ?? $articleInfo->content;
        $data['state'] = $data['state'] ?? $articleInfo->state;
        $data['note'] = $data['note'] ?? $articleInfo->note;

        $model->update($data, ['articleId' => $articleInfo->articleId]);

        $this->writeJson(Status::CODE_OK, [], "修改文章成功");
    }

    /**
     * @Api(name="getAll",path="/Api/Admin/Article/getAll")
     * @ApiDescription("文章列表")
     * @Param(name="title",description="文章标题",optional="")
     * @Param(name="categoryName",description="分类名字",optional="")
     * @Param(name="articleCode",description="文章code",optional="")
     * @Param(name="page",description="页数",optional="")
     * @Param(name="limit",description="每页总数",optional="")
     * @ApiSuccess({"code":200,"result":{"data":{"list":null,"total":null}},"msg":"success"})
     */
    public function getAll($title, $categoryName, $articleCode, $page, $limit)
    {
        $model = new ArticleModel();
        if ($title) {
            $model->where('title' , "%" . $title . "%", 'like');
        }
        if ($categoryName) {
            $model->where(['categoryName' => $categoryName]);
        }
        if ($articleCode) {
            $model->where(['articleCode' => $articleCode]);
        }
        $data = $model->getList($page ?? 1, $limit ?? 10);
        $this->writeJson(Status::CODE_OK, $data, 'success');
    }

    /**
     * @Api(name="getOne",path="/Api/Admin/Article/getOne")
     * @ApiDescription("获取一条文章数据")
     * @Param(name="articleId",description="文章ID",optional="")
     * @Param(name="articleCode",description="文章code",optional="")
     */
    public function getOne($articleId, $articleCode)
    {
        $model = new ArticleModel();
        if (empty($articleCode) && empty($articleId)) {
            $this->writeJson(Status::CODE_BAD_REQUEST, '', '文章ID或文章code必须传一个');
        }
        if ($articleCode) {
            $model->where(['articleCode' => $articleCode]);
        }
        if ($articleId) {
            $model->where(['articleId' => $articleId]);
        }
        $data = $model->get();
        $this->writeJson(Status::CODE_OK, $data, 'success');
    }


    /**
     * @Api(name="delete",path="/Api/Admin/Article/delete")
     * @ApiDescription("删除文章")
     * @Param(name="articleId",description="文章ID",required="")
     * @ApiSuccess({"code":200,"result":{"data":{"list":null,"total":null}},"msg":"success"})
     */
    public function delete($articleId)
    {
        $model = new ArticleModel();
        $info = $model->get(['articleId' => $articleId]);
        Assert::assert(!!$info, '文章不存在');
        $info->destroy();
        $this->writeJson(Status::CODE_OK, [], '删除成功');
    }
}
