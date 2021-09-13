<?php


namespace App\Service\Game;


use App\Model\BaseModel;
use App\Model\Game\MailGoodsModel;
use App\Model\Game\MailModel;
use App\Service\BaseService;
use EasySwoole\Component\Singleton;

class MailService extends BaseService
{
    use Singleton;

    public function sendMail(int $userId, string $title, string $msg, array $goodsList = [])
    {

        BaseModel::transaction(function () use ($userId, $title, $msg, $goodsList) {
            $isReceive = 0;
            if (empty($goodsList)){
                $isReceive = 1;
            }
            $mail = MailModel::create()->addData($userId,$title,$msg,$isReceive);
            if (!empty($goodsList)){
                foreach ($goodsList as $value){
                    $num = $value['num'];
                    $code = $value['code'];
                    MailGoodsModel::create()->addData($mail->id,$code,$num);
                }
            }
        });

    }
}
