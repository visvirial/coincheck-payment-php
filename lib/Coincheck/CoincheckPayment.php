<?php
namespace Coincheck;

use Guzzle\Common\Event as GuzzleEvent;
use Guzzle\Service\Client as GuzzleClient;
use Guzzle\Service\Description\ServiceDescription;

class CoincheckPayment
{
    /** @var GuzzleClient */
    private $client;

    public $apiBase;
    public $accessKey;
    public $secretKey;

    /** @var Button */
    private $button;

    /**
     * @param array $options API options
     */
    public function __construct($accessKey, $secretKey, $options = array())
    {
        $this->apiBase = 'https://coincheck.jp/api/ec/';
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;

        $this->client = new GuzzleClient($this->apiBase);
        $this->client->setDefaultOption('headers/Content-Type', "application/json");
        $this->client->setDefaultOption('headers/ACCESS-KEY', $this->accessKey);

        /** Private API */
        $this->button = new Button($this);
    }

    public function __get($key)
    {
        $accessors = array('button');
        if (in_array($key, $accessors) && property_exists($this, $key)) {
            return $this->{$key};
        } else {
            throw new \Exception('Unknown accessor ' . $key);
        }
    }

    public function __set($key, $value)
    {
        throw new \Exception($key . ' is not able to override');
    }

    public function setSignature($path, $arr = array())
    {
        $nonce = time();
        $url = $this->apiBase.$path;
        $message = $nonce.$url.http_build_query($arr);
        $signature = hash_hmac("sha256", $message, $this->secretKey);
        $this->client->setDefaultOption('headers/ACCESS-NONCE', $nonce);
        $this->client->setDefaultOption('headers/ACCESS-SIGNATURE', $signature);
    }

    /**
     * Dispatch API request
     *
     * @param string $operation Target action
     * @param object $paramData Request data
     *
     */
    public function request($method, $path, $paramData)
    {
        $this->setSignature($path, $paramData);
        $req = $this->client->createRequest($method, $path, array());
        if($method == 'post' || $method == 'delete') {
            $req->setBody(json_encode($paramData),'application/json');
        }
        try {
            $res = $req->send();
            return $res->json();
        } catch (\Guzzle\Common\Exception\RuntimeException $e) {
            echo $e->getResponse()->getBody();
        }
    }
}
