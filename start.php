<?php
/**
 * Users Online
 *
 * @package game_gum
 * @author iionly
 * @copyright iionly 2014
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @website https://github.com/
 * @email gum@bielemeier.de
 */

elgg_register_event_handler('init', 'system', 'game_gum_init');
// Add a new menu item to the site main menu
elgg_register_menu_item('site', array(
        'name' => 'GuM',
        'text' => 'Geld und Macht',
        'href' => '/firma/id',
));
elgg_register_page_handler('firma', 'game_gum_firma_handler');

function game_gum_firma_handler(array $segments) {
	echo elgg_view('blog/all');

	// in page handlers, return true says, "we've handled this request"
	return true;
}

function game_gum_init() {
	elgg_extend_view('css/elgg', 'game_gum/css');
	if (elgg_is_logged_in()) {
		$display_option = elgg_get_plugin_setting('display_option', 'game_gum');
		if (!display_option) {
			$display_option = 'top';
		}
		if ($display_option == 'top') {
			elgg_extend_view('page/elements/body', 'game_gum/users_online', 400);
		} else if ($display_option == 'sidebar') {
			elgg_extend_view('page/elements/sidebar', 'game_gum/sidebar');
		} else {
			elgg_extend_view('page/elements/body', 'game_gum/users_online', 400);
			elgg_extend_view('page/elements/sidebar', 'game_gum/sidebar');
		}
	}
}
