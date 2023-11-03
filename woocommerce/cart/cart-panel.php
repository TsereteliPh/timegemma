<section class="cart-panel">
	<div class="container">
		<h1 class="cart-panel__title">Warenkorb</h1>

		<?php
			global $post;
			$page_id = $post->ID;
		?>

		<div class="cart-panel__links">
			<a <?php echo is_cart() ? '' : 'href="' . wc_get_cart_url() . '"'; ?> class="cart-panel__link<?php echo is_cart() ? ' active' : ''; ?>">Aufträge</a>

			<a <?php echo is_checkout() ? '' : 'href="' . wc_get_checkout_url() . '"'; ?> class="cart-panel__link<?php echo is_checkout() ? ' active' : ''; ?>">Lieferadresse und Zahlungsart</a>
		</div>
	</div>
</section>
