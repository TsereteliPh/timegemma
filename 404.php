<?php get_header(); ?>

<section class="not-found">
	<div class="container not-found__container">
		<div class="not-found__img">
			<span>Fehler</span>
		</div>

		<h1 class="not-found__title">Seite nicht gefunden</h1>

		<a href="<?php echo bloginfo( 'url' ); ?>" class="btn btn--dark btn--dial not-found__link">
			Zur Hauptsache
			<div class="btn__dial">
				<svg width="83" height="76"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-dial"></use></svg>
			</div>
		</a>
	</div>
</section>

<?php get_footer(); ?>
