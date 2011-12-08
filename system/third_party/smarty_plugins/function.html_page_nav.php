<?php
/**
 * Smarty {html_page_nav} function plugin
 *
 * Type:     function<br>
 * Name:     html_page_nav<br>
 * Input:<br>
 *           - cpage   (required) - integer
 *           - tpage   (required) - integer
 *           - maxshow (required) - integer
 *           - pageurl (optional) - string
 *           - total   (optional) - integer, if not set, don't show total stat
 *           - show_end  - false/true, show first/last page or not
 *           - show_not_available  - false/true, whether to show prev page if already in the first page
 *
 * Purpose: Show page nav
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_html_page_nav($params, &$smarty)
{
	$cpage = $params['cpage'];
	$tpage = $params['tpage'];
	$maxshow = $params['maxshow'];
	$total = element('total', $params);
	$pageurl = $params['pageurl'];
	$unit = element('unit', $params, '个');
	$show_end = element('show_end', $params);
	$show_not_available = element('show_not_available', $params);
	$half = floor($maxshow/2);

	$spans = array();
	if ($total) {
		$spans[] = "<span class='total'>共<span class='d'>{$tpage}</span>页 <span class='d'>{$total}</span>$unit</span>";
	}
	if ($cpage != 1) {
		$prev = $cpage - 1;
		if ($show_end) {
			$spans[] = get_a($pageurl, 1, '首页', 'pn');
		}
		$spans[] = get_a($pageurl, $prev, '上一页', 'pn');
	}
	else {
		if ($show_not_available) {
			if ($show_end) {
				$spans[] = "<span class='pn'>首页</span>";
			}
			$spans[] = "<span class='pn'>上一页</span>";
		}
	}

	$sp = max(1, $cpage - $half);
	$ep = min($tpage, $cpage + $half);
	for ($p=$sp; $p <= $ep; $p++) {
		if ($p == $cpage) {
			$spans[] = "<span class='cp'>$p</span>";
		}
		else {
			$spans[] = get_a($pageurl, $p, $p, 'p');
		}
	}
	if ($cpage != $tpage) {
		$next = $cpage + 1;
		$spans[] = get_a($pageurl, $next, '下一页', 'pn');
		if ($show_end) {
			$spans[] = get_a($pageurl, $tpage, '尾页', 'pn');
		}
	}
	else {
		if ($show_not_available) {
			$spans[] = "<span class='pn'>下一页</span>";
			if ($show_end) {
				$spans[] = "<span class='pn'>尾页</span>";
			}
		}
	}

	$pagestr = implode('', $spans);

    $result = <<<EOF
<div class="pagenav">
	$pagestr
</div>
EOF;

    return $result;
}

function get_a($pageurl, $page, $pagedesc, $class) {
	$href = preg_replace('/{page}/', "$page", $pageurl);
	if (!$href) $href = "#";
	return "<a href=\"$href\" class=\"$class\">$pagedesc</a>";
}

if (!function_exists('element')) {
	function element($item, $array, $default = FALSE)
	{
		if ( ! isset($array[$item]) OR $array[$item] == "")
		{
			return $default;
		}

		return $array[$item];
	}
}

?>
