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

$title = elgg_echo('wipo:online');
if ($wipo) {
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

		$body .= "<div class='elgg-avatar elgg-avatar-tiny'>";
		$body .= elgg_view('output/url', array(
			'href' => $user->getURL(),
			'text' => $icon,
			'is_trusted' => true,
			'class' => "elgg-avatar elgg-avatar-tiny $class",
		));
		$body .= elgg_view_icon('hover-menu');
		$body .= elgg_view_menu('user_hover', array('entity' => $user, 'username' => $username, 'name' => $name));
		$body .= "</div>";
	}
} else {
	$body = '<p>' . elgg_echo('wipo:noonline') . '</p>';
}

echo elgg_view_module('aside', $title, $body);
