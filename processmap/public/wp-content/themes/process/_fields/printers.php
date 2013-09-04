<?php

register_field_group(array (
		'id' => 'acf_printers',
		'title' => 'Printers',
		'fields' => array (
			array (
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_5201a3522330c',
				'label' => 'Printer Name',
				'name' => 'printers-name',
				'type' => 'text',
			),
			array (
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_5201a3632330d',
				'label' => 'IP Address',
				'name' => 'printers-address',
				'type' => 'text',
			),
			array (
				'default_value' => 0,
				'message' => '',
				'key' => 'field_5201a37e2330e',
				'label' => 'Color Printing?',
				'name' => 'printers-color',
				'type' => 'true_false',
			),
			array (
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_5201a3f94cb36',
				'label' => 'Seat Number',
				'name' => 'printers-seat-number',
				'type' => 'text',
			),
			array (
				'default_value' => '',
				'formatting' => 'br',
				'key' => 'field_5201a3e22330f',
				'label' => 'Notes',
				'name' => 'printers-notes',
				'type' => 'textarea',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'printers',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	