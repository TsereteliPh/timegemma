<?php
/**
 * Product Loop End
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-end.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</ul>

<?php
	global $wp_query;
	if ( isset( $wp_query ) && $wp_query->max_num_pages > 1 && !is_search() ) :
?>
	<button class="btn btn--dark catalog__show-more js-show-more" type="button">Mehr laden</button>

	<script>
		let posts = '<?php echo json_encode($wp_query->query_vars); ?>';
		let current_page = <?php echo get_query_var('paged') ?: 1; ?>;
		let max_pages = <?php echo $wp_query->max_num_pages; ?>;
	</script>
<?php endif; ?>
