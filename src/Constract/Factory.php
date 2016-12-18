<?php
/**
 * Created by PhpStorm.
 * User: lesvere
 * Date: 16-12-16
 * Time: 下午1:27
 */

namespace Lesvere\Msms\Contracts;


interface Factory
{
    /**
     * Select a sms gateway.
     *
     * @param $drive
     * @return mixed
     */
    public function driver($drive);
}