<?php
/**
 * Created by PhpStorm.
 * User: lesvere
 * Date: 16-12-16
 * Time: 下午1:23
 */

namespace Lesvere\Msms;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Lesvere\Msms\Contracts\Factory;
use Lesvere\Msms\Providers\MsmsProviderManager;

class MsmsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/msms.php' => config_path('msms.php')
        ]);
    }

    public function register()
    {
        $this->app->singleton(Factory::class, function () {
            return new MsmsProviderManager(config('msms'), new Client());
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Factory::class];
    }
}
