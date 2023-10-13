<?php
	$background = get_sub_field( 'background' );
	$text = get_sub_field( 'text' );
?>
<section class="haze banner" <?php echo ($background) ? 'style="background-image: url(' . $background . ');"' : ''; ?>>
	<?php if ( $text ) : ?>
		<div class="container">
			<div class="banner__text"><?php echo $text; ?></div>
		</div>
	<?php endif; ?>
</section>
