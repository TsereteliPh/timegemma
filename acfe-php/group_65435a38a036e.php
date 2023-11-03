<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_65435a38a036e',
	'title' => 'Цвет (атрибут)',
	'fields' => array(
		array(
			'key' => 'field_65435a39ce960',
			'label' => 'Цвет',
			'name' => 'color',
			'aria-label' => '',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'enable_opacity' => 0,
			'return_format' => 'string',
			'display' => 'default',
			'button_label' => 'Select Color',
			'color_picker' => 1,
			'absolute' => 0,
			'input' => 1,
			'allow_null' => 1,
			'theme_colors' => 0,
			'colors' => array(
			),
			'acfe_field_group_condition' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'pa_color',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'left',
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
	'modified' => 1698913003,
));

endif;