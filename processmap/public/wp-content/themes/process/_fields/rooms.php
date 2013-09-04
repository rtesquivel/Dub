<?php

	register_field_group(array (
		'id' => 'acf_rooms',
		'title' => 'Rooms',
		'fields' => array (
			array (
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_5201a05ec1ef1',
				'label' => 'Room Name',
				'name' => 'rooms-name',
				'type' => 'text',
				'required' => 1,
			),
			array (
				'default_value' => '',
				'key' => 'field_5201cf3b59008',
				'label' => 'Seats',
				'name' => 'rooms-seats',
				'type' => 'number',
				'instructions' => 'If you need more people, bring some more chairs.',
			),
			array (
				'multiple' => 0,
				'allow_null' => 0,
				'choices' => array (
					'None' => 'None',
					'Phone Only' => 'Phone Only',
					'Audio Conferencing' => 'Audio Conferencing',
					'TV' => 'TV',
					'TV #2' => 'TV #2',
					'Video Conferencing' => 'Video Conferencing',
					'Whiteboard' => 'Whiteboard',
				),
				'default_value' => '',
				'key' => 'field_5201cfd07025b',
				'label' => 'Capabilities',
				'name' => 'rooms-capabilities',
				'type' => 'checkbox',
			),
			array (
				'multiple' => 0,
				'allow_null' => 0,
				'choices' => array (
					'Bookable Conference Room' => 'Bookable Conference Room',
					'Open Collab Area' => 'Open Collab Area',
					'Drop-in' => 'Drop-in',
				),
				'default_value' => '',
				'key' => 'field_520291955db27',
				'label' => 'Room Type',
				'name' => 'rooms-type',
				'type' => 'select',
			),
			array (
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_5201c65ed2946',
				'label' => 'Seat Number',
				'name' => 'rooms-seat-number',
				'type' => 'text',
			),

			array (
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_5201d68fa2935',
				'label' => 'Phone Number',
				'name' => 'rooms-phone-number',
				'type' => 'text',
			),

			array (
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'key' => 'field_522796f721971',
				'label' => 'Room Picture',
				'name' => 'rooms-picture',
				'type' => 'image',
			),
			
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'rooms',
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