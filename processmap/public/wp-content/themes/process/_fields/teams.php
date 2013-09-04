<?php

if(function_exists("register_field_group")) {
	register_field_group(array(
		'id' => 'acf_teams',
		'title' => 'Teams',
		'fields' => array(
			array(
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_51ef47f715964',
				'label' => 'Team Number / Name',
				'name' => 'teams-name',
				'type' => 'text',
				'instructions' => 'This should match the "Title" field up top. Sorry for the double-entry, we\'ll work to improve this in the future.',
				'required' => 1,
			),
			array(
				'post_type' => array(
					0 => 'people',
				),
				'max' => '',
				'taxonomy' => array(
					0 => 'all',
				),
				'filters' => array(
					0 => 'search',
				),
				'result_elements' => array(
					0 => 'post_type',
					1 => 'post_title',
				),
				'key' => 'field_51ef48db15965',
				'label' => 'Team Leader',
				'name' => 'teams-leader',
				'type' => 'relationship',
			),
			array(
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_51ef496a15966',
				'label' => 'Team Description',
				'name' => 'teams-description',
				'type' => 'text',
				'instructions' => 'What is the main function? Who are the main clients?',
			),
			array(
				'multiple' => 0,
				'allow_null' => 0,
				'choices' => array(
					'Academy' => 'Academy',
					'Agency' => 'Agency',
					'Corporate' => 'Corporate',
				),
				'default_value' => '',
				'key' => 'field_51ef49d115967',
				'label' => 'Group',
				'name' => 'teams-group',
				'type' => 'select',
				'required' => 1,
			),
			array(
				'post_type' => array(
					0 => 'people',
				),
				'max' => '',
				'taxonomy' => array(
					0 => 'all',
				),
				'filters' => array(
					0 => 'search',
				),
				'result_elements' => array(
					0 => 'post_type',
					1 => 'post_title',
				),
				'key' => 'field_51f1bdb64112b',
				'label' => 'VP',
				'name' => 'teams-vp',
				'type' => 'relationship',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'teams',
					'order_no' => 0,
					'group_no' => 0,
					),
				),
			),
		'options' => array(
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array(
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
}