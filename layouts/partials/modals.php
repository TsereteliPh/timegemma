<?php
    if (is_archive()) {
        $pageTitle = get_the_archive_title();
    } else {
        $pageTitle = get_the_title();
    }
?>

<div class="modal modal--search" id="search">
	<form role="search" method="get" class="modal__search-form" action="<?php bloginfo( 'url' ); ?>" id="searchform">
		<input type="search" id="search" class="input modal-search-input" value="<?php echo get_search_query(); ?>" name="s" placeholder="Seitensuche" data-swplive="true">

		<button type="submit" class="modal__search-btn">
			<svg width="20" height="18"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-search"></use></svg>
		</button>
	</form>

	<div class="modal__search-result"></div>
</div>

<div class="modal modal--login" id="login">
	<div class="modal__login">
		<div class="modal__login-img modal__login-img--form-login active"></div>

		<div class="modal__login-wrapper">
			<ul class="reset-list modal__login-list js-tabs">
				<li class="modal__login-item active" data-tab="form-login">Betreten</li>
				<li class="modal__login-item" data-tab="form-registeration">Registrierung</li>
			</ul>

			<form method="post" class="modal__login-form modal__login-form--login active" id="form-login" name="login">
				<div class="modal__login-error js-error">Der von Ihnen eingegebene Benutzername oder Passwort ist falsch</div>

				<fieldset class="fieldset modal__fieldset modal__fieldset--username">
					<legend>E - mail</legend>
					<input type="text" class="input-text" id="login-username" name="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" autocomplete="username" required>
				</fieldset>

				<fieldset class="fieldset modal__fieldset modal__fieldset--password">
					<legend>Passwort</legend>
					<input type="password" class="input-text" id="login-password" name="password" autocomplete="current-password" required>
				</fieldset>

				<?php wp_nonce_field( 'login', 'login-nonce' ); ?>

				<button type="submit" class="btn btn--black modal__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">Weitermachen</button>

				<div class="modal__login-lost">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">Passwort vergessen?</a>
				</div>
			</form>

			<form method="post" class="modal__login-form modal__login-form--registeration" id="form-registeration" name="registeration" autocomplete="off">
				<div class="modal__login-error js-error">Der von Ihnen eingegebene Benutzername oder Passwort ist falsch</div>

				<fieldset class="fieldset modal__fieldset modal__fieldset--first-name">
					<legend>Vorname</legend>
					<input type="text" class="input-text" id="registeration-first-name" name="first-name" >
				</fieldset>

				<fieldset class="fieldset modal__fieldset modal__fieldset--last-name">
					<legend>Nachname</legend>
					<input type="text" class="input-text" id="registeration-last-name" name="last-name" >
				</fieldset>

				<fieldset class="fieldset modal__fieldset modal__fieldset--username">
					<legend>E - mail (Benutzername)</legend>
					<input type="email" class="input-text" id="registeration-username" name="username" >
				</fieldset>

				<fieldset class="fieldset modal__fieldset modal__fieldset--password">
					<legend>Passwort</legend>
					<input type="password" class="input-text" id="registeration-password" name="password" >
				</fieldset>

				<fieldset class="fieldset modal__fieldset modal__fieldset--confirm-password">
					<legend>Wiederholen Sie das Passwort</legend>
					<input type="password" class="input-text" id="registeration-confirm-password" name="confirm-password" >
				</fieldset>

				<?php wp_nonce_field( 'registeration', 'modal-registeration-nonce' ); ?>

				<button type="submit" class="btn btn--black modal__submit" name="registeration" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">Registrieren</button>
			</form>
		</div>

		<div class="modal__login-img modal__login-img--form-registeration"></div>
	</div>
</div>
