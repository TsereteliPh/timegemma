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

//add to cart fragment

add_filter('woocommerce_add_to_cart_fragments', 'adem_header_add_to_cart_fragments');

function adem_header_add_to_cart_fragments( $fragments ) {
	$cart_count = WC()->cart->get_cart_contents_count();
	$countHTML = '<span id="header-cart-counter" class="header__cart-counter">' . $cart_count . '</span>';

	$fragments['#header-cart-counter'] = $countHTML;

	return $fragments;
}
