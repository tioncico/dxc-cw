<?php

namespace App\Model\Game\Task;

use App\Model\BaseModel;
use App\Model\Game\GoodsModel;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * GameDailyTaskPointRewardModel
 * Class GameDailyTaskPointRewardModel
 * Create With ClassGeneration
 * @property int $rewardId // 奖励id
 * @property int $type // 1每日奖励,2每周奖励
 * @property int $pointNum // 积分数
 * @property string $goodsCode // 物品code
 * @property int $goodsNum // 物品数量
 */
class GameDailyTaskPointRewardModel extends BaseModel
{
	protected $tableName = 'game_daily_task_point_reward_list';


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
		    'page'=>$page,
		    'pageSize'=>$pageSize,
		    'list'=>$list,
		    'total'=>$total,
		    'pageCount'=>ceil($total / $pageSize)
		];
		return $data;
	}


	public function addData(int $type, int $pointNum, string $goodsCode, int $goodsNum): self
	{
		$data = [
		    'type'=>$type,
		    'pointNum'=>$pointNum,
		    'goodsCode'=>$goodsCode,
		    'goodsNum'=>$goodsNum,
		];
		$model = new self($data);
		$model->save();
		return $model;
	}

	public function goodsInfo(){
        return $this->hasOne(GoodsModel::class, function (QueryBuilder $query) {
            return $query;
        }, 'goodsCode', 'code');
    }

    public function userReceiveInfo($userId=-1){
	    if ($userId<=0){
	        return null;
        }
        return $this->hasOne(UserDailyTaskReceiveModel::class, function (QueryBuilder $query)use($userId) {
            $query->where('userId',$userId);
            $query->where('date',date('Ymd'));
            return $query;
        }, 'rewardId', 'rewardId');
    }
}

