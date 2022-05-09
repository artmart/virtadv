<link rel="stylesheet" type="text/css" href="/vendor/datatables/css/jquery.dataTables.min.css">
<style>
td {
  text-align: center;
}

th {
  text-align: center;
}
</style>
<script src="/vendor/datatables/js/jquery.dataTables.min.js"></script>

<?php
function calculateMarketHistory($calculation, $years){
    //reset worth to original income so we can subtract freely
    $total['worth'] = $calculation['value'];
    $total['remaining'] = $calculation['value'];
    
    //reset statistics values to ensure it's always recalculated
    $statistics['averageReturn'] = 0;
    //default value is 1 because 0? anything is 0 ;)
    $statistics['geometricAverage'] = 1;
    $statistics['actualAnnualizedYield'] = 0;
    $statistics['finalNetValue'] = 0;
    $statistics['totalAnnualizedYield'] = 0;
    $statistics['earnedIncome'] = 0;
    $statistics['lowestPrincipal'] = $calculation['value'];
    
    // iterate over years, workout monthly math and reduce total worth
    foreach($years as $index=>$year){
      $year['geometricAverage'] = (1 + ($year['return'] / 100));
      $statistics['earnedIncome'] += ($years[($index == 0 ? 0 : $index -1)]['eoy'] < $years[($index == 0 ? 0 : $index -1)]['income'] ? $years[($index == 0 ? 0 : $index -1)]['eoy'] : $year['income']);
      $year['charges'] = null;
      $year['fees'] = null;
      $year['boy'] = null;
      $year['eoy'] = null;
      $year['toggled'] = false;
    
      // calculate statistics
      $statistics['averageReturn'] += $year['return'];
      $statistics['geometricAverage'] *= $year['geometricAverage'];
    
      foreach($year['months'] as $month){
        $calculatedValue = ((1 + $month['rate'] / 100) * $total['worth']) - $year['income'] / 12;
        $charge = $month['rate'] / 100 * $calculatedValue;
        $globalFee = $calculation['fee'] / 12 / 100;
        $remaining = $calculatedValue - ($globalFee * $calculatedValue);
        $monthlyCharge = $globalFee * $calculatedValue;
        $month['income'] = $year['income'] / 12;
        $month['fee'] = $globalFee;
        $month['value'] = $calculatedValue;
        $month['charge'] = ($monthlyCharge < 0 ? 0 : $monthlyCharge);
        $month['remaining'] = remaining;
        $statistics['lowestPrincipal'] = ($remaining < $statistics['lowestPrincipal'] ? $remaining : $statistics['lowestPrincipal']);
        if($statistics['lowestPrincipal'] < 0) {
          $statistics['lowestPrincipal'] = 0;
        }
        $total['worth'] = $remaining;
        $total['remaining'] -= $remaining;
        $year['charges'] += floatval($month['charge'], 4);
      }
    
      $year['boy'] = $years[$index - 1] ? $years[$index - 1][$months[11]['remaining']] : $calculation['value']; //????
      $year['v'] += $year['charges'] + ($years[$index - 1] ? $years[$index - 1]['fees'] : null);
      // last iteration will assign final net value
      $year['eoy'] = $statistics['actualAnnualizedYield'] = $years[$index][$months[11]['remaining']]; //???????
    
      $statistics['totalAnnualizedYield'] = $year['eoy'];
      $statistics['finalNetValue'] = $year['eoy'];
    
      if($year['eoy']<0){$year['eoy'] = $statistics['actualAnnualizedYield'] = 0;}
    
      if($year['boy']<0){$year['boy'] = 0;}
    }
    
    calculateStatistics($statistics, $calculation);
}
      
     function calculateMonths($calculation, $years) {
        $table2JsonData = [];
        //reset worth to original income so we can subtract freely
        $total['worth'] = $calculation['value'];
        $total['remaining'] = $calculation['value'];

        //reset statistics values to ensure it's always recalculated
        $statistics['averageReturn'] = 0;
        //default value is 1 because 0? anything is 0 ;)
        $statistics['geometricAverage'] = 1;
        $statistics['actualAnnualizedYield'] = 0;
        $statistics['finalNetValue'] = 0;
        $statistics['totalAnnualizedYield'] = 0;
        $statistics['earnedIncome'] = $calculation['income'];
        $statistics['lowestPrincipal'] = $calculation['value'];

        //iterate over years, workout monthly math and reduce total worth
        foreach($years as $index=>$year){
          $year['geometricAverage'] = (1 + ($year['return'] / 100));
          $statistics['earnedIncome'] += ($years[($index == 0 ? 0 : $index -1)]['eoy'] < $years[($index == 0 ? 0 : $index -1)]['income'] ? $years[($index == 0 ? 0 : $index -1)]['eoy'] : $year['income']);
          $year['charges'] = 0;
          $year['fees'] = 0;
          $year['boy'] = 0;
          $year['eoy'] = 0;
          $year['toggled'] = false;
          $year['months'] = [];
          $previousRemaining = ( ($index==0||!$years[$index - 1]) ? $calculation['value'] : $years[$index - 1]['months'][11]['remaining']);//?????
          $fees = 0;

          //calculate statistics
          $statistics['averageReturn'] += $year['return'];
          $statistics['geometricAverage'] *= $year['geometricAverage'];

          //dynamic monthly values
          for($j = 1; $j<13; $j++){
            $month = [];
            $calculatedValue = ((1 + $year['return'] / 12 / 100) * $total['worth']) - $year['income'] / 12;
            $charge = $calculation['fee'] / 12 / 100 * $calculatedValue;
            $globalFee = $calculation['fee'] / 12 / 100;
            $remaining = ($calculatedValue - ($globalFee * $calculatedValue) < 0 ? 0 : $calculatedValue - ($globalFee * $calculatedValue));
            $monthlyCharge = $globalFee * $calculatedValue;

            $month['month'] = $j;
            $month['income'] = $year['income'] / 12;
            $month['fee'] = $globalFee;
            $month['interest'] = $year['return'] / 12 / 100;
            $month['value'] = $calculatedValue;
            $month['charge'] = ($monthlyCharge < 0 ? 0 : $monthlyCharge);
            $month['remaining'] = $remaining;

            $fees += $month['charge'];

            $month['previousRemaining'] = $previousRemaining;
            $month['fees'] = $fees;
            $statistics['lowestPrincipal'] = ($remaining < $statistics['lowestPrincipal'] ? $remaining : $statistics['lowestPrincipal']);
            if($statistics['lowestPrincipal']< 0){
              $statistics['lowestPrincipal'] = 0;
            }
            $total['worth'] = $remaining;
            $total['remaining'] -= $remaining;
            $previousRemaining = $month['remaining'];

            $year['months'][] = $month; // .push(month)
            
          }
          $years[$index] = $year;
         // var_dump($years[$index]['months'][11]['remaining']);
          //exit;
          //$years['months'][] = $year;

          foreach($year['months'] as $month){
            $year['charges'] += floatval($month['charge']);
          }

          $year['boy'] = ( ($index>0 && $years[$index - 1]) ? $years[$index - 1]['months'][11]['remaining'] : $calculation['value']); //??
          $year['fees'] += $year['charges'] + (($index>0 && $years[$index - 1]) ? $years[$index - 1]['fees'] : null);
          // last iteration will assign final net value
          
          //$aa = $years[$index]['months'];
          //var_dump($aa);
          //exit;
          $year['eoy'] = $statistics['actualAnnualizedYield'] = $years[$index]['months'][11]['remaining']; // ??

          if($year['eoy']< 0){
            $year['eoy'] = $statistics['actualAnnualizedYield'] = 0;
          }

          if($year['boy']<0){
            $year['boy'] = 0;
          }
           $years[$index] = $year;

           $table2JsonData[] = [$year['year'], $year['return'].'%', '$'.number_format($year['income']), '$'.number_format($year['charges'], 2), '$'.number_format($year['boy'], 2), '$'.number_format($year['eoy'], 2), '$'.number_format($year['fees'], 2)]; 
                        

          $statistics['totalAnnualizedYield'] = $year['eoy'];
          $statistics['finalNetValue'] = $year['eoy'];
        }

        calculateStatistics($statistics, $calculation);
        //return $table2JsonData;
        
    ?>    
        
<div class="table-responsive">
    <table id="calculations" class="table table-sm table-hover table-striped display" style="width: 100% !important;">
        <thead>
        <tr>
          <th scope="col">Year</th>
          <th scope="col">Annual Return</th>
          <th scope="col">Annual Withdrawal</th>
          <th scope="col">Mgmt. Fee</th>
          <th scope="col">Net Value BOY</th>
          <th scope="col">Net Value EOY</th>
          <th scope="col">Cumulative Fees </th>
        </tr>
        </thead>
    <tbody>
    </tbody>
    </table>
</div>

<script>
$(document).ready(function(){
    $('#calculations').DataTable({
        data: <?php echo json_encode($table2JsonData); ?>,
        responsive: true,
        "ordering": false,
        "paging": false,
        "searching": false,
        "info": false,
        //"processing": true,
        //"serverSide": true,
       // "ajax": "/site/homechartajax"
    });
} );

</script>
   
<?php    
      }
      
     function calculateStatistics($statistics, $calculation){
        $statistics['averageReturn'] = $statistics['averageReturn'] / $calculation['years'];
        // javascript does not support "y square root of x", but supports a second argument in "x to the power of y"
        $statistics['geometricAverage'] = (pow($statistics['geometricAverage'], (1 / $calculation['years'])) - 1) * 100;
        $statistics['actualAnnualizedYield'] = (pow($statistics['actualAnnualizedYield'] / $calculation['value'], (1 / $calculation['years'])) - 1) * 100;
        $statistics['totalAnnualizedYield'] = (pow(($statistics['totalAnnualizedYield'] + $statistics['earnedIncome']) / $calculation['value'], (1 / $calculation['years'])) - 1) * 100;
        $statistics['finalNetValue'] = $statistics['finalNetValue'] + $statistics['earnedIncome'];
        
        ?>
        <div class="table-responsive">
            <table class="table table-sm table-hover table-striped" style="width: 100% !important;">            
            <tbody>
            <tr>
               <th scope="row">Average Returns Less Fees</th><td><?= number_format($statistics['averageReturn'], 2) ?></td>
               <th scope="row">Lowest Account Value</th><td><?= number_format($statistics['lowestPrincipal'], 2) ?></td>
            </tr>
            <tr>
               <th scope="row">Annualized Return on Principal</th><td><?= number_format($statistics['actualAnnualizedYield'], 2) ?></td>
               <th scope="row">Annualized Return on Economic Output </th><td><?= number_format($statistics['totalAnnualizedYield'], 2) ?></td>
            </tr>
            <tr>
               <th scope="row">Total Portfolio Return</th><td><?= number_format($statistics['finalNetValue'], 2) ?></td>
               <th scope="row">Total Withdrawals</th><td><?= number_format($statistics['earnedIncome'], 2) ?></td>
            </tr>
            </tbody>
            </table>
        </div>
        
        <?php
        
        
        
        
        
        //return $statistics;
      }
      
    function  doTheMath($calculation, $showMarketHistory, $marketHistory){
        $years = [];
        // worth is a duplicate of income, so that the value can be manipulated
        $total['worth'] = $calculation['value'];

        $currentYear =  date("Y"); // new Date().getFullYear()
        $yearsRange = $calculation['years'];

        if($showMarketHistory){
          $currentYear = $marketHistory['from'];

          if(!$marketHistory['to']){
            $marketHistory['to'] = $marketHistory['from'];
          }

          if($marketHistory['from'] > $marketHistory['to']){
            $marketHistory['to'] = $marketHistory['from'];
          }

          $yearsRange = $marketHistory[to] - $marketHistory['from'];
          $calculation['years'] = $yearsRange;
        }

        // TODO - detect existing value and don't overwrite

        if(!$showMarketHistory){
          // years
          for($i = 0; $i < $yearsRange; $i++){
            $year = [];
            $year['year'] = $currentYear + $i;
            $year['return'] = $calculation['return'];
            $year['income'] = $calculation['income'];
            $year['toggled'] = false;
            
            $year['boy'] = 0;
            
            $year['eoy'] = 0;
            
            
            $year['geometricAverage'] = 0;
            $year['charges'] = 0;
            $year['fees'] = 0;
            
            $year['months'] = [];
            $years[] = $year; // .push(year)
          }

          calculateMonths($calculation, $years);
        }

/*
        if($showMarketHistory){
          fetch('/rates')
          .then(response => response.json())
          .then(data => {
            this.years = []
            data.forEach(year => {
              if (year['year'] < this.marketHistory.from) {
                return
              }

              if (year['year'] >= this.marketHistory.to) {
                return
              }

              year.return *= 100
              year.income = this.calculation.income
              this.years.push(year)
            })
            this.calculateMarketHistory()
          })
        }
*/        
        
        
        
      }
      
      
      
