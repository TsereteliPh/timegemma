<?php get_header(); ?>

<?php
	if ( in_category( 42 ) ) :
		$thumb = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		if ( !$thumb ) {
			$thumb = wp_get_attachment_image_url( 86, 'full', false );
		}
?>
	<section class="single-news" style="background-image: url(<?php echo $thumb; ?>);">
		<div class="single-news__wrapper">
			<div class="container single-news__container">
				<time class="single-news__date" datetime="<?php echo get_the_date('Y-m-j'); ?>"><?php the_date('j.m.y')?></time>

				<h1 class="single-news__title"><?php the_title(); ?></h1>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_template_part('layouts/partials/blocks'); ?>

<?php get_footer(); ?>
