<section class="main-text">
	<div class="container container--small main-text__container<?php echo ( get_sub_field( 'border' ) ) ? ' main-text__container--border' : ''; ?>">
		<?php
			$titleClass = 'title--no-svg main-text__title';
			if ( get_sub_field( 'title_color' ) == 'dark' ) $titleClass .= ' title--dark';

			get_template_part('/layouts/partials/title', null, array(
				'class' => $titleClass,
				'title' => get_sub_field('title')
			));
		?>

		<div class="main-text__text"><?php the_sub_field( 'text' ); ?></div>
	</div>
</section>
