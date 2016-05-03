<?php

function transformString( $string ) {
	$json = array(
		'no modification' => $string,
		'bin2hex'         => bin2hex( $string ),
		'crypt'           => crypt( $string ),
		'explode'         => explode( ' ', $string ),
		'strrev'          => strrev( $string ),
	);

	return json_encode( $json );
}

function singleMethodTransformString($transformedString, $method) {
	return json_encode(array(
		$method => $transformedString
	));
}

if ( isset( $_GET['string'] ) ) {
	header( 'Content-Type: application/json' );
	$string = $_GET['string'];

	echo transformString( $string );

} else if ( isset( $_POST['string'] ) && isset( $_POST['method'] ) ) {

	header( 'Content-Type: application/json' );
	$string = $_POST['string'];
	$method = $_POST['method'];

	switch($method) {
		case 'bin2hex':
			echo singleMethodTransformString(bin2hex($string), $method);
			break;
		case 'crypt':
			echo singleMethodTransformString(crypt($string), $method);
			break;
		case 'explode':
			echo singleMethodTransformString(explode(' ', $string), $method);
			break;
		case 'strrev':
			echo singleMethodTransformString(strrev($string), $method);
			break;
		default:
			echo singleMethodTransformString($string, 'no modification (unrecognized method)');
	}
}