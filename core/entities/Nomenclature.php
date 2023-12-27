<?php

namespace core\entities;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "nomenclatures".
 *
 * @property int $id
 * @property string $name
 * @property string $abbreviation
 *
 * @property PurchaseItem[] $purchaseItems
 */
class Nomenclature extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nomenclatures';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'abbreviation' => 'Abbreviation',
        ];
    }

    public static function getList(): array
    {
        return ArrayHelper::map(Nomenclature::find()->asArray()->all(), 'id', function (array $nomenclature) {
            return $nomenclature['name'];
        });
    }

    /**
     * Gets query for [[PurchaseItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseItems()
    {
        return $this->hasMany(PurchaseItem::class, ['nomenclature_id' => 'id']);
    }

}
