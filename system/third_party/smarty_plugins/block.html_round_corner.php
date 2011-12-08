<?php
/**
 * Smarty {html_round_corner} function plugin
 *
 * Type:     block<br>
 * Name:     html_round_corner<br>
 * Input:<br>
 *           - class          (optional) - string
 *           - borderonly     (optional) - boolean 
 * Purpose:  Output html for round corner
 * @return string
 */
function smarty_block_html_round_corner($params, $content, &$smarty, &$repeat)
{
	if ($repeat) {
		return;	// skip the first call for opening tag
	}

$output = <<<EOF
<div class="rc $params[class]">
	<div class="rce rct"><div class="rce rcr"></div></div>
	<table class="rcem rcm"><tr>
		<td class="vbw"></td>
		<td><div class="rci">
			$content
		</div></td>
		<td class="rcem vbw rcr"></td>
	</tr></table>
	<div class="rce rcb"><div class="rce corner rcr"></div></div>
</div>
EOF;

	return $output;
}

?>
