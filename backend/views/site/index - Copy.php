<?php
$this->title = 'Admin Dashboard';

//$user_id = Yii::$app->user->id;
$sql = "SELECT id, firstname, lastname from user where user_group in ('2', '3')";
$users = Yii::$app->db->createCommand($sql)->queryAll();
?>
<div class="site-index">
    <div class="body-content">

        <div class="row1">
         <br />
        <h2>Filter Form</h2>   
        <hr />
                  
        <form id="results_form">
        <div class="row">
        <div class="col-lg-3">
        <div class="form-group">
        <input type="text" name="day" id="day" value="" class="form-control">
        <input type="hidden" id="dayformated" name="dayformated" value="">
        </div>
        </div>
        <!--
        <div class="form-group">
		<input type="hidden" id="start" name="start" value="">
		<input type="hidden" id="end" name="end" value="">
		<div id="reportrange" class="form-control">
			<i class="fa fa-calendar"></i>&nbsp;
			<span></span> <i class="fa fa-caret-down"></i>
		</div>
		</div>
        -->
        <div class="col-lg-3">
        <select class="selectpicker" data-live-search="true" name="user" id="user">
        <?php foreach($users as $u){ ?>
          <option value="<?=$u['id'] ?>"><?=$u['firstname'].' '.$u['lastname'] ?></option>
        <?php } ?>
        </select>
        </div>
        
          <div class="col-lg-2">
          <button type="submit" class="btn btn-primary" onclick="results()">Submit</button> 
          </div>
        </div>
        </form>  
        
        <hr />
        <div id="wait" style="display:none; z-index: 1000;" class="justify-content-center align-items-center"> <img src='/img/ajaxloader.gif'/> Loading...</div>
        <div class="row"><div id="results" style="width: 100%;"></div></div>          
                 
        </div>

    </div>
</div>

<script>
$(function(){
  $('input[name="day"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
  //  locale: {
    //      format: 'DD/MM/YYYY',
  //  },
    //minYear: 1901,
    //maxYear: parseInt(moment().format('YYYY'),10)
  }, /*function(start, end, label) {
    var years = moment().diff(start, 'years');
    alert("You are " + years + " years old!");
  }*/
  function(start, end, label){
        $('#dayformated').val(start.format('YYYY-MM-DD'));
    }
  );
  
    var dayval = $('#day').val();
    $('#dayformated').val(moment(dayval).format('YYYY-MM-DD'));
    //$(".selectpicker").selectpicker({noneSelectedText: 'Select SKU'});
});

/*
	$(function() {
		var start = moment().subtract(29, 'days');
		var end = moment();
		$('#start').val(start.format('YYYY-MM-D'));
		$('#end').val(end.format('YYYY-MM-D'));

		function cb(start, end) {
			$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

			$('#start').val(start.format('YYYY-MM-D'));
			$('#end').val(end.format('YYYY-MM-D'));
		}

		$('#reportrange').daterangepicker({
			startDate: start,
			endDate: end,
			autoUpdateInput: true,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb);

		cb(start, end);

	//	$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
	//		showValues();
	//});

	});
*/

$("#results_form").submit(function(){return false;});
	
function results(){

//var atLeastOneIsChecked = $('.check1:checked').length; 
//if(atLeastOneIsChecked==0){
 //   alert('Please select at least an one checkbox.');
//}else{

var data = $("#results_form").serialize();

$.ajax({
		type: 'post',
		url: '/admin/site/results',
		data: data,
        beforeSend: function(){$("#wait").css("display", "block");},
		success: function (response){
		     $("#wait").css("display", "none");
		     $( '#results' ).html(response);
             $('html,body').animate({scrollTop: $("#results").offset().top},'slow');
             //setTimeout( "$('#results').hide();", 4000);
		}
    }); 
}
</script>