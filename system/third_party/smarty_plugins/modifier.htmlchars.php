<?php
function smarty_modifier_htmlchars($string)
{
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>
