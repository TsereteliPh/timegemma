<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$term = get_queried_object();
$catalogBanner = get_field( 'catalog_banner', 10 );
?>
<ul class="reset-list catalog__list js-show-more-container">
	<?php if ( $term->parent && $term->description ) : ?>
		<li class="catalog__item-desc">
			<?php echo wc_format_content( wp_kses_post( $term->description ) ); ?>
		</li>
	<?php endif; ?>

	<?php if ( $catalogBanner ) : ?>
		<li class="catalog__item-banner">
			<a href="<?php echo $catalogBanner['link']; ?>">
				<?php echo wp_get_attachment_image( $catalogBanner['banner'], 'full', false ); ?>
			</a>
		</li>
	<?php endif; ?>
