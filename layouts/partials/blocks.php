<?php
$id = $args['id'] ?? false;
if (have_rows('blocks', $id)) {
	$counters = array();
	while (have_rows('blocks', $id)) {
		the_row();
		$layout = get_row_layout();
		if (!isset($counters[$layout])) {
			// initialize counter
			$counters[$layout] = 1;
		} else {
			// increase existing counter
			$counters[$layout]++;
		}

		if (get_row_layout() == 'best') get_template_part('layouts/blocks/best/template');
		else if (get_row_layout() == 'catalog-links') get_template_part('layouts/blocks/catalog-links/template');
		else if (get_row_layout() == 'mailing') get_template_part('layouts/blocks/mailing/template');
		else if (get_row_layout() == 'new-releases') get_template_part('layouts/blocks/new-releases/template');
	}
}
