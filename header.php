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
				<button class="header__search-btn" aria-label="Suchleiste öffnen" data-src="#search" data-fancybox>
					<svg width="18" height="18"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-search"></use></svg>
				</button>

				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo get_page_link( 366 ); //Local post id 335 ?>" class="header__favorites" aria-label="Favoriten öffnen">
						<svg width="20" height="18"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-heart"></use></svg>

						<?php $favorites_count = adem_count_all_favorites(); ?>

						<span class="header__favorites-counter<?php echo ( $favorites_count > 0 ) ? ' active' : ''; ?>"><?php echo $favorites_count; ?></span>
					</a>
				<?php endif; ?>

				<a href="<?php echo wc_get_cart_url(); ?>" class="header__cart-link" aria-label="Warenkorb öffnen">
					<svg width="18" height="20"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-cart"></use></svg>

					<?php $contents_count = WC()->cart->cart_contents_count; ?>

					<span id="header-cart-counter" class="header__cart-counter<?php echo ( $contents_count > 0 ) ? ' active' : ''; ?>"><?php echo $contents_count; ?></span>
				</a>

				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" class="header__profile" aria-label="Profil öffnen">
						<svg width="18" height="18"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-profile"></use></svg>
					</a>
				<?php else : ?>
					<button class="header__login" aria-label="Anmeldefenster öffnen" data-src="#login" data-fancybox>
						<svg width="20" height="20"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-login"></use></svg>
					</button>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>

<div class="drop">
	<div class="container drop__container">
		<?php
			wp_nav_menu(array(
				'theme_location' => 'menu_burger',
				'container' => '',
				'menu_id' => 'menu-burger',
				'menu_class' => 'reset-list drop__menu'
			));

			$termList = get_terms( [
				'taxonomy' => 'product_cat',
				'parent' => 450,
				'hierarchical' => false
			] );
		?>

		<div class="drop__cats">
			<?php if ( $termList ) : ?>
				<?php foreach ( $termList as $term ) : ?>
					<a href="<?php echo get_term_link( $term->term_id ); ?>" class="drop__cat"><?php echo $term->name; ?></a>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<?php
			if ( is_user_logged_in() ) :
				$current_user = wp_get_current_user();
		?>
			<div class="drop__user">
				<?php if ( $current_user->display_name ) : ?>
					<div class="drop__user-name"><?php echo $current_user->display_name; ?></div>
				<?php endif; ?>

				<div class="drop__user-email"><?php echo $current_user->user_login; ?></div>
			</div>
		<?php endif; ?>

		<?php
			$headerCollection = get_field( 'collection_banner', 'options' );
			if ( $headerCollection ) {
				$post = $headerCollection;
				setup_postdata( $post );
					get_template_part( 'layouts/partials/cards/collection-card', null, array(
						'class' => 'drop__collection'
					) );
				wp_reset_postdata();
			}
		?>

		<?php
			$socials = get_field( 'socials', 'options' );
			if ( $socials ) :
		?>
			<div class="drop__socials socials">
				<?php foreach ( $socials as $social ) : ?>
					<a href="<?php echo $social['url']; ?>" class="socials__item">
						<svg width="20" height="20"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-<?php echo $social['type']; ?>"></use></svg>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php if( !is_front_page() && function_exists( 'yoast_breadcrumb' ) ) : ?>
	<div class="breadcrumb<?php echo is_page( 362 ) ? ' breadcrumb--light' : ''; ?>">
		<div class="container">
			<?php echo yoast_breadcrumb(); ?>
		</div>
	</div>
<?php endif ?>

<?php
	$mainClass = 'main';
	if ( is_front_page() ) $mainClass .= ' main--index';
?>

<main class="<?php echo $mainClass; ?>">
<?php
	if ( is_front_page() ) get_template_part('layouts/partials/welcome');
	if ( is_page( 366 ) ) get_template_part('layouts/partials/favorites'); //Local post id 335
?>



