<?php
// Изменяем тулбар
add_filter('tiny_mce_before_init', 'change_toolbar');
function change_toolbar($args)
{
	$style_formats = [
		[
			'title' => 'Светлая кнопка',
			'selector' => 'a, button',
			'classes' => 'btn',
		],
		[
			'title' => 'Темная кнопка',
			'selector' => 'a, button',
			'classes' => 'btn btn--dark',
		],
		[
			'title' => 'Ненумерованный список',
			'selector' => 'ul',
			'classes' => 'article-ul',
		],
		[
			'title' => 'Нумерованный список',
			'selector' => 'ol',
			'classes' => 'article-ol',
		],
		[
			'title' => 'Стиль текста',
			'items' => [
				[
					'title' => 'Light',
					'selector' => 'ul, ol, a, p, span',
					'styles' => [
						'font-weight' => '300',
					],
				],
				[
					'title' => 'Regular',
					'selector' => 'ul, ol, a, p, span',
					'styles' => [
						'font-weight' => '400',
					],
				],
				[
					'title' => 'Medium',
					'selector' => 'ul, ol, a, p, span',
					'styles' => [
						'font-weight' => '500',
					],
				],
				[
					'title' => 'Bold',
					'selector' => 'ul, ol, a, p, span',
					'styles' => [
						'font-weight' => '700',
					],
				],
				[
					'title' => 'Black',
					'selector' => 'ul, ol, a, p, span',
					'styles' => [
						'font-weight' => '900',
					],
				],
			]
		]
	];
	$args['fontsize_formats'] = "6px 8px 10px 12px 14px 16px 18px 20px 22px 24px 28px 30px 32px 34px 36px 38px 40px 42px 44px 46px 48px 50px 52px 54px 56px 58px 60px 62px 64px 64px";
	$args['font_formats'] = "Playfair=Playfair, serif";
	$args['style_formats'] = json_encode($style_formats);

	return $args;
}

// Указываем пути конфигурации кнопок
function adem_tiny_mce_add_buttons($buttons_array)
{
	$buttons_config_path = get_template_directory_uri() . '/tmce-button.js';
	$buttons_array['custom_buttons'] = $buttons_config_path;

	return $buttons_array;
}

// Регистрируем добавленные кнопки
function adem_tiny_mce_register_buttons($buttons)
{
	array_push($buttons, 'custom_buttons');

	return $buttons;
}

function adem_tiny_mce_buttons()
{
	// Проверяем привилегии пользователя
	if (!current_user_can('edit_posts') &&
		!current_user_can('edit_pages')) {
		return;
	}

	if (get_user_option('rich_editing') !== 'true') {
		return;
	}

	add_filter('mce_external_plugins', 'adem_tiny_mce_add_buttons');
	add_filter('mce_buttons', 'adem_tiny_mce_register_buttons');
}

// Инициализация кнопок редактора
function adem_tiny_mce_setup()
{
	// Добавление кнопок
	add_action('init', 'adem_tiny_mce_buttons');
}

add_action('after_setup_theme', 'adem_tiny_mce_setup');


