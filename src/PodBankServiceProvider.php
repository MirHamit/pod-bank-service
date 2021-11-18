<?php

namespace MirHamit\PodBankService;

use Illuminate\Support\ServiceProvider;

/**
 * @author Həmid Musəvi <w1w@yahoo.com>
 * 11/13/21
 */
class PodBankServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/pod.php', 'pod');
        $this->app->make('MirHamit\PodBankService\Services\SavingAccount');
    }

    public function boot()
    {

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/pod.php' => config_path('pod.php'),
            ], 'pod-config');
        }
    }

}
