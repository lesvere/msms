<?php
/**
 * Created by PhpStorm.
 * User: lesvere
 * Date: 16-12-17
 * Time: 上午10:37
 */

namespace Lesvere\Msms\Providers\AlidayuProvider;


use Lesvere\Msms\Providers\AlidayuProvider\Traits\MethodSetter;
use Psr\Http\Message\ResponseInterface;

class AlidayuSms extends AbstractProvider
{
    use MethodSetter;

    /**
     * Get response from the send API .
     *
     * @param  array $params
     * @return ResponseInterface
     */
    public function send($params)
    {
        $this->setMethod('sms.send');
        $this->checkParams($params);
        return $this->getResponse($params);
    }

    /**
     * Get response from the query API .
     *
     * @param  array $params
     * @return ResponseInterface
     */
    public function query($params)
    {
        $params = array_merge(['current_page' => 1, 'page_size' => 20], $params);
        if ($params['page_size'] > 50) {
            $params['page_size'] = 50;
        }
        $this->checkParams($params, 'sms.query');
        $this->setMethod('sms.query');
        return $this->getResponse($params);
    }
}
