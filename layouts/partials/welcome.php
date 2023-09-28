<?php $welcome = get_field( 'welcome' ); ?>

<section class="welcome">
	<div class="swiper welcome__slider">
		<?php if ( $welcome['slider'] ) : ?>
			<ul class="reset-list welcome__slider-wrapper swiper-wrapper">
				<?php foreach ( $welcome['slider'] as $slide ) : ?>
					<li class="welcome__slide swiper-slide">
						<?php echo wp_get_attachment_image( $slide, 'full', false ); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>


		<div class="container welcome__wrapper">
			<?php if ( $welcome['advantages'] ) : ?>
				<ul class="reset-list welcome__advantages">
					<?php foreach ( $welcome['advantages'] as $advantage ) : ?>
						<li class="welcome__advantage">
							<svg width="74" height="87"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial-half"></use></svg>
							<?php echo $advantage['text']; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<div class="slider-controls welcome__controls">
				<div class="btn-arrow slider-controls__prev">
					<svg width="70" height="8"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-left"></use></svg>
				</div>

				<div class="slider-controls__progressbar">
					<svg class="slider-controls__dial" width="60" height="60"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial"></use></svg>
					<svg class="slider-controls__fraction" width="60" height="60"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial"></use></svg>
					<div class="slider-controls__counter"></div>
				</div>

				<div class="btn-arrow slider-controls__next">
					<svg width="70" height="8"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-right"></use></svg>
				</div>
			</div>
		</div>
	</div>

	<div class="welcome__slogan">
		<div class="welcome__slogan-before">
			Es ist Zeit,
			<span>eine</span>
		</div>

		<img class="welcome__slogan-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/welcome-watch.png" alt="Bild einer Armbanduhr" width="383" height="678">

		<div class="welcome__slogan-after">
			<span>Wahl</span>
			zu treffen
		</div>
	</div>
</section>
