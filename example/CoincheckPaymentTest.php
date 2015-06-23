<?php

require __DIR__ . "/../vendor/autoload.php";
require dirname(__FILE__) . '/../lib/Coincheck/CoincheckPayment.php';

use Coincheck\CoincheckPayment;
$coincheck = new Coincheck('ACCESS_KEY', 'API_SECRET');


///** Private API */
$res = $coincheck->button->set();
echo json_encode($res);
