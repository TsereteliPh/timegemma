<?php
    if (is_archive()) {
        $pageTitle = get_the_archive_title();
    } else {
        $pageTitle = get_the_title();
    }
?>

<div class="modal modal--search" id="search">
	<form role="search" method="get" class="modal__search-form" action="<?php bloginfo( 'url' ); ?>" id="searchform">
		<input type="search" id="search" class="input modal-search-input" value="<?php echo get_search_query(); ?>" name="s" placeholder="Seitensuche">

		<button type="submit" class="modal__search-btn">
			<svg width="20" height="18"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-search"></use></svg>
		</button>
	</form>
</div>
