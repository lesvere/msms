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
     * @var string $account
     */
    private $account;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $content
     */
    private $content;

    /**
     * @var string $mobile
     */
    private $mobile;

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
        $this->account  = $config['account'];
        $this->password = $config['password'];
//        $this->campaignID = $config['campaignID'];
        $this->httpClient = $client;
    }

    public function send($param)
    {
        $this->mobile  = $param['mobile'];
        $this->content = $param['content'];

        $ci      = curl_init();
        $options = array(
            "Content-Type: application/json",
            "X-HTTP-Method-Override: POST",
            "Authorization: Basic " . base64_encode($this->account . ":" . $this->password)
        );
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ci, CURLOPT_HTTPHEADER, $options);
        curl_setopt($ci, CURLOPT_POSTFIELDS, json_encode(['mobile' => $this->mobile,'content' => $this->content]));
        curl_setopt($ci, CURLOPT_URL, $this->url);
        $response = curl_exec($ci);
        curl_close($ci);
        return $response;

//        $response = $this->httpClient->post($this->url, $this->_getQueryBody());
//        return $response->getBody();
    }

    /**
     * Get Guzzle Requiest Query String.
     *
     * @param array $param
     * @return array
     */
    private function _getQueryBody()
    {
        return [
            'headers'     => [
                "Content-Type: application/json",
                "X-HTTP-Method-Override: POST",
                'Authorization' => 'Basic ' . base64_encode($this->account . ':' . $this->password),
            ],
            'form_params' => [
                'mobile'  => $this->mobile,
                'content' => $this->content,
            ],
        ];
    }
}
