<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="endofdayfigures-form">
<div class="mt-5 offset-lg-3 col-lg-6">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'just_eat_total_orders')->textInput() ?>
    <?= $form->field($model, 'just_eat_total_sales')->textInput() ?>
    <?= $form->field($model, 'uber_eats_total_orders')->textInput() ?>
    <?= $form->field($model, 'uber_eats_total_sales')->textInput() ?>
    <?= $form->field($model, 'deliveroo_total_orders')->textInput() ?>
    <?= $form->field($model, 'deliveroo_total_sales')->textInput() ?>
    <?= $form->field($model, 'wix_total_orders')->textInput() ?>
    <?= $form->field($model, 'wix_total_sales')->textInput() ?>
    <?= $form->field($model, 'zettle_total_orders')->textInput() ?>
    <?= $form->field($model, 'zettle_total_sales')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>