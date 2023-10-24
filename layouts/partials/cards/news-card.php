<li class="news-card">
	<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'medium', array(
				'class' => 'news-card__img'
			) );
		} else {
			echo wp_get_attachment_image( 86, 'medium', false, array(
				'class' => 'news-card__img'
			) );
		}
	?>

	<div class="news-card__info">
		<a href="<?php the_permalink(); ?>" class="news-card__link"><?php the_title(); ?></a>

		<?php if ( has_excerpt() ) : ?>
			<div class="news-card__excerpt"><?php echo adem_excerpt(200); ?></div>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="btn-dial news-card__button">
			<svg width="50" height="46"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-dial"></use></svg>
		</a>
	</div>
</li>
