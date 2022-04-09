<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Calculations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calculations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'user_id')->textInput() 
    if($model->isNewRecord){$user_id = Yii::$app->user->id;}else{$user_id = $model->user_id;}
    echo $form->field($model, 'user_id')->hiddenInput(['value'=>$user_id])->label(false); 
    ?>
<div class="row">
<div class="col-md-12"> 
    <div class="row">
        <div class="col-md-9">    
        <?= $form->field($model, 'reference_id')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">  
        <?= $form->field($model, 'current_value')->textInput() ?>
        </div>
    </div>
    <div class="row">    
        <div class="col-md-3">  
        <?= $form->field($model, 'years_of_investment')->textInput() ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'annual_return_rate')->textInput() ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'annual_withdrawal')->textInput() ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'management_fee')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
        <div class="form-group">
            <?= Html::submitButton('CALCULATE', ['class' => 'btn btn-green', 'onClick'=>'calculate()']) ?>
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-green', 'onClick'=>'save()']) ?>
        </div>
        </div>
        
    </div>
</div>



</div>
    <?php ActiveForm::end(); ?>

</div>
<hr />
<div id="wait" style="display:none; z-index: 1000;" class="justify-content-center align-items-center"><img src='/img/ajaxloader.gif'/> Loading...</div>
<div class="row"><div id="results" style="width: 100%;"></div></div>


<script>
document.getElementById("w0").addEventListener("click", function(event){event.preventDefault()});
function save(){$('form#w0').submit();}

function calculate(){
    var data = $("#w0").serialize();
    
    $.ajax({
		type: 'post',
		url: '/calculations/calculate',
		data: data,
        beforeSend: function() {
           $("#wait").css("display", "block");               
          },
		success: function (response){
		     $("#wait").css("display", "none");
		     $( '#results' ).html(response);
             //alert('Data saved successfully.');
             //$('html,body').animate({scrollTop: $("#results0").offset().top},'slow');
             //setTimeout( "$('#results0').hide();", 3000);
            // window.location.href = "/";
		}
    }); 
}


</script>