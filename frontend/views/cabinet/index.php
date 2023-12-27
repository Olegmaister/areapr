<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */


use yii\helpers\Html;

$this->title = 'Purchase list';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>