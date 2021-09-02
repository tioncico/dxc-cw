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
 * Class ArticleCategory
 * @package App\HttpController\Api\Admin
 * @ApiGroup(groupName="Api.Admin.ArticleCategory")
 * @ApiGroupDescription("文章分类接口")
 */
class ArticleCategory extends AdminBase
{

    /**
     * @Api(name="add",path="/Api/Admin/ArticleCategory/add")
     * @ApiDescription("新增文章分类列表")
     * @InjectParamsContext(key="data")
     * @Param(name="categoryName", description="分类名称", required="")
     * @Param(name="pid", description="父级分类id", optional="", )
     * @Param(name="note", description="分类备注", optional="")
     * @ApiSuccess({"code":200,"result":{"data":{"list":null,"total":null}},"msg":"success"})
     */
    public function add()
    {
        $data = ContextManager::getInstance()->get('data');
        $model = new ArticleCategoryModel();

        $info = $model->get(['categoryName' => $data['categoryName']]);
        Assert::assert(!$info, '分类已存在');
        if (empty($data['pid'])) {
            $data['pid'] = 0;
        }else{
            $pidCategoryInfo = $model->get(['categoryId' => $data['pid']]);
            Assert::assert(!!$pidCategoryInfo, '上级分类不存在');
        }
        $model = $model::create($data);
        $model->save();
        $this->writeJson(Status::CODE_OK, [], "添加分类成功");
    }

    /**
     * @Api(name="update",path="/Api/Admin/ArticleCategory/update")
     * @ApiDescription("新增文章分类列表")
     * @InjectParamsContext(key="data")
     * @Param(name="categoryId", description="文章分类id", required="", )
     * @Param(name="categoryName", description="分类名称", required="")
     * @Param(name="pid", description="父级分类id", optional="",)
     * @Param(name="note", description="分类备注", optional="")
     * @ApiSuccess({"code":200,"result":{"data":{"list":null,"total":null}},"msg":"success"})
     */
    public function update()
    {
        $data = ContextManager::getInstance()->get('data');
        $model = new ArticleCategoryModel();
        $info = $model->get(['categoryId' => $data['categoryId']]);
        Assert::assert(!!$info, '找不到分类');
        if ($data['categoryName']!= $info['categoryName']) {
            $categoryInfo = $model->get(['categoryName' => $data['categoryName']]);
            Assert::assert(!$categoryInfo, '分类已存在');
        } else {
            $data['categoryName'] = $info->categoryName;
        }
        $data['pid'] = $data['pid'] ?? $info->pid;
        $data['note'] = $data['note'] ?? $info->note;

        $model->update($data, ['categoryId' => $info->categoryId]);
        $this->writeJson(Status::CODE_OK, [], "修改分类成功");
    }

    /**
     * @Api(name="delete",path="/Api/Admin/ArticleCategory/delete")
     * @ApiDescription("新增文章分类列表")
     * @Param(name="categoryId", description="文章分类id", required="", )
     * @ApiSuccess({"code":200,"result":{"data":{"list":null,"total":null}},"msg":"success"})
     */
    public function delete($categoryId)
    {
        $model = new ArticleCategoryModel();
        $info = $model->get(['categoryId' => $categoryId]);
        Assert::assert(!!$info, '找不到分类');

        $articleModel = new ArticleModel();
        $articleInfo = $articleModel->get(['categoryId' => $categoryId]);
        Assert::assert(!$articleInfo, '分类下有文章');
        $info->destroy();
        $this->writeJson(Status::CODE_OK, [], '删除成功');

    }

    /**
     * @Api(name="getOne",path="/Api/Admin/ArticleCategory/getOne")
     * @ApiDescription("获取一条文章分类数据")
     * @Param(name="categoryId", description="文章分类id", required="", )
     * @ApiSuccess({"code":200,"result":{"data":{"list":null,"total":null}},"msg":"success"})
     */
    public function getOne($categoryId)
    {
        $model = new ArticleCategoryModel();
        $data = $model->get(['categoryId' => $categoryId]);
        $this->writeJson(Status::CODE_OK, $data, 'success');
    }

    /**
     * @Api(name="getAll",path="/Api/Admin/ArticleCategory/getAll")
     * @ApiDescription("文章分类列表")
     * @Param(name="pid",description="父类Id",optional="")
     * @Param(name="page",description="页数",optional="")
     * @Param(name="categoryName",optional="",description="文章分类名")
     * @Param(name="limit",description="每页总数",optional="")
     * @ApiSuccess({"code":200,"result":{"data":{"list":null,"total":null}},"msg":"success"})
     */
    public function getAll($pid, $page, $limit, $categoryName)
    {
        $model = new ArticleCategoryModel();

        if (is_numeric($pid)) {
            $model->where(['pid' => $pid]);
        }
        if ($categoryName) {
                $model->where('categoryName', "%" . $categoryName . "%", 'like');
        }

        $data = $model->getList($page ?? 1, $limit??10);
        $this->writeJson(Status::CODE_OK, $data, 'success');
    }
}