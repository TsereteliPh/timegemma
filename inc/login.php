<?php
add_action( 'wp_ajax_login', 'login' );
add_action( 'wp_ajax_nopriv_login', 'login' );
function login() {
	$response = array(
		'status' => 'failure'
	);

	if ( ! isset( $_POST['login-nonce'] ) || ! wp_verify_nonce( $_POST['login-nonce'], 'login' ) ) {
		$response += ['message' => 'Etwas ist schief gelaufen. Versuchen Sie es später noch einmal'];
		echo json_encode($response);
		wp_die();
	}

	if ( ! $_POST['username'] || ! $_POST['password'] ) {
		$response += ['message' => 'Füllen Sie die erforderlichen Felder aus'];
		echo json_encode($response);
		wp_die();
	}

	$username = trim( $_POST['username'] );
	$password = trim( $_POST['password'] );
	$credentials = array(
		'user_login' => trim( $_POST['username'] ),
		'user_password' => trim( $_POST['password'] ),
		'remember' => true
	);

	$wp_user = wp_signon( $credentials );
	if ( ! is_wp_error( $wp_user ) ) $response['status'] = 'success';

	echo json_encode($response);
	wp_die();
}
