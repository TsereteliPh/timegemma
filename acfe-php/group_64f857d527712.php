<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_64f857d527712',
	'title' => 'Block:mailing',
	'fields' => array(
		array(
			'key' => 'field_64f857d62448b',
			'label' => 'Заголовок',
			'name' => 'title',
			'aria-label' => '',
			'type' => 'textarea',
			'instructions' => 'Текст заголовка другого цвета должен быть внутри тега "span"',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Erhalten <span>Sie 10 %</span> Rabatt auf Ihre erste Bestellung',
			'acfe_textarea_code' => 0,
			'maxlength' => '',
			'rows' => 3,
			'placeholder' => '',
			'new_lines' => '',
			'acfe_field_group_condition' => 0,
		),
		array(
			'key' => 'field_64f858d52448c',
			'label' => 'Текст',
			'name' => 'text',
			'aria-label' => '',
			'type' => 'textarea',
			'instructions' => 'Размер скидки должен быть внутри тега "span"',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Abonnieren Sie unseren Newsletter und erhalten Sie einen Rabattcode von <span>10 %</span> für Ihre erste Bestellung.',
			'acfe_textarea_code' => 0,
			'maxlength' => '',
			'rows' => 3,
			'placeholder' => '',
			'new_lines' => '',
			'acfe_field_group_condition' => 0,
		),
		array(
			'key' => 'field_64f8596c2448d',
			'label' => 'Название социальной сети',
			'name' => 'label',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Instagram',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'acfe_field_group_condition' => 0,
		),
		array(
			'key' => 'field_64f859982448e',
			'label' => 'Ссылка на социальную сеть',
			'name' => 'link',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'acfe_field_group_condition' => 0,
		),
		array(
			'key' => 'field_64f85b7383022',
			'label' => 'Фоновое изображение',
			'name' => 'background',
			'aria-label' => '',
			'type' => 'image',
			'instructions' => 'Оставить пустым, чтобы использовать стандартное',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'uploader' => '',
			'acfe_thumbnail' => 0,
			'return_format' => 'url',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
			'preview_size' => 'medium',
			'acfe_field_group_condition' => 0,
			'library' => 'all',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => false,
	'description' => '',
	'show_in_rest' => 0,
	'acfe_autosync' => array(
		0 => 'php',
	),
	'acfe_form' => 0,
	'acfe_display_title' => '',
	'acfe_meta' => '',
	'acfe_note' => '',
	'modified' => 1701969740,
));

endif;