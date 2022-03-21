<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="tasks-form">
<div class="mt-5 offset-lg-3 col-lg-6">
    <?php $form = ActiveForm::begin(); ?>
    <?php // $form->field($model, 'task_group')->textInput() ?>
    <?= $form->field($model, 'task_group')->dropDownList(['0' => 'Pre Opening', '1' => 'Prep', '2' => 'Closing'], ['prompt'=>'- Select -']); ?>
    <?= $form->field($model, 'status')->dropDownList(['0' => 'Inactive', '1' => 'Active'] /*, ['prompt'=>'- Select -']*/); ?>
    <?= $form->field($model, 'task')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'note')->textarea(['rows' => 5]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>