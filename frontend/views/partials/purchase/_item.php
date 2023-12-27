<?php

/* @var $this yii\web\View */
/* @var $model \core\entities\cabinet\Purchase */

use yii\helpers\Html;

?>
<style>
    .custom-border {
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 10px;
        box-shadow: 2px 2px 5px #888888;
    }
</style>

<div class="blog-posts-item custom-border" style="position: relative;">
    <div class="h2"><?= Html::encode($model->title) ?></div>
    <p>Author: <?= Html::encode($model->user->getFullName()) ?></p>
    <p>Budget: <?= '$' . number_format($model->budget, 2) ?></p>
    <p>Status: <?= \core\helpers\PurchaseHelper::statusLabel($model->status) ?></p>
    <p><?= Yii::$app->formatter->asNtext($model->description) ?></p>

    <h3>Nomenclatures list</h3>

    <div class="row">
        <?php foreach ($model->items as $item):?>
            <div class="col-md-6"  style="border:1px solid #9a6700;">
                <div class="item-block">
                    <p><span style="font-weight: bold">Description:</span> <?= Html::encode($item->description) ?></p>
                    <p><span style="font-weight: bold">Quantity:</span> <?= Html::encode($item->quantity) ?></p>
                    <p><span style="font-weight: bold">Nomenclature:</span> <?= Html::encode($item->nomenclature->name) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


