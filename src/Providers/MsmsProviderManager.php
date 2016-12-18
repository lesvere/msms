<?php
/**
 * Created by PhpStorm.
 * User: lesvere
 * Date: 16-12-16
 * Time: 下午1:29
 */

namespace Lesvere\Msms\Providers;

use Lesvere\Msms\Contracts\Factory;
use Lesvere\Msms\Providers\AlidayuProvider\AlidayuSms;
use Lesvere\Msms\Providers\WebpowerProvider\WebpowerSms;

class MsmsProviderManager implements Factory
{
    protected $config;
    protected $instance;
    protected $httpClient;

    /**
     * SmsGatewayManager constructor.
     *
     * @param $config
     * @param $client
     */
    public function __construct($config, $client)
    {
        $this->config     = $config;
        $this->httpClient = $client;
    }

    public function driver($driver)
    {
        if (isset($this->instance[$driver])) {
            return $this->instance[$driver];
        }

        switch ($driver) {
            case 'alidayu':
                return new AlidayuSms($this->config[$driver], $this->httpClient);
                break;
            case 'webpower':
                return new WebpowerSms($this->config[$driver], $this->httpClient);
                break;
            default:
                return new AlidayuSms($this->config[$driver], $this->httpClient);
                break;
        }
    }
}