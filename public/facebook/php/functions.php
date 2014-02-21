<?php
/*
	@! Facebook comments system
	@@ Using PHP, jQuery, and AJAX
*/

## Clean the input from script, html, style, and almost all potenially harmful tags.
function clean_input($input) {
	$search = array(
		'@<script[^>]*?>.*?</script>@si',   /* strip out javascript */
		'@<[\/\!]*?[^<>]*?>@si',            /* strip out HTML tags */
		'@<style[^>]*?>.*?</style>@siU',    /* strip style tags properly */
		'@<![\s\S]*?--[ \t\n\r]*>@'         /* strip multi-line comments */
	);

	$output = preg_replace($search, '', $input);
	return $output;
}

/*
	@@ Generating a cryptographically strong pseudorandom value for preventing CSRF and XSRF attacks.
*/
function crypto_rand_secure($min, $max) {
	$range = $max - $min;
		if($range < 0) return $min; ## Not so random
	$log = log($range, 2);
	$bytes = (int) ($log / 8) + 1; ## Length in bytes
	$bits = (int) $log + 1; ## Length in bits
	$filter = (int) (1 << $bits) - 1; ## Set all lower bits to 1
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; ## Discard irrelevant bits
		} while ($rnd >= $range);

	return $min + $rnd;
}

function get_token($length) {
	$token = '';
	$codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$codeAlphabet .= 'abcdefghijklmnopqrstuvwxyz';
	$codeAlphabet .= '0123456789';
		for($i=0; $i<$length; $i++) {
			$token .= $codeAlphabet[crypto_rand_secure(0, strlen($codeAlphabet))];
		}

	return $token;
}