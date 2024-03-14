</main>

<?php
	$address = get_field( 'address', 'options' );
	$phones = get_field( 'phones', 'options' );
	$emails = get_field( 'emails', 'options' );
	$socials = get_field( 'socials', 'options' );
	$footer_text = get_field( 'footer_text', 'options' );
?>

<footer class="footer">
	<div class="container footer__container">
		<div class="footer__info">
			<a href="<?php echo bloginfo( 'url' ); ?>" class="footer__link" aria-label="Link zur Hauptseite"></a>

			<?php if ( $socials ) : ?>
				<div class="footer__socials socials">
					<?php foreach ( $socials as $social ) : ?>
						<a href="<?php echo $social['url']; ?>" class="socials__item">
							<svg width="20" height="20"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-<?php echo $social['type']; ?>"></use></svg>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="footer__menu-wrapper">
			<div class="footer__label">Informationen</div>

			<?php wp_nav_menu(array(
				'theme_location' => 'menu_footer',
				'container' => '',
				'menu_id' => 'menu-footer',
				'menu_class' => 'reset-list footer__menu'
			)); ?>
		</div>

		<?php if ( $phones || $emails ) : ?>
			<div class="footer__contact-us">
				<div class="footer__label">Kontakt</div>

				<?php if ( $address ) : ?>
					<div class="footer__address"><?php echo $address; ?></div>
				<?php endif; ?>

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
