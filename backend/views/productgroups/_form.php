<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="productgroups-form">
<div class="mt-5 offset-lg-3 col-lg-6">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'product_group')->textInput(['maxlength' => true]) ?>
    <?php // $form->field($model, 'status')->textInput() ?>
    <?= $form->field($model, 'status')->dropDownList(['0' => 'Inactive', '1' => 'Active'] /*, ['prompt'=>'- Select -']*/); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>