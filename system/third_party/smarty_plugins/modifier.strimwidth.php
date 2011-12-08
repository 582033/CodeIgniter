<?php
function smarty_modifier_strimwidth($string, $width, $trail = "..")
{
	$res = mb_strimwidth($string, 0, $width, $trail, 'UTF-8');
	return $res;
}
?>
