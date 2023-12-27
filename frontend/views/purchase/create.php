<?php

/* @var $this yii\web\View */

/* @var $model \core\forms\users\PurchaseCreateForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use core\entities\Nomenclature;
use core\entities\cabinet\Purchase;

$this->title = 'Create purchase';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-purchase">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-10">
            <?php $form = ActiveForm::begin(['id' => 'form-purchase']); ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'title') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'budget') ?>
                </div>
            </div>

            <?= $form->field($model, 'description')->textarea() ?>
            <?= $form->field($model, 'status')->radioList(
                Purchase::getStatuses()
            ) ?>


            <div id="nomenclature-container">
                <?php foreach ($model->items as $index => $itemForm): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($itemForm, "[$index]description")->textarea(['rows' => 4])->label('Description') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($itemForm, "[$index]quantity")->label('Quantity') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($itemForm, "[$index]nomenclature")
                                ->dropDownList(Nomenclature::getList(), ['prompt' => 'Select Nomenclature'])->label('Nomenclature') ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>



            <button type="button" class="btn btn-success" id="add-nomenclature">Add Nomenclature</button>

            <div class="form-group"  style="margin-top: 10px">
                <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'purchase-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
// => JS
$this->registerJs("
    var nomenclatureCount = " . count($model->items) . ";

    $('#add-nomenclature').click(function() {
        var container = $('#nomenclature-container');
        var nomenclatureHtml = $('#nomenclature-template').html();
        nomenclatureHtml = nomenclatureHtml.replace(/__index__/g, nomenclatureCount);

        container.append(nomenclatureHtml);
        
        // Обновление счетчика
        nomenclatureCount++;
        
        // Перезагрузка выпадающего списка
        $('#nomenclature-container select').selectpicker('refresh');
    });
");
?>


<script type="text/template" id="nomenclature-template">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Description</label>
                <textarea class="form-control" name="PurchaseItemForm[__index__][description]"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Quantity</label>
                <input type="text" class="form-control" name="PurchaseItemForm[__index__][quantity]">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Nomenclature</label>
                <select class="form-control" name="PurchaseItemForm[__index__][nomenclature]">
                    <?php foreach (Nomenclature::getList() as $value => $label): ?>
                        <option value="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</script>


