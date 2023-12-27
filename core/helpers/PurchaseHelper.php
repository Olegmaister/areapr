<?php

namespace core\helpers;

use core\entities\cabinet\Purchase;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class PurchaseHelper
{
    public static function statusList(): array
    {
        return [
            Purchase::STATUS_DRAFT => 'Draft',
            Purchase::STATUS_ACTIVE => 'Active',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Purchase::STATUS_DRAFT:
                $class = 'badge bg-secondary';
                break;
            case Purchase::STATUS_ACTIVE:
                $class = 'badge bg-success';
                break;
            default:
                $class = 'badge bg-secondary';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}