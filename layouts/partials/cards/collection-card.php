<?php
	$year = get_field( 'collection_year' );
	$term = get_field( 'collection_brand' );
	if ( $term ) {
		$termThumb = get_term_meta( $term[0]->term_id, 'thumbnail_id', true );
	}
?>

<a href="<?php the_permalink(); ?>" class="collection-card <?php echo $args['class']; ?>">
	<?php
		if ( get_the_post_thumbnail() ) {
			the_post_thumbnail( 'large', array(
				'class' => 'collection-card__img'
			) );
		} else {
			echo wp_get_attachment_image( 86, 'large', false, array(
				'class' => 'collection-card__img'
			) );
		}
	?>

	<?php if ( $year ) : ?>
		<div class="collection-card__year"><?php the_field( 'collection_year' ); ?></div>
	<?php endif; ?>

	<?php
		if ( $termThumb ) {
			echo wp_get_attachment_image( $termThumb, 'medium', false, array(
				'class' => 'collection-card__brand'
			) );
		}
	?>

	<div class="collection-card__title"><?php the_title(); ?></div>
</a>
