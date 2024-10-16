<?php
define('PAYPAL_SANDBOX', TRUE); //TRUE=Sandbox | FALSE=Production 
define('PAYPAL_SANDBOX_CLIENT_ID', 'AShXVfk2H3x9UQzUp181bnIcuOGacy_KAxaEwe4ZYTJmNlB1pxPvFNDJKqgN2AsGVVp8tjounRX_tula'); 
define('PAYPAL_SANDBOX_CLIENT_SECRET', 'EPmrSM29jXL-Z_XCVqsZRY3XAgvxwHGQ3pNHbScM_gimaIMvAOEzaMiCW6YipQujxfh2qTFhTvLRdne2'); 
define('PAYPAL_PROD_CLIENT_ID', 'Insert_Live_PayPal_Client_ID_Here'); 
define('PAYPAL_PROD_CLIENT_SECRET', 'Insert_Live_PayPal_Secret_Key_Here'); 
define("DB_HOST", 'localhost');
define("DB_USER", 'root');
define("DB_PASS", '');
define("DB_NAME", 'hoa_shop');
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>