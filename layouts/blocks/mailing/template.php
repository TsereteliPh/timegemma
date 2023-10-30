<?php
	$mailingBg = get_sub_field( 'background' );
	$bgImage;
	if ( $mailingBg ) {
		$bgImage = 'style="background-image: url(' . $mailingBg . ')"';
	}
?>

<section class="mailing">
	<div class="mailing__content" <?php if ( $bgImage ) echo $bgImage; ?>>
		<div class="container">
			<div class="mailing__wrapper">
				<h2 class="mailing__title"><?php the_sub_field( 'title' ); ?></h2>

				<div class="mailing__message"><?php the_sub_field( 'text' ); ?></div>

				<form action="post" class="mailing__form">
					<fieldset class="fieldset fieldset--light mailing__email">
						<legend>Email</legend>
						<input type="email" name="client_email" required>
					</fieldset>

					<button class="btn" type="submit">Jetzt abonnieren</button>

					<div class="policy mailing__policy">Mit meiner Anmeldung bestätige ich, dass ich die Datenschutzerklärung von <a href="<?php echo get_privacy_policy_url(); ?>" target="_blank">Timegemma</a> gelesen habe</div>
				</form>
			</div>
		</div>
	</div>

	<div class="mailing__social">
		<div class="mailing__social-wrapper">
			<div class="mailing__social-text">
				Wir sind auf
				<span><?php the_sub_field( 'label' ); ?></span>
			</div>

			<a href="<?php the_sub_field( 'link' ); ?>" target="_blank" class="btn btn--dial mailing__link">
				Alle Nachrichten
				<div class="btn__dial">
					<svg width="83" height="76"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-dial"></use></svg>
				</div>
			</a>
		</div>
	</div>
</section>
