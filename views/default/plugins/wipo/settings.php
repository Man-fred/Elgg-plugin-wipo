<?php
/**
 * Wirtschaft und Politik Settings
 *
 * @package wipo
 * @author Man-fred
 * @copyright bcss 2015
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @website https://github.com/Man-fred
 * @email wipo@bcss.de
 */

// set default value for maximum number of online users to list
if (!isset($vars['entity']->user_listing_limit)) {
	$vars['entity']->user_listing_limit = 20;
}
$params = array(
	'name' => 'params[user_listing_limit]',
	'value' => $vars['entity']->user_listing_limit,
	'options' => array(10, 15, 20, 40, 80, 200),
);
$dropdown_user_listing_limit = elgg_view('input/dropdown', $params);

// set default for location of online users display
if (!isset($vars['entity']->display_option)) {
	$vars['entity']->display_option = 'top';
}
$params = array(
	'name' => 'params[display_option]',
	'value' => $vars['entity']->display_option,
	'options_values' => array(
		'top' => elgg_echo('wipo:settings:top'),
		'sidebar' => elgg_echo('wipo:settings:sidebar'),
		'both' => elgg_echo('wipo:settings:both'),
	),
);
$dropdown_display_option = elgg_view('input/dropdown', $params);

?>
<div>
	<?php echo elgg_echo('wipo:settings:user_listing_limit'); ?><br>
	<?php echo $dropdown_user_listing_limit; ?><br><br>
	<?php echo elgg_echo('wipo:settings:display_option'); ?><br>
	<?php echo $dropdown_display_option; ?>
</div>
