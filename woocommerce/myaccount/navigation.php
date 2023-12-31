<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="account__nav">
	<ul class="reset-list account__nav-list">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="account__nav-item <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="account__nav-link"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>

	<button class="account__nav-btn" type="button">
		<svg width="45" height="35"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-dial"></use></svg>
	</button>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); //Empty ?>
