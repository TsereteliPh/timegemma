<?php
add_action( 'wp_ajax_registeration', 'registeration' );
add_action( 'wp_ajax_nopriv_registeration', 'registeration' );
function registeration() {
	$response = array(
		'status' => 'failure'
	);

	if ( ! isset( $_POST['modal-registeration-nonce'] ) || ! wp_verify_nonce( $_POST['modal-registeration-nonce'], 'registeration' ) ) {
		$response += ['message' => 'Etwas ist schief gelaufen. Versuchen Sie es später noch einmal'];
		echo json_encode($response);
		wp_die();
	}

	if ( ! $_POST['username'] || ! $_POST['password'] || ! $_POST['confirm-password'] || ! $_POST['first-name'] || ! $_POST['last-name'] ) {
		$response += ['message' => 'Füllen Sie die erforderlichen Felder aus'];
		echo json_encode($response);
		wp_die();
	}

	if ( trim( $_POST['password'] ) !== trim( $_POST['confirm-password'] ) ) {
		$response += ['message' => 'Die Passwörter stimmen nicht überein'];
		echo json_encode($response);
		wp_die();
	}

	$userdata = array(
		'user_login' => wp_unslash( trim( $_POST['username'] ) ),
		'user_pass' => wp_unslash( trim( $_POST['password'] ) ),
		'user_email' => wp_unslash( trim( $_POST['username'] ) ),
		'first_name' => wp_unslash( trim( $_POST['first-name'] ) ),
		'last_name' => wp_unslash( trim( $_POST['last-name'] ) )
	);

	$credentials = array(
		'user_login' => wp_unslash( trim( $_POST['username'] ) ),
		'user_password' => wp_unslash( trim( $_POST['password'] ) ),
		'remember' => true
	);

	$user_id = wp_insert_user( $userdata );

	if ( ! is_wp_error( $user_id ) ) {
		$response['status'] = 'success';
		$wp_user = wp_signon( $credentials );
	} else {
		$response += ['message' => $user_id->get_error_message()];
		echo json_encode($response);
		wp_die();
	}

	echo json_encode($response);
	wp_die();
}
