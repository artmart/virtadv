<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="sp500rates-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">

<div class="col-md-12"> 
    <div class="row">
        <div class="col-md-3">  
        <?= $form->field($model, 'january')->textInput() ?>
        </div>
        <div class="col-md-3"> 
        <?= $form->field($model, 'february')->textInput() ?>
        </div>
        <div class="col-md-3"> 
        <?= $form->field($model, 'march')->textInput() ?>
        </div>
        <div class="col-md-3">  
        <?= $form->field($model, 'april')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">     
        <?= $form->field($model, 'may')->textInput() ?>
        </div>
        <div class="col-md-3">     
        <?= $form->field($model, 'june')->textInput() ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'july')->textInput() ?>
        </div>
        <div class="col-md-3"> 
        <?= $form->field($model, 'august')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"> 
        <?= $form->field($model, 'september')->textInput() ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'october')->textInput() ?>
        </div>
        <div class="col-md-3"> 
        <?= $form->field($model, 'november')->textInput() ?>
        </div>
        <div class="col-md-3"> 
        <?= $form->field($model, 'december')->textInput() ?>
        </div>
    </div>
<hr />   
<div class="row"> 
    <div class="col-md-4"> 
    <?= $form->field($model, 'year')->textInput() ?>
    </div>
    <div class="col-md-4"> 
    <?= $form->field($model, 'return')->textInput() ?>
    </div>
    <div class="col-md-4 form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success w-100', 'style' => 'margin-top: 30px']) ?>
    </div>
</div>    
<hr />    
    

</div>
</div>
    <?php ActiveForm::end(); ?>

</div>
