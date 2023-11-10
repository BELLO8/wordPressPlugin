<?php

/**
 * Plugin Name: Elementor Test Addon
 * Description: Custom Elementor addon.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      BELLO KADER ADETOUDJI
 * Author URI:  https://github.com/BELLO8
 * Text Domain: elementor-test-addon
 * 
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Register oEmbed Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function elementor_test_addon($widgets_manager)
{

	require_once(__DIR__ . '/widgets/SermonWidget.php');
	require_once(__DIR__ . '/widgets/MoreBooks.php');
	require_once(__DIR__ . '/widgets/bookWidget.php');

	$widgets_manager->register(new \SermonWidget());
	$widgets_manager->register(new \MoreBooks());
	$widgets_manager->register(new \BookWidget());
}

function style()
{
	wp_register_style('bookStyle', plugins_url('assets/css/bookStyle.css', __FILE__));
	wp_register_style('bookColorStyle', plugins_url('assets/css/bookColorStyle.css', __FILE__));
	wp_register_style('sermons', plugins_url('assets/css/sermon.css', __FILE__));

	wp_enqueue_style('bookStyle');
	wp_enqueue_style('bookColorStyle');
	wp_enqueue_style('sermons');

}
add_action('elementor/frontend/after_enqueue_styles', 'style');
add_action('elementor/widgets/register', 'elementor_test_addon');
