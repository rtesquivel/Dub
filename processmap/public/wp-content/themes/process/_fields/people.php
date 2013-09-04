<?php

if(function_exists("register_field_group"))
{
	register_field_group(array(
		'id' => 'acf_people',
		'title' => 'People',
		'fields' => array(
			array(
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_51ef1f2d0a684',
				'label' => 'First Name',
				'name' => 'people-first-name',
				'type' => 'text',
				'required' => 1,
			),
			array(
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_51ef1f6d0a685',
				'label' => 'Last Name',
				'name' => 'people-last-name',
				'type' => 'text',
				'required' => 1,
			),
			array(
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_51ef1f7d0a686',
				'label' => 'Job Title',
				'name' => 'people-job-title',
				'type' => 'text',
				'required' => 1,
			),
			array(
				'post_type' => array(
					0 => 'teams',
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
				'key' => 'field_51ef1fda0a687',
				'label' => 'Team',
				'name' => 'people-team',
				'type' => 'relationship',
				'required' => 1,
			),
			array(
				'default_value' => '',
				'key' => 'field_51ef209c0a689',
				'label' => 'Date of Birth (Month)',
				'name' => 'people-date-of-birth-month',
				'type' => 'number',
				'instructions' => 'Enter the month in two-digit format please (e.g. January would be 01)',
			),
			array(
				'default_value' => '',
				'key' => 'field_51ef20d80a68a',
				'label' => 'Date of Birth (Day)',
				'name' => 'people-date-of-birth-day',
				'type' => 'number',
				'instructions' => 'Enter the day of the month in two-digit format (so the 2nd day of the month would be 02).',
			),
			array(
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
				'key' => 'field_51ef21760a68b',
				'label' => 'Date of Hire',
				'name' => 'people-date-of-hire',
				'type' => 'date_picker',
			),
			array(
				'default_value' => '',
				'key' => 'field_51ef22090a68e',
				'label' => 'Phone Extension',
				'name' => 'people-phone-extension',
				'type' => 'number',
			),
			array(
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_51ef22230a68f',
				'label' => 'Cell Number',
				'name' => 'people-cell-number',
				'type' => 'text',
			),
			array(
				'default_value' => 'email@duarte.com',
				'key' => 'field_51ef225f0a690',
				'label' => 'Email Address',
				'name' => 'people-email-address',
				'type' => 'email',
			),
			array(
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_51ef22910a691',
				'label' => 'IM Screen Name',
				'name' => 'people-im-screen-name',
				'type' => 'text',
			),
			array(
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_51ef22f30a692',
				'label' => 'Duarte.com Bio Page URL',
				'name' => 'people-bio-page-url',
				'type' => 'text',
				'instructions' => 'Find their bio page on Duarte.com and Copy/Paste the link here (that way we can pull their photo and bio questions).',
			),
			array(
				'default_value' => '',
				'key' => 'field_51ef467e21545',
				'label' => 'Seat Number',
				'name' => 'people-seat-number',
				'type' => 'text',
			),
			array(
				'multiple' => 0,
				'allow_null' => 0,
				'choices' => array(
					'Silicon Valley' => 'Silicon Valley',
					'Chico' => 'Chico',
					'Austin' => 'Austin',
					'Remote' => 'Remote',
					'' => '',
				),
				'default_value' => '',
				'key' => 'field_51f6cfbc499dc',
				'label' => 'Location',
				'name' => 'people-location',
				'type' => 'select',
				'instructions' => 'Where does this person work from?',
				'required' => 1,
			),
			array(
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_peoplbiophoto',
				'label' => 'Bio Image',
				'name' => 'people-bio-photo',
				'type' => 'text',
				'instructions' => '****Auto detected on save!',
			),

		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'people',
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

?>