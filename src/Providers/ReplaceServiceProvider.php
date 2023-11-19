<?php

namespace Bytenetizen\FastReplace\Providers;

use Bytenetizen\FastReplace\Console\MakePlaceholder;
use Bytenetizen\FastReplace\Console\RunSeedAfterMigrateCommand;
use Bytenetizen\FastReplace\Replace;
use Illuminate\Support\ServiceProvider;

class ReplaceServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind('fast-replace', function() {
            return new Replace();
        });
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'replace');
    }

    public function boot(): void
    {
        // Load Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('replace.php'),
            ], 'config');

            $this->commands([
                RunSeedAfterMigrateCommand::class,
                MakePlaceholder::class
            ]);
        }

    }

}
