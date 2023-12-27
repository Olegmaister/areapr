<?php

namespace core\entities\cabinet;

use core\entities\PurchaseItem;
use core\entities\users\User;
use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * This is the model class for table "purchases".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property float $budget
 * @property int $status
 * @property string|null $created_at
 *
 * @property User $user
 *
 * @property PurchaseItem[] $items
 */
class Purchase extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public static function create($title, $budget, $description, $status): self
    {
        $purchase = new self();
        $purchase->user_id = \Yii::$app->user->id;
        $purchase->title = $title;
        $purchase->budget = $budget;
        $purchase->description = $description;
        $purchase->status = $status;

        return $purchase;
    }

    public function edit($title, $budget, $description, $status): void
    {
        $this->title = $title;
        $this->budget = $budget;
        $this->description = $description;
        $this->status = $status;

    }

    public static function getStatuses()
    {
        return [
            self::STATUS_DRAFT => 'draft',
            self::STATUS_ACTIVE => 'active'
        ];
    }

    public function behaviors()
    {
        return [
            'saveRelations' => [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    'items'
                ],
            ],
        ];
    }

    public function assignmentItems($item)
    {
        $assignments = $this->items;

        $assignments[] = PurchaseItem::create(
            $item->description,
            $item->quantity,
            $item->nomenclature
        );

        $this->items = $assignments;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchases';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'budget' => 'Budget',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getItems()
    {
        return $this->hasMany(PurchaseItem::class, ['purchase_id' => 'id']);
    }
}
