<?php
/**
 * Created by PhpStorm.
 * User: lesvere
 * Date: 16-12-17
 * Time: 下午2:49
 */

namespace Lesvere\Msms\Providers\WebpowerProvider;


use GuzzleHttp\Client;

class WebpowerSms
{
    /**
     * @var array $config
     */
    private $config;

    /**
     * @var $httpClient Client
     */
    private $httpClient;

    private $url = 'http://flyertrip.webpowerchina.cn/sms/rest/v1/sms';

    /**
     * WebpowerSms constructor.
     *
     * @param $config
     * @param $client
     */
    public function __construct($config, $client)
    {
        $this->config     = $config;
        $this->httpClient = $client;
    }

    public function send()
    {
        $response = $this->httpClient->request('POST', $this->url, $this->_getQueryBody($param));

        return $response->getBody();
    }

    /**
     * Get Guzzle Requiest Query String.
     *
     * @param array $param
     * @return array
     */
    private function _getQueryBody($param)
    {
        $config = config('msms.webpower');
        $code   = base64_encode($config['account'] . ':' . $this->config['password']);

        return [
            'headers' => [
                'Content-Type'  => 'application/json',
                'Authorization' => 'Basic ' . $code,
            ],
            'query'   => array_merge($this->config, $param)
        ];
    }
}