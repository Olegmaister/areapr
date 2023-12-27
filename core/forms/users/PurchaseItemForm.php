<?php

namespace core\forms\users;

use core\entities\PurchaseItem;
use yii\base\Model;


class PurchaseItemForm extends Model
{
    public $description;
    public $quantity;
    public $nomenclature;

    public function __construct(PurchaseItem $item = null, $config = [])
    {
        if ($item) {
            $this->description = $item->description;
            $this->quantity = $item->quantity;
            $this->nomenclature = $item->nomenclature_id;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['description', 'quantity'], 'required'],
            [['nomenclature'], 'safe'],
            [['quantity'], 'integer'],
            [['description'], 'string'],
        ];
    }

}


