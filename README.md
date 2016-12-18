
# Lesvere Msms

[![License](http://oh6m3pqwm.bkt.clouddn.com/composer/license-mit.svg)](https://packagist.org/packages/lesvere/msms)

![](http://oh6m3pqwm.bkt.clouddn.com/composer/original-msms.png)

## Introduction

Simple muti-sms gateway package for sending short text messages from your Application.Facade for Laravel 5.Currently supported Gateways Alidayu, Webpower /Any HTTP/s based Gateways are supported by Custom Gateway. Log gateway can be used for testing.

## Installion

To get started with Msms, add to your `composer.json` file as a dependency:

    composer require lesvere/msms

Then type the `composer install` command to the cli.

## Configure

After installing the Msms libary, register the `Lesvere\Msms\MsmsServiceProvider` in your `config/app.php` configuration file:

    'providers' => [
        // Lesvere\Msms service providers...

	Lesvere\Msms\MsmsServiceProvider::class,
    ]

Also, add the `Msms` facades to the `aliases` array in your `app.php` configuration file:

    'Msms' => Lesvere\Msms\Facades\Msms::class

Then, you will need to publish the `msms.php` configuration file to the `config` directory:

    php artisan vendor:publish --provider="Lesvere\Msms\MsmsServiceProvider"

Also, you will need register the application infomation within `config/msms.php`.

## Usage

Now you can request any interface by Msms facades, to send an sms, you may code like this:

    <?php
    namespace App\Http\Controllers;

    use Msms;

    class MsmsController extends Controller
    {
        public function sendSms()
        {
            $response = Msms::gateway('alidayu')
		->driver('sms')->send([
                    'extend' => 'wang',
                    'sms_type' => 'normal',
                    'sms_free_sign_name' => 'test',
                    'sms_param' => '{"code": "3052", "name": "Dearmadman"}',
                    'rec_num' => '18949825252',
                    'sms_template_code' => 'SMS_16691757'
                ]);

            dd($response->getBody()->getContents());
        }
    }


Next, we will list the rest of interface in fllow:

**alibaba.aliqin.fc.sms.num.query**

    $response = Msms::gateway('alidayu')
	->driver('sms')->query([
	    'rec_num' => 13213213203,
	    'query_date' => '20161216',
	    'current_page' => 1,
	    'page_size' => 10,
    	]);

**alibaba.aliqin.fc.tts.num.singlecall**

    $response = Msms::gateway('alidayu')
	->driver('tts')->singleCall([
            'extend' => 'wang',
            'tts_param' => '{"name": "wang", "code": "Dearmadman"}',
            'called_num' => 18949825252,
            'called_show_num' => '051482043271',
            'tts_code' => 'TTS_16825713'
	]);

**alibaba.aliqin.fc.voice.num.singlecall**

    $response = Msms::gateway('alidayu')
	->driver('voice')->singleCall([
            'extend' => 'wang',
            'called_num' => 18949825252,
            'called_show_num' => '051482043271',
            'voice_code' => '2fc5d547-71c0-45e6-8b06-1f3dc40b630c.wav',
	]);

**alibaba.aliqin.fc.voice.num.doublecall**

    $response = Msms::gateway('alidayu')
	->driver('voice')->doubleCall([
            'extend' => 'Dearmadman',
            'caller_num' => 18949825252,
            'caller_show_num' => '51482043271',
            'called_num' => 18949825250,
            'called_show_num' => '51482043271',
	]);

**alibaba.aliqin.fc.flow.query**

    $response = Msms::gateway('alidayu')
	->driver('flow')->query([
            'out_id' => 'out_id'  // options
	]);

**alibaba.aliqin.fc.flow.charge**

    $response = Msms::gateway('alidayu')
	->driver('flow')->charge([
            'phone_num' => 18949825252,
            'reason' => 'no reason',
            'grade' => '50',
            'out_recharge_id' => '6d9fce1e',
	]);

**alibaba.aliqin.fc.flow.grade**

    $response = Msms::gateway('alidayu')->driver('flow')->grade();

**alibaba.aliqin.fc.flow.charge.province**

    $response = Msms::gateway('alidayu')
	->driver('flow')->chargeProvince([
            'phone_num' => 18949825252,
            'reason' => 'no reason',
            'grade' => '50',
            'out_recharge_id' => '6d9fce1e',
    	]);


Simple like this and easy to use. :)
