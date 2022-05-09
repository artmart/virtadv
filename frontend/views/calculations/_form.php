<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="card bg-light mb-3">
  <div class="card-body">



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
        <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('CALCULATE', ['class' => 'btn btn-green w-100', 'onClick'=>'calculate()']) ?>
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-green w-100', 'onClick'=>'save()']) ?>
        </div>
        </div>
        
        <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('Demo', ['class' => 'btn btn-green w-100', 'onClick'=>'demo()']) ?>
        </div>
        </div>
        
        <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('S&P 500', ['class' => 'btn btn-green w-100', 'onClick'=>'sandp()']) ?>
        </div>
        </div>
        
    </div>
</div>



</div>
    <?php ActiveForm::end(); ?>

</div>

  </div>
</div>




  
<div id="wait" style="display:none; z-index: 1000;" class="justify-content-center align-items-center"><img src='/img/ajaxloader.gif'/> Loading...</div>
<div class="row1"><div id="results" style="width: 100%;"></div></div>


<script>
document.getElementById("w0").addEventListener("click", function(event){event.preventDefault()});
$('form#w0').submit(false);
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


function demo(){
    
    $('#calculations-reference_id').val('demo');
    
    $('#calculations-current_value').val(100000);
    $('#calculations-years_of_investment').val(10);
    $('#calculations-annual_return_rate').val(5);
    $('#calculations-annual_withdrawal').val(4000);
    $('#calculations-management_fee').val(1);
    
    calculate();
    
}

function sandp(){
    alert('OK');
}


</script>