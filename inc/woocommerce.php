<?php
remove_action( 'woocommerce_before_main_content','woocommerce_output_content_wrapper', 10, 0 );
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content','woocommerce_output_content_wrapper_end', 10, 0 );

remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


// ---------------------------------------------------------------- Filters

//add to cart fragment

add_filter('woocommerce_add_to_cart_fragments', 'adem_header_add_to_cart_fragments');

function adem_header_add_to_cart_fragments( $fragments ) {
	$cart_count = WC()->cart->get_cart_contents_count();
	$countHTML = '<span id="header-cart-counter" class="header__cart-counter">' . $cart_count . '</span>';

	$fragments['#header-cart-counter'] = $countHTML;

	return $fragments;
}

//edit out of stock

add_filter( 'woocommerce_get_availability', 'adem_out_of_stock', 10, 2 );

function adem_out_of_stock( $availability, $product ) {

	if ( ! $product->is_in_stock() ) {
		$availability['availability'] = __( 'Produkt nicht verfügbar' );
		$availability['class'] = __( 'btn btn--dark product__cart-unavailable' );
	}

	return $availability;
}

//rename catalog_orderby

add_filter( 'woocommerce_catalog_orderby', 'adem_custom_woocommerce_catalog_orderby', 20 );

function adem_custom_woocommerce_catalog_orderby( $orderby ) {
    $orderby[ 'menu_order' ] = 'Default';
    $orderby[ 'popularity' ] = 'Nach Beliebtheit';
    $orderby[ 'date' ] = 'Nach Datum';
    $orderby[ 'price' ] = 'Nach Preis ↑';
    $orderby[ 'price-desc' ] = 'Nach Preis ↓';

	unset( $orderby[ 'rating' ] );

	return $orderby;
}

//Change cart coupon
add_filter( 'woocommerce_cart_totals_coupon_label', 'adem_cart_totals_coupon_label', 10, 2 );

function adem_cart_totals_coupon_label( $label, $coupon ) {
	if ( $coupon->get_code() ) {
        // New label
        $label = sprintf( 'Aktiver aktionscode: <span class="cart__coupon-code">' . $coupon->get_code() . '</span>' );
    }

    return $label;
}

//Change remove coupon link
add_filter( 'woocommerce_cart_totals_coupon_html', 'custom_cart_totals_coupon_html', 30, 3 );

function custom_cart_totals_coupon_html( $coupon_html, $coupon, $discount_amount_html ) {

    if( 'percent' == $coupon->get_discount_type() ) {
        $percent = $coupon->get_amount();

        $discount_amount_html = '<span class="cart__coupon-summ">' . apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_amount_html, $coupon ) . '</span>';

		$coupon_html = $discount_amount_html . ' <a href="' . esc_url( add_query_arg( 'remove_coupon', urlencode( $coupon->get_code() ), defined( 'WOOCOMMERCE_CHECKOUT' ) ? wc_get_checkout_url() : wc_get_cart_url() ) ) . '" class="woocommerce-remove-coupon cart__coupon-remove" data-coupon="' . esc_attr( $coupon->get_code() ) . '">[Stornieren]</a>';
	}

    return $coupon_html;
}

// ---------------------------------------------------------------- Functions

// check product in cart
function is_product_in_cart() {
    foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
        $cart_product = $values['data'];

        if( get_the_ID() == $cart_product->id ) {
            return true;
        }
    }

    return false;
}

// product quantity in cart by ID

function get_product_quantity_in_cart( $product_id ) {
	$quantity = 0;

	foreach ( WC()->cart->get_cart() as $cart_item ) {
		if( $product_id == $cart_item[ 'product_id' ] ){
			$quantity = $cart_item[ 'quantity' ];
			break;
		}
	}

	return $quantity;

}

// update cart quantity
add_action('wp_footer', 'adem_cart_update_qty_script');
function adem_cart_update_qty_script()
{
	if ( is_cart() ) {
		?>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				changeInputQuantity('.cart', true);
				let update_cart;
				jQuery('body').delegate(".cart__item .qty", "change", function () {
					if (update_cart != null) {
						clearTimeout(update_cart);
					}
					update_cart = setTimeout(function () {
						jQuery("[name='update_cart']").trigger("click")
					}, 1000);
				});
			});
		</script>
		<?php
	}
}
