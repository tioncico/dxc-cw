<?php

namespace App\Model\User;

use App\Model\BaseModel;

/**
 * UserModel
 * Class UserModel
 * Create With ClassGeneration
 * @property int $userId //
 * @property string $account // 辣蹦号
 * @property string $nickname // 昵称
 * @property string $password // 密码
 * @property string $phone // 手机号
 * @property string $avatar // 头像地址
 * @property int $addTime // 创建的时间
 * @property int $session // 创建的时间
 * @property int $state // 状态
 */
class UserModel extends BaseModel
{
	protected $tableName = 'user_list';


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

    static function hashPassword($password)
    {
        return md5($password);
    }

    function logout()
    {
        return $this->update(['session' => '']);
    }
}

