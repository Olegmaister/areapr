<?php

namespace core\repositories\cabinet;

use core\entities\cabinet\Purchase;
use yii\base\Exception;

class PurchaseRepository
{

    public function get($id): Purchase
    {
        if (!$purchase = Purchase::findOne($id)) {
            throw new Exception('Purchase is not found.');
        }
        return $purchase;
    }

    public function save(Purchase $purchase): void
    {
        if (!$purchase->save()) {
            throw new Exception('Saving error');
        }
    }

}
