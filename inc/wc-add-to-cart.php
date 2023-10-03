<?php
add_action( 'wp_ajax_wc_add_to_cart', 'wc_add_to_cart' );
add_action( 'wp_ajax_nopriv_wc_add_to_cart', 'wc_add_to_cart' );
function wc_add_to_cart() {
	$product_id = intval($_POST['product_id']);
	$quantity = intval($_POST['quantity']);
	$product_cart_id = WC()->cart->generate_cart_id( $product_id );
	$cart_item_key = WC()->cart->find_product_in_cart( $product_cart_id );

	// Добавляем товар в корзину
	if (!$cart_item_key) {
		WC()->cart->add_to_cart($product_id, $quantity);
	} elseif($quantity >= 1) {
		foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
			if( $product_id == $cart_item[ 'product_id' ] ) {
				WC()->cart->set_quantity($key, $quantity);
				break;
			}
		}
	} else {
		WC()->cart->remove_cart_item( $cart_item_key );
	}

	// Возвращаем JSON-ответ
	echo json_encode(array(
		'status' => 'success',
		'count' => get_product_quantity_in_cart($product_id),
		'countAll' =>  WC()->cart->cart_contents_count
	));
	die();
}
