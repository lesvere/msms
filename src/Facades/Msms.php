<?php
/**
 * Created by PhpStorm.
 * User: lesvere
 * Date: 16-12-16
 * Time: 下午1:36
 */

namespace Lesvere\Msms\Facades;


use Illuminate\Support\Facades\Facade;
use Lesvere\Msms\Contracts\Factory;

class Msms extends Facade
{
    public static function getFacadeAccessor()
    {
        return Factory::class;
    }
}