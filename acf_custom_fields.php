<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_faq-block',
		'title' => 'FAQ Block',
		'fields' => array (
			array (
				'key' => 'field_547cc5414600c',
				'label' => 'Media Content?',
				'name' => 'media_content',
				'type' => 'radio',
				'choices' => array (
					'None' => 'None',
					'Images' => 'Images',
					'Videos' => 'Videos',
					'Both' => 'Both',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_547cc464d5abf',
				'label' => 'FAQ Images',
				'name' => 'faq_images',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_547cc5414600c',
							'operator' => '==',
							'value' => 'Images',
						),
						array (
							'field' => 'field_547cc5414600c',
							'operator' => '==',
							'value' => 'Both',
						),
					),
					'allorany' => 'any',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_547cc489d5ac0',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add New Image',
			),
			array (
				'key' => 'field_547cc5fc598b1',
				'label' => 'YouTube Video',
				'name' => 'youtube_video',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_547cc5414600c',
							'operator' => '==',
							'value' => 'Videos',
						),
						array (
							'field' => 'field_547cc5414600c',
							'operator' => '==',
							'value' => 'Both',
						),
					),
					'allorany' => 'any',
				),
				'default_value' => '',
				'placeholder' => 'https://www.youtube.com/watch?v=A1m9DhGiLxk',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'mdc_faq',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
