<?php
namespace Coincheck;

class Button
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\CoincheckPayment $client)
    {
        $this->client = $client;
    }

    /**
     * ボタンを取得できます。
     *
     * @param  mixed
     * @return Json Array
     */
    public function set($params = array())
    {
        $arr = array(
            'button' => array(
                'name' => $params['name'],
                'currency' => $params['currency'],
                'amount' => $params['amount'],
                'callback_url' => $params['callback_url'],
                'max_times' => $params['max_times']
            )
        );
        $rawResponse = $this->client->request('post', 'buttons', $arr);
        return $rawResponse;
    }

}
