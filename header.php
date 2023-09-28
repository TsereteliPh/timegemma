<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header<?php echo ( is_front_page() ) ? ' header--index' : ''; ?>">
	<div class="container">
		<div class="header__wrapper">
			<button class="header__burger" type="button" aria-label="Menü öffnen">
				<span></span>
			</button>

			<a href="<?php echo bloginfo( 'url' ); ?>" class="header__link" aria-label="Link zur Hauptseite"></a>

			<?php wp_nav_menu(array(
				'theme_location' => 'menu_main',
				'container' => '',
				'menu_id' => 'menu-main',
				'menu_class' => 'reset-list header__menu'
			)); ?>

			<div class="header__panel">
				<button class="header__search-btn" aria-label="Suchleiste öffnen" data-fancybox data-src="#search">
					<svg width="18" height="18"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-search"></use></svg>
				</button>

				<a href="<?php //todo: add fav link ?>" class="header__favorites" aria-label="Favoriten öffnen">
					<svg width="20" height="18"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-heart"></use></svg>
				</a>

				<a href="<?php echo wc_get_cart_url(); ?>" class="header__cart-link" aria-label="Warenkorb öffnen">
					<svg width="18" height="20"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-cart"></use></svg>

					<span class="header__cart-counter">2</span><?php //todo: implement counter ?>
				</a>

				<button class="header__profile <?php //todo: add profile btn ?>" aria-label="Profil öffnen">
					<svg width="18" height="18"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-profile"></use></svg>
				</button>
			</div>
		</div>
	</div>
</header>

<?php
	$mainClass = 'main';
	if ( is_front_page() ) {
		$mainClass .= ' main--index';
	}
?>

<main class="<?php echo $mainClass; ?>">
<?php if (is_front_page()) get_template_part('layouts/partials/welcome'); ?>


