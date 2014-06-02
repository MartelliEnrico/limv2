<?php namespace LimManager\Config;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('config', function()
        {
            $loader = $this->app->getConfigLoader();
            $writer = new FileWriter($loader, $this->app['path'].'/config', new Rewriter);
            return new Repository($loader, $writer, $this->app['env']);
        });
    }

}