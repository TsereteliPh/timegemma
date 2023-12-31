<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;


wc_get_template( 'cart/cart-panel.php' ); ?>

<section class="cart">
	<div class="container">
		<?php do_action( 'woocommerce_before_cart' ); ?>

		<form class="cart__form woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>

			<ul class="reset-list cart__list woocommerce-cart-form__contents">
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						/**
						 * Filter the product name.
						 *
						 * @since 2.1.0
						 * @param string $product_name Name of the product in the cart.
						 * @param array $cart_item The product in the cart.
						 * @param string $cart_item_key Key for the product in the cart.
						 */
						$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
					<li class="woocommerce-cart-form__cart-item cart__item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<div class="cart__item-buttons">
							<?php if ( is_user_logged_in() ) : ?>
								<button class="btn-fav cart__item-fav<?php echo adem_check_favorite( $_product->get_id() ) ? ' active' : ''; ?>" type="button" data-id="<?php echo $_product->get_id(); ?>" data-user="<?php echo get_current_user_id(); ?>">
									<svg width="20" height="18"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-heart"></use></svg>
								</button>
							<?php endif; ?>

							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="cart__item-remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"></a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										/* translators: %s is the product name */
										esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</div>

						<div class="cart__item-thumbnail">
							<?php echo $_product->get_image('180x300'); ?>
						</div>

						<div class="cart__item-label" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
							<?php
								if ( ! $product_permalink ) {
									echo wp_kses_post( $product_name . '&nbsp;' );
								} else {
									/**
									 * This filter is documented above.
									 *
									 * @since 2.1.0
									 */
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
								}

								do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

								// Meta data.
								echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
							?>
						</div>

						<div class="cart__item-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</div>

						<div class="cart__attributes">
							<?php if ( $_product->get_sku() ) : ?>
								<div class="cart__attributes-item">
									Artikelnummer
									<div class="cart__attributes-links">
										<?php echo $_product->get_sku(); ?>
									</div>
								</div>
							<?php endif; ?>

							<?php
								$manufacturer = get_the_terms( $_product->get_id(), 'pa_manufacturer' );
								if ( $manufacturer ) :
							?>
								<div class="cart__attributes-item">
									Hersteller
									<div class="cart__attributes-links">
										<?php foreach ( $manufacturer as $term ) : ?>
											<a href="<?php echo esc_url( get_term_link( $term->term_id, 'pa_manufacturer' ) );?>"><?php echo $term->name; ?></a>
										<?php endforeach;?>
									</div>
								</div>
							<?php endif; ?>

							<?php
								$color = get_the_terms( $_product->get_id(), 'pa_color' );
								if ( $color ) :
							?>
								<div class="cart__attributes-item">
									Farbe
									<div class="cart__attributes-links">
										<?php foreach ( $color as $term ) : ?>
											<?php $colorHex = get_term_meta( $term->term_id, 'color', true ); ?>

											<a href="<?php echo esc_url( get_term_link( $term->term_id, 'pa_color' ) );?>" class="cart__attributes-color" title="<?php echo $term->name; ?>" style="background-color: <?php echo $colorHex ? $colorHex : ''; ?>;"></a>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<div class="cart__item-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
							<?php
								if ( $_product->is_sold_individually() ) {
									$min_quantity = 1;
									$max_quantity = 1;
								} else {
									$min_quantity = 1;
									$max_quantity = $_product->get_max_purchase_quantity();
								}

								$product_quantity = woocommerce_quantity_input(
									array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $max_quantity,
										'min_value'    => $min_quantity,
										'product_name' => $product_name,
									),
									$_product,
									false
								);

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
							?>

							<div class="cart__item-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</div>
						</div>
					</li>
				<?php
					endif;
					endforeach;
				?>
			</ul>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<div class="cart__actions">
				<button type="submit" class="hidden cart__btn-update<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
			</div>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>

			<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

			<?php
				/**
				 * Cart collaterals hook.
				 *
				 * //@hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action( 'woocommerce_cart_collaterals' );
			?>

			<?php do_action( 'woocommerce_after_cart' ); ?>

			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>
	</div>
</section>
