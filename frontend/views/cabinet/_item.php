<?php

/* @var $this yii\web\View */
/* @var $model \core\entities\cabinet\Purchase */

use yii\helpers\Html;
use core\helpers\PurchaseHelper;

?>

<div class="blog-posts-item custom-border">
    <div class="h2"><?= Html::encode($model->title) ?></div>
    <p>Budget: <?= '$' . number_format($model->budget, 2) ?></p>
    <p>Status: <?= PurchaseHelper::statusLabel($model->status) ?></p>
    <p><?= Yii::$app->formatter->asNtext($model->description) ?></p>

    <?= Html::a('Edit', ['purchase/edit', 'id' => $model->id], ['class' => 'btn btn-success', 'style' => 'width: 200px;']) ?>
</div>


