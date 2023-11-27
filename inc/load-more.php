<?php
add_action( 'wp_ajax_load_more', 'load_more' );
add_action( 'wp_ajax_nopriv_load_more', 'load_more' );
function load_more() {
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1;

	$query = new WP_Query( $args );

	$return_html = '';
	if( $query->have_posts() ) {
		while( $query->have_posts() ) {
			$query->the_post();
			if ( $args['cat'] == 42 ) {
				$return_html .= get_template_part('layouts/partials/cards/news-card', null, array(
					'class' => 'news__item'
				));
			} else if ( $args['post_type'] == 'product' || isset( $args['product_cat'] ) )  {
				$return_html .= get_template_part('layouts/partials/cards/product-card', null, array(
					'class' => 'catalog__item'
				));
			} else if ( $args['post_type'] == 'collection' ) {
				$return_html .= get_template_part('layouts/partials/cards/collection-card', null, array(
					'class' => 'collections__link'
				));
			}
		}
		wp_reset_postdata();
	}

	echo $return_html;
	wp_die();
}
