<?php
function smarty_modifier_suffix($string)
{
	$dotIndex = strrpos($string, '.');
	$suffix = strtolower(substr($string, $dotIndex + 1));
	return $suffix;
}
?>
