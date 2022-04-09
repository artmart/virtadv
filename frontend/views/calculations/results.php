<?php
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

