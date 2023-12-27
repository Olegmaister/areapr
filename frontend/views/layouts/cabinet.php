<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <aside id="column-right" class="col-sm-2 hidden-xs">
        <div class="list-group">
            <a href="/purchase/create" class="list-group-item">Create purchase</a>
            <a href="<?= Html::encode(Url::to(['/logout'])) ?>" class="list-group-item">Logout</a>
        </div>
    </aside>
    <div id="content" class="col-sm-9">
        <?= $content ?>
    </div>
</div>

<?php $this->endContent() ?>
