<?php

namespace App\Actor\Goods;

use App\Actor\Fight\Bean\Attribute;
use App\Actor\Skill\SkillEffectResult;
use App\Model\Game\GoodsModel;
use App\Utility\Assert\Assert;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\Utility\Str;
use function AlibabaCloud\Client\isWindows;

class GoodsManager
{
    /**
     * @var Attribute
     */
    protected $userAttribute;

    protected $tickTimeArr;

    public function __construct(Attribute $userAttribute)
    {
        $this->userAttribute = $userAttribute;
    }

    public function useGoods(GoodsModel $goodsModel)
    {
        $goodsCode = $goodsModel->baseCode;
        if (!in_array($goodsCode, ['propHp', 'propMp'])) {
            Assert::assert(false, "此物品不能在地下城使用");
        }
        switch ($goodsCode){
            case"propHp":
                $goodsResult = $this->useHp($goodsModel);
                break;
            case"propMp":
                $goodsResult = $this->useMp($goodsModel);
                break;
        }
        $this->changeAttribute($this->userAttribute,$goodsResult);
        return $goodsResult;
    }

    public function useHp(GoodsModel $goodsModel): GoodsResult
    {
        $goodsResult = new GoodsResult(['effectName' => $goodsModel->name, 'effectType' => "hp", 'goodsInfo' => $goodsModel]);
        $propertyName = 'hp';
        $goodsResult->addProperty($propertyName, $goodsModel->extraData);
        return $goodsResult;
    }

    public function useMp(GoodsModel $goodsModel): GoodsResult
    {
        $goodsResult = new GoodsResult(['effectName' => $goodsModel->name, 'effectType' => "hp", 'goodsInfo' => $goodsModel]);
        $propertyName = 'mp';
        $goodsResult->addProperty($propertyName, $goodsModel->extraData);
        return $goodsResult;
    }


    public function changeAttribute(Attribute $targetAttribute, GoodsResult $effectResult)
    {
        Logger::getInstance()->console("属性变动触发 {$effectResult->getEffectName()}");
        foreach ($effectResult->getPropertyChangeList() as $propertyName => $num) {
            $getMethodName = "get" . Str::studly($propertyName);
            $setMethodName = "set" . Str::studly($propertyName);
            Logger::getInstance()->console("{$targetAttribute->getName()}{$propertyName}属性:{$targetAttribute->$getMethodName()}");
            $targetAttribute->$setMethodName($targetAttribute->$getMethodName() + $num);
            Logger::getInstance()->console("{$targetAttribute->getName()}{$propertyName}现在属性:{$targetAttribute->$getMethodName()}");
        }
    }
}
