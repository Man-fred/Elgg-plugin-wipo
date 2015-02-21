<?php
/**
 * Wirtschaft und Politik
 *
 * @package wipo
 * @author Man-fred
 * @copyright bcss 2015
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @website https://github.com/Man-fred
 * @email wipo@bcss.de
 */

// limit number of users to be displayed
$limit = elgg_get_plugin_setting('user_listing_limit', 'wipo');
if (!$limit) {
	$limit = 20;
}
// active users within the last 5 minutes
$wipo = find_active_users(array('seconds' => 300, 'limit' => $limit));

$visitors = "<div><table border='0' class='usersonline' cellspacing='0' cellpadding='0'><tr>";
$visitors .= "<td class='usersonlinetext'><h3>".elgg_echo('wipo:online')."</h3></td>";
if($wipo) {
	$visitors .= "<td>";
	foreach($wipo as $user) {
		$spacer_url = elgg_get_site_url() . '_graphics/spacer.gif';
		$name = htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8', false);
		$username = $user->username;
		$icon_url = elgg_format_url($user->getIconURL('tiny'));
		$icon = elgg_view('output/img', array(
			'src' => $spacer_url,
			'alt' => $name,
			'title' => $name,
			'class' => '',
			'style' => "background: url($icon_url) no-repeat;",
		));
		if ($user->isFriend()) {
			$class = "usersonlinefriendicon";
		} else {
			$class = "usersonlineicon";
		}

		$visitors .= "<div class='elgg-avatar elgg-avatar-tiny'>";
		$visitors .= elgg_view('output/url', array(
			'href' => $user->getURL(),
			'text' => $icon,
			'is_trusted' => true,
			'class' => "elgg-avatar elgg-avatar-tiny $class",
		));
		$visitors .= elgg_view_icon('hover-menu');
		$visitors .= elgg_view_menu('user_hover', array('entity' => $user, 'username' => $username, 'name' => $name));
		$visitors .= "</div>";
		
	}
	$visitors .= "</td>";
} else {
	$visitors .= "<td class='usersonlinetext'>".elgg_echo('wipo:noonline')."</td>";
}
$visitors .= "</tr></table></div>";

echo "<div align='center' class='mtm mbm'>";
echo $visitors;
echo "</div>";
