<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;

$action = '/endofdayfigures/create';
if(isset($update)){$action = '/endofdayfigures/update?id='.$model->id;}	
?>
<div class="endofdayfigures-form">
<div class="mt-5 offset-lg-3 col-lg-6">
    <?php $form = ActiveForm::begin([ 
    'id' => 'endofdayfigures_form',
    //'action' => ['endofdayfigures/create'],
    'action' =>[$action],
    'layout' => 'horizontal',
    //'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-sm-6',
            'offset' => 'col-sm-offset-1',
            'wrapper' => 'col-sm-6',
            'error' => '',
            'hint' => '',
        ],
    ],]); ?>
    <?php //$form->field($model, 'user_id')->textInput() 
       echo $form->field($model, 'user_id')->hiddenInput()->label(false); 
    ?>
    <?php //$form->field($model, 'timestamp')->textInput() 
        echo $form->field($model, 'timestamp')->hiddenInput()->label(false); 
    ?>
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
<hr />
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<!--
          <div id="wait11" style="display:none; z-index: 1000;" class="justify-content-center align-items-center"> <img src='/img/ajaxloader.gif'/> Loading...</div>
          <div class="row"><div id="results11" style="width: 100%;"></div></div>
-->
</div>
<?php /*if(!isset($update)){ ?>
<script>
//$("#endofdayfigures_form").submit(function(){return false;});

jQuery(document).ready(function($) {
       $("#endofdayfigures_form").submit(function(event) {
            event.preventDefault(); // stopping submitting
            var data = $(this).serializeArray();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data,
                beforeSend: function() {
                   $("#wait11").css("display", "block");               
                  },
            })
            .done(function(response) {
                if(response.data.success == true) {
                    //alert("Wow you commented");
                    $("#wait11").css("display", "none");
        		     $( '#results11' ).html(response);
                     //$('html,body').animate({scrollTop: $("#results11").offset().top},'slow');
                     //setTimeout( "$('#results11').hide();", 4000);
                     window.location.href = "/?active_tab=endofday";
                     
                }
            })
            .fail(function() {
                console.log("error");
            });
        });
    });
</script>
<?php } */ ?>