# coincheck 

coincheck
The easiest Bitcoin Payment in Japan
https://coincheck.jp/payment


## Requirements

PHP 5.4+

## Installation

Add the following to `composer.json`.

```json
{
    "require": {
        "coincheck/coincheck-payment": "1.0.2"
    }
}
```

## Usage

```php
require "vendor/autoload.php";
use Coincheck\CoincheckPayment;
$coincheck= new CoincheckPayment('ACCESS_KEY', 'API_SECRET');

/** Private API */

$coincheck->button();
```


## Dependencies

* [guzzle](http://docs.guzzlephp.org/en/latest/) as a HTTP client

## License
MIT

