<?php
/**
 * Created by PhpStorm.
 * User: Musa
 * Date: 23.03.2019
 * Time: 15:24
 */

namespace MTGofa\PerfectlyCache\Providers;

use Illuminate\Support\ServiceProvider;
use MTGofa\PerfectlyCache\Commands\PerfectlyCacheClearCommand;
use MTGofa\PerfectlyCache\Commands\PerfectlyCacheListCommand;
use MTGofa\PerfectlyCache\Events\ModelEvents;
use MTGofa\PerfectlyCache\Extensions\PerfectlyStore;
use MTGofa\PerfectlyCache\Listeners\ModelDispactEventListener;
use MTGofa\PerfectlyCache\PerfectlyCache;

class PerfectlyCacheServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot() {
        $this->registerSingletons();
        $this->registerAlias();
        $this->publish();
        $this->registerCommands();
    }

    public function register()
    {
        parent::register();

        $this->mergeConfigFrom(__DIR__. '/../config/config.php', 'perfectly-cache');
    }

    /**
     * Register singletons to app
     */
    protected function registerSingletons() {
        $this->app->singleton(PerfectlyCache::class);
    }

    /**
     * Register alias to app
     */
    protected function registerAlias() {
        $this->app->alias(PerfectlyCache::class, "perfectly-cache");
    }

    /**
     * Publish vendors
     */
    protected function publish() {
        $this->publishes([
            __DIR__. '/../config/config.php' => config_path('perfectly-cache.php')
        ]);
    }

    protected function registerCommands() {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PerfectlyCacheClearCommand::class,
                PerfectlyCacheListCommand::class
            ]);
        }
    }
}