///////////////////////////////////////////////////////////////
$current_value = $_REQUEST['Calculations']['current_value']; 
$years_of_investment = $_REQUEST['Calculations']['years_of_investment'];
$annual_return_rate = $_REQUEST['Calculations']['annual_return_rate'];
$annual_withdrawal = $_REQUEST['Calculations']['annual_withdrawal'];
$management_fee = $_REQUEST['Calculations']['management_fee'];

    $loading = false; 
    $showMarketHistory = false; 
    $showBreakeven = false;
    $marketHistory=['from'=>2000, 'to'=>0];
    $total = ['worth'=>null, 'remaining'=>null];
    //$calculation = ['reference'=>null, 'value'=>null, 'years'=>null, 'return'=>null, 'income'=>null, 'fee'=>null];
    $calculation = ['reference'=>'test', 'value'=>$current_value, 'years'=>$years_of_investment, 'return'=>$annual_return_rate, 'income'=>$annual_withdrawal, 'fee'=>$management_fee]; 
     
    $statistics = ['averageReturn'=>0, 'geometricAverage'=>1, 'actualAnnualizedYield'=>0, 'earnedIncome'=>0, 'lowestPrincipal'=>0, 'optimalBreakeven'=>0];
    $years = []; 
    $demo = ['reference'=>'demo', 'value'=>100000, 'years'=>10, 'return'=>5, 'income'=>4000, 'fee'=>1];
    $breakevenCurrent=0;
    $breakevenYrs=0; 
    $breakevenIndex=0;
    $breakevenIncome=[];
    $breakevenErrors=[];
