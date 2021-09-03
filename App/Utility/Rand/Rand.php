<?php
/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 20-1-13
 * Time: 下午10:19
 */

namespace App\Utility\Rand;


class Rand
{
    protected $exactNum = 10000;
    protected $randList = [];

    public function __construct(array $randList, $exactNum = 10000)
    {
        $this->exactNum = $exactNum;
        $this->randList = $randList;
    }

    public function randValue($randNum = 1, $ifRepeat = true)
    {
        $exactNum = $this->exactNum;
        $randList = $this->randList;

        if (empty($this->randList)) {
            throw  new RandException('随机数据不存在');
        }
        //随机数计算逻辑
        //所有元素的随机概率相加/$exactNum 则是中奖概率,所有元素的随机概率相加+通用元素概率 = $exactNum
        //随机数从1-$exactNum  根据元素的顺序来判断是否中奖,例如随机到9999,则通过遍历数组相加概率,直到最后符合这个值
        //通用的随机数,当其他元素都没随机到时,那就是这个
        $commonKey = null;
        $commonObj = null;
        //当前的概率总数
        $nowOddsNum = 0;
        $randKeyList = [];
        /**
         * @var $randList Bean[]
         */
        foreach ($randList as $key => $va) {
            if ($va->isCommon()&&$commonKey===null) {
                $commonKey = $key;
                $commonObj = $va;
            } else {
                $randKeyList[$key] = $va;
                $nowOddsNum += $va->getOdds();//
            }
        }
        if ($nowOddsNum > $exactNum) {
            throw  new RandException('概率值设置不正确,比相应的值更大');
        }
        if (empty($commonObj)) {
            throw  new RandException('通用元素不存在');
        }

        $commonObj->setOdds($exactNum - $nowOddsNum);
        $randKeyList[$commonKey] = $commonObj;

        //开始随机
        $ids = [];
        for ($i = 0; $i < $randNum; $i++) {
            list($key, $randValue) = $this->randList($randKeyList, $exactNum);
            if (empty($randValue)) {
                throw  new RandException('随机数据出错!');
            }

            if (isset($ids[$key])) {
                //不能重复
                if ($ifRepeat != true) {
                    //如果需要随机的数组比重复的数据还要少,那就说明永远随机不了了,直接返回数据
                    if (count($randKeyList) <= count($ids)) {
                        return $ids;
                    }
                    //否则i--,继续循环一次
                    $i--;
                    continue;
                }
                $ids[$key]['num'] += 1;
            } else {
                $ids[$key]['num'] = 1;
                $ids[$key]['info'] = $randValue;
            }
        }
        return array_values($ids);
    }

    public function randOne():Bean
    {
        $data = $this->randValue(1);
        return $data[0]['info'];
    }

    protected function randList($randList, $exactNum)
    {
        $randNum = mt_rand(1, $exactNum);
        $oddNum = 0;

        /**
         * @var $randList Bean[]
         */
        foreach ($randList as $key => $va) {
            if ($randNum > $oddNum && $randNum <= $va->getOdds() + $oddNum) {
                return [$key, $va];
            } else {
                $oddNum += $va->getOdds();
            }
        }
        return [];
    }

    /**
     * 直接通过array_rand来随机一个数组
     * randArray
     * @param $list
     * @param $num
     * @author tioncico
     * Time: 上午10:41
     */
    static function randArray($list, $num)
    {
        if (empty($list)) {
            return [];
        }
        $rand = array_rand($list, $num);
        $data = [];
        if ($num == 1) {
            $data = $list[$rand];
        } else {
            foreach ($rand as $value) {
                $data[] = $list[$value];
            }
        }
        return $data;
    }
}
