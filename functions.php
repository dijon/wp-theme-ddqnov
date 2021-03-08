<?php

add_theme_support('menus');

function wpb_ddqnov_menu() {
	register_nav_menus([
		'ddqnov-menu' => __('Ddqnov Menu'),
	]);
}
add_action('init', 'wpb_ddqnov_menu');