?>

<hr />
<div class="card bg-light mb-3">
  <div class="card-body">
<?php

doTheMath($calculation, $showMarketHistory, $marketHistory);

?>
  </div>
</div>
<?php


























?>



<?php
exit;
///////////////////////////////////////////////////////////////////////
function FV1($principal, $rate, $years){

    $futureValue = round($principal * pow(1 + ($rate/100), $years), 2);
    return $futureValue;
}


function FV($rate = 0, $nper = 0, $pmt = 0, $pv = 0, $type = 0) {

    // Validate parameters
    if ($type != 0 && $type != 1) {
        return False;
    }

    // Calculate
    if ($rate != 0.0) {
        return -$pv * pow(1 + $rate, $nper) - $pmt * (1 + $rate * $type) * (pow(1 + $rate, $nper) - 1) / $rate;
    } else {
        return -$pv - $pmt * $nper;
    }
} 

function pmt1($apr, $loanlength, $loanamount){
    $apr /= 1200;
    return ($apr * -$loanamount * pow((1 + $apr), $loanlength) / (1 - pow((1 + $apr), $loanlength)));
}


function PMT($rate = 0, $nper = 0, $pv = 0, $fv = 0, $type = 0) {
		//$rate	= PHPExcel_Calculation_Functions::flattenSingleValue($rate);
		//$nper	= PHPExcel_Calculation_Functions::flattenSingleValue($nper);
		//$pv		= PHPExcel_Calculation_Functions::flattenSingleValue($pv);
		//$fv		= PHPExcel_Calculation_Functions::flattenSingleValue($fv);
		//$type	= PHPExcel_Calculation_Functions::flattenSingleValue($type);

		// Validate parameters
		if ($type != 0 && $type != 1) {
			return False;
		}

		// Calculate
		if (!is_null($rate) && $rate != 0) {
			return (-$fv - $pv * pow(1 + $rate, $nper)) / (1 + $rate * $type) / ((pow(1 + $rate, $nper) - 1) / $rate);
		} else {
			return (-$pv - $fv) / $nper;
		}
	}


