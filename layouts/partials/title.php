<?php
if (!empty($args['title']['text'])) {
	echo sprintf('
		<div class="title %2$s">
			<svg width="74" height="87"><use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#icon-dial-half"></use></svg>
			<%1$s class="title__text">%3$s</%1$s>
		</div>',
		$args['title']['type'],
		$args['class'],
		$args['title']['text']
	);
}
