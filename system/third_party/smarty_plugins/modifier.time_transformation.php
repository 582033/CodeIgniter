<?php
function smarty_modifier_time_transformation($times)
{
	if($times) {
		  $number=$times/3600;
		  if($number>=24&&$number%24==0) {
		     $t=($number/24)."d";
		  }else if($number/24<=1&&$number/24>=1/24&&$times%3600==0){
		      $t=$number."h";
		  }else if($times>=60&&$time<3600&&$times%60==0){
		      $t= ($times/60)."m";
		  }
		  else{
		     $t=$times."s"; 
		  }
		  return $t;
	      }
}
?>