//$futureValue = $presentValue * pow(1 + $interestRate/ 100, $years);
//////////////////////////////////////////////////////////////////////////////////
//var_dump($_REQUEST['Calculations']);
$current_value = $_REQUEST['Calculations']['current_value']; 
$years_of_investment = $_REQUEST['Calculations']['years_of_investment'];
$annual_return_rate = $_REQUEST['Calculations']['annual_return_rate'];
$annual_withdrawal = $_REQUEST['Calculations']['annual_withdrawal'];
$management_fee = $_REQUEST['Calculations']['management_fee'];

$current_rear = date("Y");





$table = '';
$cumulative_fees[0] = 0;
//$net_value_eoy[0] = 0;

$i = 0;
for($y = $current_rear; $y<$current_rear+$years_of_investment; $y++){
    
    //$year[$i] = $current_rear;
    $year[$i] = $y;
    $delta[0] = 0;
    $annual_return[$i] = $annual_return_rate/1200;
    
    
    //if($i == 0 || $i==1){$annual_withdrawal_val[$i] = 0;}else{
    
    $annual_withdrawal_val[$i] = $annual_withdrawal;
    
    
    //}
     
    //$net_value_eoy = 
    
    //monthly calculations/
    for($m = 1; $m<13; $m++){
        
    
    
    }
    
    
    
    if($i == 0){
        $net_value_boy[$i] = $current_value;
        $mgmt_fee[$i] = $net_value_boy[$i]*($management_fee/100)*(1+$management_fee/1200);
        $net_value_eoy[$i] = FV($annual_return[$i], 12, 0, $mgmt_fee[$i]-$net_value_boy[$i], 0)-$annual_withdrawal_val[$i]*(1+$annual_return[$i]);
        
        //echo FV(1000000, $annual_return_rate/12, 1);
    }else{
        $net_value_boy[$i] = $net_value_eoy[$i-1];
        $mgmt_fee[$i] = $net_value_boy[$i]*($management_fee/100)*(1+$management_fee/1200);
        $net_value_eoy[$i] = FV($annual_return[$i], 12, 0, $annual_withdrawal_val[$i]+$mgmt_fee[$i]-$net_value_boy[$i], 0)-$delta[$i-1];
    }
    
    
    
    //$pmt = PMT($annual_return[$i], 12, -$annual_withdrawal_val[$i], 0, 0);//  pmt($annual_return_rate/1200, 12, $annual_withdrawal_val[$i]);
    if($i==0){
        $cumulative_fees[$i] = $mgmt_fee[$i];
    }else{
        $cumulative_fees[$i] = $cumulative_fees[$i-1] + $mgmt_fee[$i];
      //  $net_value_eoy[$i] = FV($annual_return[$i], 12, 0, -$net_value_boy[$i], 0);
    }
    $delta[$i] = $net_value_eoy[0]-$net_value_boy[0];
   /* 
    if($i==0){
        $delta[$i] = $net_value_eoy[$i]-$net_value_boy[$i];
    }else{
        $delta[$i] = $delta[$i-1];
    }*/
   // if($i<2){
    
    //}else{
    //$net_value_eoy[$i] = FV($annual_return[$i], 12, 0, -$net_value_boy[$i], 0)-$net_value_boy[$i-1]+$current_value;//-FV($annual_return_rate/1200, 12, 0, -$pmt, $type = 0);  // FV($net_value_boy[$i] , $annual_return_rate/12, 12)- $annual_withdrawal_val[$i];
    //}
    
   //$cagr  = ( $net_value_eoy[$i] /$net_value_eoy[$i-1] ) ^ (1/$years_of_investment) - 1;
    
    
    
    
    
    
    
    
   
    
    
    
    
    
    $table .= '<tr><th scope="row">'.$year[$i].'</th>
               <td>'.number_format($annual_return[$i]*1200).'%</td>
               <td>$'.number_format($annual_withdrawal_val[$i], 2).'</td>
               <td>$'.number_format($mgmt_fee[$i], 2).'</td>
               <td>$'.number_format($net_value_boy[$i], 2).'</td>
               <td>$'.number_format($net_value_eoy[$i], 2).'</td>
               <td>$'.number_format($cumulative_fees[$i], 2).'</td>
              </tr>';
    $i++;
}
?>
<div class="table-responsive">
    <table class="table table-sm table-hover table-striped" style="width: 100% !important;">
    <thead>
    <tr>
      <th scope="col">Year</th>
      <th scope="col">Annual Return</th>
      <th scope="col">Annual Withdrawal</th>
      <th scope="col">Mgmt. Fee</th>
      <th scope="col">Net Value BOY</th>
      <th scope="col">Net Value EOY</th>
      <th scope="col">Cumulative Fees </th>
    </tr>
    </thead>
    
    <tbody>
    <?=$table?>
    </tbody>
    </table>
</div>

