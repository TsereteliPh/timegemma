<?php get_header(); ?>

<section class="collections">
	<div class="container collections__container">
		<div class="title title--dark collections__title">
			<svg width="74" height="87"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial-half"></use></svg>
			<h1 class="title__text">Sammlungen</h1>
		</div>

		<div class="collections__wrapper js-show-more-container">
			<?php
				$args = [
					'post_type' => 'collection',
					'orderby' => 'post_date',
					'posts_per_page' => '6',
					'paged' => 1
				];

				$query = new WP_Query($args);
				$posts = $query->posts;

				if ( $query->have_posts() ) {
					if (is_archive()) {
						foreach ($posts as $post) {
							get_template_part('/layouts/partials/cards/collection-card', null, array(
								'class' => 'collections__link',
							) );
						}
					} else {
						while ( $query->have_posts() ) {
							$query->the_post();

							get_template_part('/layouts/partials/cards/collection-card', null, array(
								'class' => 'collections__link',
							) );
						}

						wp_reset_postdata();
					}
				}
			?>
		</div>

		<?php if ( $query->max_num_pages > 1) : ?>
			<button class="btn btn--dark collections__button js-show-more" type="button">Mehr laden</button>

			<script>
				let posts = '<?php echo json_encode($query->query_vars); ?>';
				let current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
				let max_pages = <?php echo $query->max_num_pages; ?>;
			</script>
		<?php endif; ?>
	</div>
</section>

<?php get_template_part('layouts/partials/blocks', null, array(
	'id' => $acfPostID
)); ?>

<?php get_footer(); ?>
