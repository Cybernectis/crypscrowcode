<?php
// function get_time_zone(){
//     	$output = "";
//     	$output = '<option>Select</option>';

//     	for ($i=-12; $i <= 14 ; $i++) { 
//     		echo $i;
//     		if($i >= 0){
//     			$output .= "<option value=\"GMT{$i}\">" . "GMT+".$i .'</option>';
//     		}
//     		else{
//     			$output .= "<option value=\"GMT{$i}\">" . "GMT".$i .'</option>';
//     		}
//     	}
//     	echo $output;
//     }


//     get_time_zone();


// $url = "http://localhost:3000/merchant/9fb10ec0-4018-4cc2-8aff-5dc1fac053f8/balance?password=1@administrator@1&api_code=f7f9c6b2-af2d-474d-a575-1c7fb28516f3";
// $ch  = curl_init();
// curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
// curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
// curl_setopt($ch,CURLOPT_URL,$url);
// $ccc = curl_exec($ch);
// $json= json_decode($ccc,true);
// echo "<pre>";
// print_r($json);
// echo "</pre>";