<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EndofdayfiguresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="endofdayfigures-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'timestamp') ?>

    <?= $form->field($model, 'just_eat_total_orders') ?>

    <?= $form->field($model, 'just_eat_total_sales') ?>

    <?php // echo $form->field($model, 'uber_eats_total_orders') ?>

    <?php // echo $form->field($model, 'uber_eats_total_sales') ?>

    <?php // echo $form->field($model, 'deliveroo_total_orders') ?>

    <?php // echo $form->field($model, 'deliveroo_total_sales') ?>

    <?php // echo $form->field($model, 'wix_total_orders') ?>

    <?php // echo $form->field($model, 'wix_total_sales') ?>

    <?php // echo $form->field($model, 'zettle_total_orders') ?>

    <?php // echo $form->field($model, 'zettle_total_sales') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
