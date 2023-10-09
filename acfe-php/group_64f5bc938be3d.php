<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_64f5bc938be3d',
	'title' => 'Настройки темы',
	'fields' => array(
		array(
			'key' => 'field_64f5bc949c6d2',
			'label' => 'Рекламный баннер коллекции в шапке',
			'name' => 'collection_banner',
			'aria-label' => '',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'collection',
			),
			'post_status' => array(
				0 => 'publish',
			),
			'taxonomy' => '',
			'return_format' => 'id',
			'multiple' => 0,
			'max' => '',
			'save_custom' => 0,
			'save_post_status' => 'publish',
			'acfe_add_post' => 0,
			'acfe_edit_post' => 0,
			'acfe_bidirectional' => array(
				'acfe_bidirectional_enabled' => '0',
			),
			'allow_null' => 0,
			'acfe_field_group_condition' => 0,
			'bidirectional' => 0,
			'ui' => 1,
			'bidirectional_target' => array(
			),
			'save_post_type' => '',
			'min' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'acfe_autosync' => array(
		0 => 'php',
	),
	'acfe_form' => 0,
	'acfe_display_title' => '',
	'acfe_meta' => '',
	'acfe_note' => '',
	'modified' => 1696854458,
));

endif;