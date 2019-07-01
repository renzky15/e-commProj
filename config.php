<?php 
define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/E-COMM/');
define('CART_COOKIE','SBwi72UCklwiqzz2');
define('CART_COOKIE_EXPIRE', time()+(86400 * 30));
define('TAXRATE', '0.0875');
define('CURRENCY', 'php');
define('CHECKOUTMODE', 'TEST');

if (CHECKOUTMODE == 'TEST') {
	define('STRIPE_PRIVATE', 'stripeAPIKey');
	define('STRIPE_PUBLIC', 'stripeAPIKey');
	
}
if (CHECKOUTMODE == 'LIVE') {
	define('STRIPE_PRIVATE', 'stripeAPIKey');
	define('STRIPE_PUBLIC', 'stripeAPIKey');
	
}


 ?>