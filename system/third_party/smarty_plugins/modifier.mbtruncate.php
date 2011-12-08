<?php
function smarty_modifier_mbtruncate($string, $count, $trail = "...")
{
	if ($count >= mb_strlen($string, 'UTF-8'))
		return $string;
	$res = mb_substr($string, 0, $count, 'UTF-8');
	return  "$res$trail";
}
?>
