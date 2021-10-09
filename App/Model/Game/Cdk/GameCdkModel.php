<?php

namespace App\Model\Game\Cdk;

use App\Model\BaseModel;
use EasySwoole\Utility\Random;
use EasySwoole\Utility\Str;

/**
 * GameCdkModel
 * Class GameCdkModel
 * Create With ClassGeneration
 * @property int    $cdkId // id
 * @property string $cdk // cdk兑换码
 * @property int    $num // 剩余数量,-1表示无限
 * @property int    $addTime // 新增时间
 * @property int    $endTime // 过期时间
 * @property int    $status // 状态 0正常,1已使用 -1已过期
 */
class GameCdkModel extends BaseModel
{
    protected $tableName = 'game_cdk_list';


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

    public function generationCdk()
    {
        return Random::character(8);
    }

    public function getInfoByCdk($cdk){
        return $this->where('cdk',$cdk)->get();
    }

    public function addData(int $num, ?int $endTime=null): self
    {
        $data = [
            'cdk'     => $this->generationCdk(),
            'num'     => $num,
            'addTime' => time(),
            'endTime' => $endTime??time()+86400*365,
            'status'  => 0,
        ];
        $model = new self($data);
        $model->save();
        return $model;
    }
}

