<?php
/**
 * Created by PhpStorm.
 * User: fushu
 * Date: 2020/8/26
 * Time: 9:34
 */

namespace App\Model\Article;


use App\Model\BaseModel;
use App\Utility\Bean\ListBean;
use EasySwoole\ORM\Utility\Schema\Table;

/**
 * @property int    $categoryId;
 * @property string $categoryName;
 * @property int    $pid;
 * @property string $note;
 * Class ArticleCategoryModel
 * @package App\Model\Article
 */
class ArticleCategoryModel extends BaseModel
{
    protected $tableName = 'article_category_list';


    public function getList(int $page = 1, int $pageSize = 10, string $field = '*'): ListBean
    {
        $listBean = $this
            ->order($this->schemaInfo()->getPkFiledName(), 'DESC')
            ->field($field)
            ->getPageList($page, $pageSize);
        return $listBean;
    }


    public function addArticleCategory($categoryName, $pid, $note)
    {
        $model = new ArticleCategoryModel();
        $model->categoryName = $categoryName;
        $model->pid = $pid;
        $model->note = $note;
        $model->save();
        return $model;
    }
}
