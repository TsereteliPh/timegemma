<section class="haze catalog-links">
	<div class="container catalog-links__container">
        <?php get_template_part('/layouts/partials/title', null, array(
            'class' => 'catalog-links__title',
            'title' => get_sub_field('title')
        )); ?>

		<div class="catalog-links__content">
			<div class="catalog-links__link-wrapper">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/for-him-img.png" class="catalog-links__img" alt="Mann mit Uhr" width="800" height="1080">

				<a href="<?php echo get_category_link( 17 ); ?>" class="btn btn--dial catalog-links__link">
					Für Männer
					<div class="btn__dial">
						<svg width="83" height="76"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-dial"></use></svg>
					</div>
				</a>
			</div>

			<div class="catalog-links__link-wrapper">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/for-her-img.png" class="catalog-links__img" alt="Frau mit Uhr" width="800" height="1080">

				<a href="<?php echo get_category_link( 18 ); ?>" class="btn btn--dial catalog-links__link">
					Für Frauen
					<div class="btn__dial">
						<svg width="83" height="76"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-dial"></use></svg>
					</div>
				</a>
			</div>
		</div>

	</div>
</section>
