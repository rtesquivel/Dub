<?php
/*
Plugin Name: Duarte Process Micro Site
Plugin URI: http://www.duarte.com/
Description: Customizations and enhancements
Version: 1.0
Author: Chris Iufer
Author URI: http://www.duarte.com
*/

namespace Duarte\Process;

class Process
{

	public function init(){

		// add post types
		self::create_studio_post_type();
		self::create_factory_post_type();
		// self::create_artifact_taxonomy();

		add_action('admin_menu', "Duarte\Process\Process::adjust_admin_menu");
		add_action('admin_menu', "Duarte\Process\Process::add_options_menu");
		
		add_action('edit_post', 'Duarte\Process\Process::w3_flush_page_custom', 10, 1 );

	}

	public function admin_init(){
		add_action('admin_enqueue_scripts', function(){
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('process-options', plugins_url('options.js', __FILE__), array('wp-color-picker'), false, true );
		});
		// add_settings_section('process-colors-section','');
		// add_settings_field();
		register_setting('process-group', 'process-colors-1');
		register_setting('process-group', 'process-keywords-1');
		register_setting('process-group', 'process-colors-2');
		register_setting('process-group', 'process-keywords-2');
		register_setting('process-group', 'process-colors-3');
		register_setting('process-group', 'process-keywords-3');
		register_setting('process-group', 'process-colors-4');
		register_setting('process-group', 'process-keywords-4');
		register_setting('process-group', 'process-colors-5');
		register_setting('process-group', 'process-keywords-5');
		register_setting('process-group', 'process-colors-6');
		register_setting('process-group', 'process-keywords-6');
		register_setting('process-group', 'process-colors-7');
		register_setting('process-group', 'process-keywords-7');
		register_setting('process-group', 'process-colors-8');
		register_setting('process-group', 'process-keywords-8');

		add_filter('edit_studio_per_page', function(){
			return 100;
		});
		add_filter('edit_factory_per_page', function(){
			return 100;
		});
	}

	public function activate(){

	}

	public function deactivate(){

	}

	public function uninstall(){
		// delete custom posts
	}

	public function create_studio_post_type(){
		register_post_type('studio',
			array(
				'labels' => array('name'=>"Studio"),
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'menu_position' => 5,
				'has_archive' => false,
				'exclude_from_search' => false,
				'capability_type' => 'page',
				'rewrite' => array('slug'=>'studio', 'with_front'=>true),
				'hierarchical' => true,
				'supports' => array('title','editor','page-attributes','revisions','comments')
			)
		);
	}

	public function create_factory_post_type(){
		register_post_type('factory',
			array(
				'labels' => array('name'=>"Factory"),
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'menu_position' => 5,
				'has_archive' => false,
				'exclude_from_search' => false,
				'capability_type' => 'page',
				'rewrite' => array('slug'=>'factory', 'with_front'=>true),
				'hierarchical' => true,
				'supports' => array('title','editor','page-attributes','revisions','comments')

			)
		);
	}

	// Purge page data if the post being edited is a custom post
	function w3_flush_page_custom( $post_id ) {
		if(function_exists('w3tc_pgcache_flush')) {
			$type = get_post_type( $post_id );
			if(in_array($type, array("studio","factory"))) {
				w3tc_pgcache_flush();
				return;
			}
		}		
	}

	// Don't permanently remove or strip Posts and Pages but just hide them
	public function adjust_admin_menu(){		
		// hide Posts
		// remove_menu_page('edit.php');
		// hide Pages
		//remove_menu_page('edit.php?post_type=page');
		// hide comments
		//remove_menu_page('edit-comments.php');
	}

	public function add_options_menu(){
		add_options_page('Process Auto Highlight Colors','Auto Highlight','manage_options','process',"\Duarte\Process::show_color_options");
	}

	public function show_color_options(){		
		include("color-options.php");
	}	

}

register_activation_hook(__FILE__, "Duarte\Process\Process::activate" );
register_deactivation_hook(__FILE__, "Duarte\Process\Process::deactivate" );
register_uninstall_hook(__FILE__, "Duarte\Process\Process::uninstall" );

add_action('init', "Duarte\Process\Process::init");
add_action('admin_init', "Duarte\Process\Process::admin_init");
