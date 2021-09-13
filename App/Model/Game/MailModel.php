<?php

namespace App\Model\Game;

use App\Model\BaseModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * MailModel
 * Class MailModel
 * Create With ClassGeneration
 * @property int    $id //
 * @property int    $userId // 用户id
 * @property string $name // 邮件标题
 * @property string $msg // 邮件内容
 * @property int    $addTime // 发送时间
 * @property int    $isRead // 是否已读
 * @property int    $isReceive // 是否已接收
 * @property int    $isDelete // 是否删除
 */
class MailModel extends BaseModel
{
    protected $tableName = 'mail_list';


    public function getList(int $page = 1, int $pageSize = 10, string $field = '*'): array
    {
        $list = $this
            ->withTotalCount()
            ->order($this->schemaInfo()->getPkFiledName(), 'DESC')
            ->field($field)
            ->page($page, $pageSize)
            ->all();
        $total = $this->lastQueryResult()->getTotalCount();
        $data = [
            'page'      => $page,
            'pageSize'  => $pageSize,
            'list'      => $list,
            'total'     => $total,
            'pageCount' => ceil($total / $pageSize)
        ];
        return $data;
    }

    public function addData($userId, $title, $msg,$isReceive=0)
    {

        $data = [
            'userId'    => $userId,
            'name'      => $title,
            'msg'       => $msg,
            'addTime'   => time(),
            'isRead'    => 0,
            'isReceive' => $isReceive,
            'isDelete'  => 0,
        ];
        $model = new MailModel($data);
        $model->save();
        return $model;
    }

    public function goodsList()
    {
        return $this->hasMany(GoodsModel::class, function (QueryBuilder $query) {
            $query->fields(['goods_list.*','mail_goods_list.mailId']);
            $query->join('mail_goods_list', 'mail_goods_list.goodsCode = goods_list.code');
            return $query;
        }, 'id', 'mailId');
    }
}

