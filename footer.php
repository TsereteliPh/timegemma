</main>

<?php
	$phones = get_field( 'phones', 'options' );
	$emails = get_field( 'emails', 'options' );
	$socials = get_field( 'socials', 'options' );
	$footer_text = get_field( 'footer_text', 'options' );
?>

<footer class="footer">
	<div class="container footer__container">
		<div class="footer__info">
			<a href="<?php echo bloginfo( 'url' ); ?>" class="footer__link" aria-label="Link zur Hauptseite"></a>

			<?php if ( $footer_text ) : ?>
				<div class="footer__text"><?php echo $footer_text; ?></div>
			<?php endif; ?>

			<?php if ( $socials ) : ?>
				<div class="footer__socials"></div>
			<?php endif; ?>
		</div>

		<div class="footer__links">
			<div class="footer__menu-wrapper">
				<div class="footer__label">Informationen</div>

				<?php wp_nav_menu(array(
					'theme_location' => 'menu_footer',
					'container' => '',
					'menu_id' => 'menu-footer',
					'menu_class' => 'reset-list footer__menu'
				)); ?>
			</div>

			<?php
				$forHimTerms = get_terms( [
					'taxonomy' => 'product_cat',
					'child_of' => 17
				] );

				$forHerTerms = get_terms( [
					'taxonomy' => 'product_cat',
					'child_of' => 18
				] );

				if ( $forHimTerms || $forHerTerms ) :
			?>
				<div class="footer__brands">
					<ul class="reset-list footer__tabs js-tabs">
						<li class="footer__label footer__tab active" data-tab="footer-for-him">Für Männer</li>
						<li class="footer__label footer__tab" data-tab="footer-for-her">Für Frauen</li>
					</ul>

					<div class="footer__cats-wrapper">
						<div class="footer__cats active" id="footer-for-him">
							<?php foreach ( $forHimTerms as $term ) : ?>
								<a href="<?php echo get_term_link( $term->term_id ); ?>" class="footer__cat"><?php echo $term->name; ?></a>
							<?php endforeach; ?>
						</div>

						<div class="footer__cats" id="footer-for-her">
							<?php foreach ( $forHerTerms as $term ) : ?>
								<a href="<?php echo get_term_link( $term->term_id ); ?>" class="footer__cat"><?php echo $term->name; ?></a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $phones || $emails ) : ?>
			<div class="footer__contact-us">
				<div class="footer__label">Kontakte</div>

				<?php if ( $phones ) : ?>
					<div class="footer__contacts footer__phones">
						Rufen Sie uns an
						<?php foreach ( $phones as $phone ) : ?>
							<a href="tel:<?php echo preg_replace( '/[^0-9,+]/', '', $phone['phone'] ); ?>"><?php echo $phone['phone']; ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( $emails ) : ?>
					<div class="footer__contacts footer__emails">
						E-Mail
						<?php foreach ( $emails as $email ) : ?>
							<a href="mailto:<?php echo $email['email']; ?>"><?php echo $email['email']; ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</footer>

<?php get_template_part('layouts/partials/modals'); ?>

<?php wp_footer(); ?>

</body>
</html>
