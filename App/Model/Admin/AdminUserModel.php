<?php

namespace App\Model\Admin;

use App\Model\BaseModel;

/**
 * AdminUserModel
 * Class AdminUserModel
 * Create With ClassGeneration
 * @property int $adminId // id
 * @property string $adminName // 昵称
 * @property string $adminAccount // 账号
 * @property string $adminPassword // 密码
 * @property int $addTime // 创建时间
 * @property int $lastLoginTime // 上次登陆的时间
 * @property string $lastLoginIp // 上次登陆的Ip
 * @property string $adminSession //
 */
class AdminUserModel extends BaseModel
{
	protected $tableName = 'admin_user_list';


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
        return $this->update(['adminSession' => '']);
    }
}

