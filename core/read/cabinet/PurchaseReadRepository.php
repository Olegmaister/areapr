<?php

namespace core\read\cabinet;

use Yii;
use core\entities\cabinet\Purchase;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class PurchaseReadRepository
{
    public function find($id): ?Purchase
    {
        $userId = Yii::$app->user->id;

        return Purchase::find()
            ->where(['id' => $id, 'user_id' => $userId])
            ->one();

    }

    public function getAll(): DataProviderInterface
    {
        $userId = Yii::$app->user->id;
        $query = Purchase::find()->where(['user_id' => $userId]);
        return $this->getProvider($query);
    }

    public function getList(): DataProviderInterface
    {
        $userId = Yii::$app->user->id;

        $query = Purchase::find()
            ->with([
                'items' => function ($query) {
                    $query->with('nomenclature');
                },
            ])
            ->orWhere(['<>', 'status', Purchase::STATUS_DRAFT])
            ->orWhere(['and', ['status' => Purchase::STATUS_DRAFT, 'user_id' => $userId]]);

        return $this->getProvider($query);
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    }
}