<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_6572d136acb44',
	'title' => 'Block:contacts',
	'fields' => array(
		array(
			'key' => 'field_6572d136c4f9d',
			'label' => 'Заголовок',
			'name' => 'title',
			'aria-label' => '',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'table',
			'acfe_seamless_style' => 0,
			'acfe_group_modal' => 0,
			'acfe_field_group_condition' => 0,
			'acfe_group_modal_close' => 0,
			'acfe_group_modal_button' => '',
			'acfe_group_modal_size' => 'large',
			'sub_fields' => array(
				array(
					'key' => 'field_6572d136df66e',
					'label' => 'Текст',
					'name' => 'text',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '80',
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
					'key' => 'field_6572d136e3201',
					'label' => 'Тип',
					'name' => 'type',
					'aria-label' => '',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
					),
					'default_value' => false,
					'return_format' => 'value',
					'multiple' => 0,
					'max' => '',
					'prepend' => '',
					'append' => '',
					'allow_null' => 0,
					'ui' => 0,
					'acfe_field_group_condition' => 0,
					'ajax' => 0,
					'placeholder' => '',
					'allow_custom' => 0,
					'search_placeholder' => '',
					'min' => '',
				),
			),
		),
		array(
			'key' => 'field_6572d1c91033b',
			'label' => 'Выходные данные в соответствии с разделом 5 TMG',
			'name' => 'output',
			'aria-label' => '',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'acfe_textarea_code' => 0,
			'maxlength' => '',
			'rows' => 4,
			'placeholder' => '',
			'new_lines' => 'br',
			'acfe_field_group_condition' => 0,
		),
		array(
			'key' => 'field_6572d20a1033c',
			'label' => 'Представитель',
			'name' => 'representative',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
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
			'key' => 'field_6572d2551033d',
			'label' => 'Идентификационный номер налогоплательщика',
			'name' => 'vat',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
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
			'key' => 'field_6572d5d41033e',
			'label' => 'Разрешение споров в ЕС',
			'name' => 'resolution',
			'aria-label' => '',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'acfe_textarea_code' => 0,
			'maxlength' => '',
			'rows' => 4,
			'placeholder' => '',
			'new_lines' => 'br',
			'acfe_field_group_condition' => 0,
		),
		array(
			'key' => 'field_6572e97a6565a',
			'label' => 'Карта',
			'name' => 'map',
			'aria-label' => '',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => array(
				'address' => 'Leipziger Pl. 8, 10117 Berlin, Германия',
				'lat' => 52.508794138782896,
				'lng' => 13.378629412515938,
				'zoom' => 16,
				'place_id' => 'ChIJ2zO4us5RqEcRChNRhtztRQg',
				'street_number' => '8',
				'street_name' => 'Leipziger Platz',
				'street_name_short' => 'Leipziger Pl.',
				'city' => 'Berlin',
				'state' => 'Berlin',
				'state_short' => 'BE',
				'post_code' => '10117',
				'country' => 'Германия',
				'country_short' => 'DE',
			),
			'center_lat' => '46.4519675',
			'center_lng' => '3.3221324',
			'height' => 400,
			'acfe_google_map_zooms' => array(
				'zoom' => '2',
				'min_zoom' => '0',
				'max_zoom' => '21',
			),
			'acfe_google_map_marker_icon' => '',
			'acfe_google_map_marker_width' => 50,
			'acfe_google_map_type' => 'roadmap',
			'acfe_google_map_disable_ui' => 0,
			'acfe_google_map_disable_zoom_control' => 0,
			'acfe_google_map_disable_map_type' => 0,
			'acfe_google_map_disable_fullscreen' => 0,
			'acfe_google_map_disable_streetview' => 0,
			'acfe_google_map_style' => '[
	{
		"elementType": "geometry",
		"stylers": [
			{
				"color": "#212121"
			}
		]
	},
	{
		"elementType": "labels.icon",
		"stylers": [
			{
				"visibility": "off"
			}
		]
	},
	{
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": "#757575"
			}
		]
	},
	{
		"elementType": "labels.text.stroke",
		"stylers": [
			{
				"color": "#212121"
			}
		]
	},
	{
		"featureType": "administrative",
		"elementType": "geometry",
		"stylers": [
			{
				"color": "#757575"
			}
		]
	},
	{
		"featureType": "administrative.country",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": "#9e9e9e"
			}
		]
	},
	{
		"featureType": "administrative.land_parcel",
		"stylers": [
			{
				"visibility": "off"
			}
		]
	},
	{
		"featureType": "administrative.locality",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": "#bdbdbd"
			}
		]
	},
	{
		"featureType": "landscape",
		"elementType": "geometry",
		"stylers": [
			{
				"visibility": "on"
			},
			{
				"weight": 5
			}
		]
	},
	{
		"featureType": "landscape",
		"elementType": "geometry.fill",
		"stylers": [
			{
				"visibility": "on"
			}
		]
	},
	{
		"featureType": "landscape",
		"elementType": "geometry.stroke",
		"stylers": [
			{
				"color": "#bababa"
			}
		]
	},
	{
		"featureType": "landscape",
		"elementType": "labels.icon",
		"stylers": [
			{
				"color": "#ffeb3b"
			}
		]
	},
	{
		"featureType": "landscape",
		"elementType": "labels.text",
		"stylers": [
			{
				"color": "#bababa"
			}
		]
	},
	{
		"featureType": "poi",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": "#757575"
			}
		]
	},
	{
		"featureType": "poi.park",
		"elementType": "geometry",
		"stylers": [
			{
				"color": "#181818"
			}
		]
	},
	{
		"featureType": "poi.park",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": "#616161"
			}
		]
	},
	{
		"featureType": "poi.park",
		"elementType": "labels.text.stroke",
		"stylers": [
			{
				"color": "#1b1b1b"
			}
		]
	},
	{
		"featureType": "road",
		"elementType": "geometry.fill",
		"stylers": [
			{
				"color": "#2c2c2c"
			}
		]
	},
	{
		"featureType": "road",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": "#8a8a8a"
			}
		]
	},
	{
		"featureType": "road.arterial",
		"elementType": "geometry",
		"stylers": [
			{
				"color": "#373737"
			}
		]
	},
	{
		"featureType": "road.highway",
		"elementType": "geometry",
		"stylers": [
			{
				"color": "#3c3c3c"
			}
		]
	},
	{
		"featureType": "road.highway.controlled_access",
		"elementType": "geometry",
		"stylers": [
			{
				"color": "#4e4e4e"
			}
		]
	},
	{
		"featureType": "road.local",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": "#616161"
			}
		]
	},
	{
		"featureType": "transit",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": "#757575"
			}
		]
	},
	{
		"featureType": "water",
		"elementType": "geometry",
		"stylers": [
			{
				"color": "#000000"
			}
		]
	},
	{
		"featureType": "water",
		"elementType": "geometry.fill",
		"stylers": [
			{
				"color": "#000000"
			}
		]
	},
	{
		"featureType": "water",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": "#3d3d3d"
			}
		]
	}
]',
			'acfe_google_map_key' => 'AIzaSyDhlvqkrb22U3VUkRtMMg5_VSEMeKvHqec',
			'acfe_field_group_condition' => 0,
			'zoom' => '2',
			'acfe_google_map_marker_height' => 50,
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
	'modified' => 1702043761,
));

endif;