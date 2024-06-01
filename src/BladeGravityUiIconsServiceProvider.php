<?php

declare(strict_types=1);

namespace Codeat3\BladeGravityUiIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeGravityUiIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-gravity-ui-icons', []);

            $factory->add('gravity-ui-icons', array_merge(['path' => __DIR__ . '/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-gravity-ui-icons.php', 'blade-gravity-ui-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/svg' => public_path('vendor/blade-gravity-ui-icons'),
            ], 'blade-gravity-ui'); // TODO: updating this alias to `blade-gravity-ui-icons` in next major release

            $this->publishes([
                __DIR__ . '/../config/blade-gravity-ui-icons.php' => $this->app->configPath('blade-gravity-ui-icons.php'),
            ], 'blade-gravity-ui-icons-config');
        }
    }
}
