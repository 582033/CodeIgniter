<?php
/**
 * Smarty {embed_swf} function plugin
 *
 * Type:     function<br>
 * Name:     embed_swf<br>
 * Input:<br>
 *           - width      (optional) - integer
 *           - height     (optional) - integer 
 *           - url        (required) - string 
 * Purpose:  Embed a swf
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_embed_swf($params, &$smarty)
{
	$atts_first = array(
			'id',
			'class',
	);
	$atts_both = array(
			'width',
			'height',
	);

	$att_first = get_key_value_pair($atts_first, $params);
	$att_both = get_key_value_pair($atts_both, $params);
	$url = $params['url'];

	$atts_all = array_merge($atts_first, $atts_both, array('url'));
	$param_keys = array_diff(array_keys($params), $atts_all);
	$param_keys = array_merge(array(), $param_keys);

	$param_entries = array();
	foreach ($param_keys as $k) {
		$param_entries[] = "<param name=\"$k\" value=\"$params[$k]\" />";
	}
	$param_str = implode("\n", $param_entries);
	$att_param = get_key_value_pair($param_keys, $params);


    $result = <<<EOF
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" $att_first $att_both>
	<param name="movie" value="$url" />
	$param_str
	<!--[if !IE]>-->
	<object type="application/x-shockwave-flash" data="$url" $att_both $att_param>
	</object>
	<!--<![endif]-->
</object>
EOF;

    return $result;
}

function get_key_value_pair($keys, $data) {
	$entries = array();
	foreach ($keys as $k) {
		if (array_key_exists($k, $data)) {
			$entries[] = "$k='$data[$k]'";	
		}
	}
	return implode(' ', $entries);
}

?>
