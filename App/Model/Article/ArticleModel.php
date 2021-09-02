<?php
/**
 * Created by PhpStorm.
 * User: fushu
 * Date: 2020/8/26
 * Time: 9:34
 */

namespace App\Model\Article;


use App\Model\Admin\AdminModel;
use App\Model\BaseModel;
use App\Utility\Assert\Assert;
use App\Utility\Bean\ListBean;
use EasySwoole\ORM\Utility\Schema\Table;

/**
 * @property int    $articleId;
 * @property int    $categoryId;
 * @property string $categoryName;
 * @property string $title;
 * @property string $imgUrl;
 * @property string $description;
 * @property string $author;
 * @property int    $adminId;
 * @property string $content;
 * @property int    $addTime;
 * @property int    $updateTime;
 * @property int    $state;
 * @property string $note;
 * @property string $articleCode;
 * Class ArticleModel
 * @package App\Model\Article
 */
class ArticleModel extends BaseModel
{
    const STATE_NORMAL = 1;
    const STATE_HIDE = 0;

    protected $tableName = 'article_list';


    public function getList(int $page = 1, int $pageSize = 10, string $field = '*'): ListBean
    {
        $listBean = $this
            ->order($this->schemaInfo()->getPkFiledName(), 'DESC')
            ->field($field)
            ->getPageList($page, $pageSize);
        return $listBean;
    }


    public function addArticle($categoryId, $description, $title, $adminId, $author, $content, $state, $note, $articleCode)
    {
        $model = new ArticleModel();
        $model->categoryId = $categoryId;
        $categoryModel = new ArticleCategoryModel();
        $categoryInfo = $categoryModel->get(['categoryId' => $categoryId]);
        Assert::assert(!!$categoryInfo, '分类不存在');
        $model->categoryName = $categoryInfo->categoryName;
        $model->description = $description;
        $model->title = $title;
        if ($adminId) {
            $model->adminId = $adminId;
        }
        $model->author = $author ?? AdminModel::create()->get(['adminId' => $adminId])->adminName;
        $model->content = $content;
        $model->state = $state;
        $model->note = $note;
        $model->articleCode = $articleCode;
        $model->addTime = time();
        $model->save();
        return $model;
    }
}
