<?php

require __DIR__ . "/../vendor/autoload.php";
require dirname(__FILE__) . '/../lib/Coincheck/CoincheckPayment.php';

use Coincheck\CoincheckPayment;
$coincheck = new CoincheckPayment('access_key', 'access_secret');
$arr = array(
    "name" => "foo #123",
    "currency" => "JPY",
    "amount" => 100,
    "callback_url" => 'http://coincheck.jp/',
    "max_times" => 1
);
$res = $coincheck->button->set($arr);
echo json_encode($res);
