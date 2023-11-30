<?php
remove_action( 'woocommerce_before_main_content','woocommerce_output_content_wrapper', 10, 0 );
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content','woocommerce_output_content_wrapper_end', 10, 0 );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

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

remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

remove_action( 'woocommerce_checkout_before_customer_details', 'wc_get_pay_buttons', 30 ); //? Delete if not stable

remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20 );
remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30 );


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
        $label = sprintf( 'Aktiver aktionscode: <span class="cart-totals__coupon-code">' . $coupon->get_code() . '</span>' );
    }

    return $label;
}

//Change remove coupon link
add_filter( 'woocommerce_cart_totals_coupon_html', 'custom_cart_totals_coupon_html', 30, 3 );

function custom_cart_totals_coupon_html( $coupon_html, $coupon, $discount_amount_html ) {

    if( 'percent' == $coupon->get_discount_type() ) {
        $percent = $coupon->get_amount();

        $discount_amount_html = '<span class="cart-totals__coupon-summ">' . apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_amount_html, $coupon ) . '</span>';

		$coupon_html = $discount_amount_html . ' <a href="' . esc_url( add_query_arg( 'remove_coupon', urlencode( $coupon->get_code() ), defined( 'WOOCOMMERCE_CHECKOUT' ) ? wc_get_checkout_url() : wc_get_cart_url() ) ) . '" class="woocommerce-remove-coupon cart-totals__coupon-remove" data-coupon="' . esc_attr( $coupon->get_code() ) . '">[Stornieren]</a>';
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

//Custon login on checkout page

add_action( 'woocommerce_before_checkout_form', 'force_checkout_login_for_unlogged_customers', 4 );
function force_checkout_login_for_unlogged_customers() {
    if( ! is_user_logged_in() ) {
        remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
        add_action( 'woocommerce_before_checkout_form', 'custom_checkout_login_form', 20 );
    }
}

function custom_checkout_login_form() {
	//!temprarily disable
    // wc_get_template( 'global/form-login.php', array(
    //     'message'  => __( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
    //     'redirect' => wc_get_page_permalink( 'checkout' ),
    //     'hidden'   => false,
    // ) );
}

//Custom fields on checkout page

add_filter( 'woocommerce_form_field_text', 'custom_woocommerce_form_field_text', 10, 4 );
function custom_woocommerce_form_field_text( $field, $key, $args, $value ) {

    if ( $args['type'] == 'text' ) {

            $field = '<fieldset class="fieldset check__fieldset check__fieldset--' . esc_attr( $key ) . '">';

			$field .= '<legend>' . $args['label'] . ( !$args['required'] ? ' - <span>' . esc_html__( 'optional', 'woocommerce' ) . '</span>' : '' ) . '</legend>';

			$field .= '<input type="text" class="input-text" id="' . esc_attr( $args['id'] ) . '" value="' . esc_attr( $value ) . '" name="' . esc_attr( $key ) . '">';

            $field .= '</fieldset>';
    }

    return $field;
}

add_filter( 'woocommerce_form_field_tel', 'custom_woocommerce_form_field_tel', 10, 4 );
function custom_woocommerce_form_field_tel( $field, $key, $args, $value ) {

    if ( $args['type'] == 'tel' ) {

            $field = '<fieldset class="fieldset check__fieldset check__fieldset--' . esc_attr( $key ) . '">';

			$field .= '<legend>' . $args['label'] . ( !$args['required'] ? ' - ' . esc_html__( 'optional', 'woocommerce' ) : '' ) . '</legend>';

			$field .= '<input type="tel" class="input-text" id="' . esc_attr( $args['id'] ) . '" value="' . esc_attr( $value ) . '" name="' . esc_attr( $key ) . '" required>';

            $field .= '</fieldset>';
    }

    return $field;
}

add_filter( 'woocommerce_form_field_email', 'custom_woocommerce_form_field_email', 10, 4 );
function custom_woocommerce_form_field_email( $field, $key, $args, $value ) {

    if ( $args['type'] == 'email' ) {

            $field = '<fieldset class="fieldset check__fieldset check__fieldset--' . esc_attr( $key ) . '">';

			$field .= '<legend>' . $args['label'] . ( !$args['required'] ? ' - ' . esc_html__( 'optional', 'woocommerce' ) : '' ) . '</legend>';

			$field .= '<input type="email" class="input-text" id="' . esc_attr( $args['id'] ) . '" value="' . esc_attr( $value ) . '" name="' . esc_attr( $key ) . '" required>';

            $field .= '</fieldset>';
    }

    return $field;
}

add_filter( 'woocommerce_form_field_country', 'custom_woocommerce_form_field_country', 10, 4 );
function custom_woocommerce_form_field_country( $field, $key, $args, $value ) {

    if ( $key == 'billing_country' ) {

		$countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

		$field = '<fieldset class="fieldset check__fieldset check__fieldset--' . esc_attr( $key ) . '">';

		$field .= '<legend>' . $args['label'] . ( !$args['required'] ? ' - ' . esc_html__( 'optional', 'woocommerce' ) : '' ) . '</legend>';

		if ( 1 === count( $countries ) ) {

			$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

			$field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . $custom_attributes . ' class="country_to_state" readonly="readonly" />';

		} else {
			$data_label = ! empty( $args['label'] ) ? 'data-label="' . esc_attr( $args['label'] ) . '"' : '';

			$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select ' . esc_attr( $args['input_class'] ) . '" ' .  $custom_attributes . ' data-placeholder="' . esc_attr( $args['placeholder'] ? $args['placeholder'] : esc_attr__( 'Select a country / region&hellip;', 'woocommerce' ) ) . '" ' . $data_label . '><option value="">' . esc_html__( 'Select a country / region&hellip;', 'woocommerce' ) . '</option>';

			foreach ( $countries as $ckey => $cvalue ) {
				$field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
			}

			$field .= '</select>';

			$field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country / region', 'woocommerce' ) . '">' . esc_html__( 'Update country / region', 'woocommerce' ) . '</button></noscript>';
		}

            $field .= '</fieldset>';
    }

    return $field;
}

add_filter( 'woocommerce_form_field_state', 'custom_woocommerce_form_field_state', 10, 4 );
function custom_woocommerce_form_field_state( $field, $key, $args, $value ) {

    if ( $key == 'billing_state' ) {

		$for_country = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );
		$states      = WC()->countries->get_states( $for_country );

		$field = '<fieldset class="fieldset check__fieldset check__fieldset--' . esc_attr( $key ) . '">';
		$field .= '<legend>' . $args['label'] . ( !$args['required'] ? ' - ' . esc_html__( 'optional', 'woocommerce' ) : '' ) . '</legend>';

		if ( is_array( $states ) && empty( $states ) ) {

			$field_container .= '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';

			$field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . $custom_attributes . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" readonly="readonly" data-input-classes="' . esc_attr( $args['input_class'] ) . '"/>';

		} elseif ( ! is_null( $for_country ) && is_array( $states ) ) {
			$data_label = ! empty( $args['label'] ) ? 'data-label="' . esc_attr( $args['label'] ) . '"' : '';

			$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select ' . esc_attr( $args['input_class'] ) . '" ' . $custom_attributes . ' data-placeholder="' . esc_attr( $args['placeholder'] ? $args['placeholder'] : esc_html__( 'Select an option&hellip;', 'woocommerce' ) ) . '"  data-input-classes="' . esc_attr( $args['input_class'] ) . '" ' . $data_label . '>';

			$field .= '<option value="">' . esc_html__( 'Select an option&hellip;', 'woocommerce' ) . '</option>';

			foreach ( $states as $ckey => $cvalue ) {
				$field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
			}

			$field .= '</select>';

		} else {
			$field .= '<input type="text" class="input-text ' . esc_attr( $args['input_class'] ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . $custom_attributes . ' data-input-classes="' . esc_attr( $args['input_class'] ) . '"/>';
		}

            $field .= '</fieldset>';
    }

    return $field;
}
