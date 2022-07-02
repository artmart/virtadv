<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sp500ratesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sp500rates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'return') ?>

    <?= $form->field($model, 'january') ?>

    <?= $form->field($model, 'february') ?>

    <?php // echo $form->field($model, 'march') ?>

    <?php // echo $form->field($model, 'april') ?>

    <?php // echo $form->field($model, 'may') ?>

    <?php // echo $form->field($model, 'june') ?>

    <?php // echo $form->field($model, 'july') ?>

    <?php // echo $form->field($model, 'august') ?>

    <?php // echo $form->field($model, 'september') ?>

    <?php // echo $form->field($model, 'october') ?>

    <?php // echo $form->field($model, 'november') ?>

    <?php // echo $form->field($model, 'december') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
