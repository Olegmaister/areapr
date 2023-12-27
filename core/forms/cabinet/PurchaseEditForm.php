<?php

namespace core\forms\cabinet;

use core\entities\cabinet\Purchase;
use core\entities\Nomenclature;
use core\entities\PurchaseItem;
use core\forms\CompositeForm;
use core\forms\users\PurchaseItemForm;
use yii\helpers\ArrayHelper;

/**
 * @property PurchaseItemForm[] $items
 */

class PurchaseEditForm extends CompositeForm
{
    public $title;
    public $budget;
    public $status;
    public $description;

    public function __construct(Purchase $purchase, $config = [])
    {
        $this->title = $purchase->title;
        $this->budget = $purchase->budget;
        $this->description = $purchase->description;
        $this->status = $purchase->status;

        $this->items = array_map(function(PurchaseItem $item){
            return new PurchaseItemForm($item);
        },PurchaseItem::find()->where(['purchase_id' => $purchase->id])->all());


        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'budget'], 'required'],
            [['status'], 'integer'],
            [['description'], 'string'],
            [['budget'], 'number'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Nomenclature::find()->asArray()->all(), 'id', function (array $nomenclature) {
            return $nomenclature['name'];
        });
    }

    protected function internalForms(): array
    {
        return ['items'];
    }
}


