<?php get_header(); ?>

<section class="news">
	<div class="container news__container">
		<div class="title title--dark news__title">
			<svg width="74" height="87"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial-half"></use></svg>
			<h1 class="title__text">Nachricht</h1>
		</div>

		<ul class="reset-list news__list js-show-more-container">
			<?php
				$args = [
					'post_type' => 'post',
					'cat' => 42,
					'orderby' => 'post_date',
					'posts_per_page' => '1',
					'paged' => 1
				];

				$query = new WP_Query($args);

				// echo '<pre>';
				// print_r($query);
				// echo '</pre>';
				$posts = $query->posts;

				if ( $query->have_posts() ) {
					foreach ($posts as $post) {
						get_template_part('layouts/partials/cards/news-card', null, array(
							'class' => 'news__item'
						));
					}
				}
			?>
		</ul>

		<?php if ( $query->max_num_pages > 1) : ?>
			<button class="btn btn--dark news__button js-show-more" type="button">Mehr laden</button>

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
