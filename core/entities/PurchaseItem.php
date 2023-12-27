<?php

namespace core\entities;

use core\entities\cabinet\Purchase;
use Yii;

/**
 * This is the model class for table "purchase_items".
 *
 * @property int $id
 * @property int $purchase_id
 * @property int $nomenclature_id
 * @property string|null $description
 * @property int $quantity
 *
 * @property Nomenclature $nomenclature
 * @property Purchase $purchase
 */
class PurchaseItem extends \yii\db\ActiveRecord
{

    public static function create($description, $quantity, $nomenclatureId) : self
    {
        $item = new self();
        $item->description = $description;
        $item->quantity = $quantity;
        $item->nomenclature_id = $nomenclatureId;

        return $item;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase_items';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purchase_id' => 'Purchase ID',
            'nomenclature_id' => 'Nomenclature ID',
            'description' => 'Description',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[Nomenclature]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNomenclature()
    {
        return $this->hasOne(Nomenclature::class, ['id' => 'nomenclature_id']);
    }

    /**
     * Gets query for [[Purchase]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchase()
    {
        return $this->hasOne(Purchase::class, ['id' => 'purchase_id']);
    }

}
