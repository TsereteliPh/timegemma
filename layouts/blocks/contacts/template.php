<section class="contacts">
	<div class="contacts__map-holder" id="map"></div>

	<div class="container contacts__container">
		<div class="contacts__wrapper">
			<?php
				$title = get_sub_field( 'title' );
				if ( $title['text'] ) {
					echo sprintf('<%1$s class="contacts__title">%2$s</%1$s>',
						$title['type'],
						$title['text']
					);
				}
			?>

			<?php if ( get_sub_field( 'output' ) ) : ?>
				<div class="contacts__content contacts__content--output">
					<div class="contacts__label">ImpressumAngaben gemäß § 5 TMG</div>

					<div class="contacts__text"><?php the_sub_field( 'output' ); ?></div>
				</div>
			<?php endif; ?>

			<?php if ( get_sub_field( 'representative' ) ) : ?>
				<div class="contacts__content contacts__content--representative">
					<div class="contacts__label">Vertreten durch</div>

					<div class="contacts__text"><?php the_sub_field( 'representative' ); ?></div>
				</div>
			<?php endif; ?>

			<?php
				$phones = get_field( 'phones', 'options' );
				$emails = get_field( 'emails', 'options' );
				$vat = get_sub_field( 'vat' );

				if ( $phones || $emails ) :
			?>
				<div class="contacts__content contacts__content--contact">
					<div class="contacts__label">Kontakt</div>

					<div class="contacts__text">
						<?php if ( $phones ) : ?>
							<div class="contacts__links">
								Telefon:
								<?php foreach ( $phones as $phone ) : ?>
									<a href="tel:<?php echo preg_replace( '/[^0-9,+]/', '', $phone['phone'] ); ?>"><?php echo $phone['phone']; ?></a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<?php if ( $emails ) : ?>
							<div class="contacts__links">
								E-Mail:
								<?php foreach ( $emails as $email ) : ?>
									<a href="mailto:<?php echo $email['email'] ?>"><?php echo $email['email']; ?></a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<?php if ( $vat ) : ?>
							<div class="contacts__vat">Umsatzsteuer-Identifikationsnummer gemäß § 27 a Umsatzsteuergesetz: <?php echo $vat; ?></div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( get_sub_field( 'resolution' ) ) : ?>
				<div class="contacts__content contacts__content--resolution">
					<div class="contacts__label">EU-Streitschlichtung</div>

					<div class="contacts__text"><?php the_sub_field( 'resolution' ); ?></div>
				</div>
			<?php endif; ?>

			<?php
				$socials = get_field( 'socials', 'options' );
				if ( $socials ) : //todo: socials
			?>
				<div class="contacts__content contacts__content--socials">
					<div class="contacts__text"><?php the_sub_field( 'resolution' ); ?></div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php
		$map = get_sub_field( 'map' );
		if ( $map ) :
	?>
		<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhlvqkrb22U3VUkRtMMg5_VSEMeKvHqec&callback=initMap"></script>
		<script>
			function initMap() {
				const lat = <?php echo $map['lat']; ?>;
				const lng = <?php echo $map['lng']; ?>;
				const centerPosition = new google.maps.LatLng(lat, lng);

				let indent = 0.0045;
					if (window.innerWidth <= 1440) indent = 0.0035;
					if (window.innerWidth <= 1280) indent = 0.003;
					if (window.innerWidth <= 991) indent = 0;

				const map = new google.maps.Map(document.getElementById('map'), {
					center: new google.maps.LatLng(lat, (lng - indent)),
					zoom: 17,
					disableDefaultUI: true,
					zoomControl: true,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL,
						position: google.maps.ControlPosition.RIGHT_CENTER
					},
					scrollwheel: false,
					navigationControl: false,
					mapTypeControl: false,
					scaleControl: false,
					gestureHandling: 'greedy',
					styles: <?php echo $map['map_style']; ?>,
				});

				const marker = new google.maps.Marker({
					position: centerPosition,
					icon: '<?php echo get_template_directory_uri(); ?>/assets/images/icon-marker.svg',
					title: '<?php echo $map['address']; ?>',
					map: map,
				});
			}
		</script>
	<?php endif; ?>
</section>
