<?php

declare(strict_types=1);

namespace BladeUIKit;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

final class BladeUIKitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-ui-kit.php', 'blade-ui-kit');
    }

    public function boot(): void
    {
        $this->bootResources();
        $this->bootBladeComponents();
        $this->bootLivewireComponents();
        $this->bootDirectives();
        $this->bootPublishing();
    }

    private function bootResources(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'blade-ui-kit');
    }

    private function bootBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            $prefix = config('blade-ui-kit.prefix', '');

            foreach (config('blade-ui-kit.components', []) as $alias => $component) {
                $blade->component($component, $alias, $prefix);
                $blade->component($component, 'internal-' . $component::internalAlias(), $prefix);

                foreach ($component::styles() as $style) {
                    BladeUIKit::addStyle($style);
                }

                foreach ($component::scripts() as $script) {
                    BladeUIKit::addScript($script);
                }
            }
        });
    }

    private function bootLivewireComponents(): void
    {
        // Skip if Livewire isn't installed.
        if (! class_exists(Livewire::class)) {
            return;
        }

        $prefix = config('blade-ui-kit.prefix', '');

        foreach (config('blade-ui-kit.livewire', []) as $alias => $component) {
            $alias = $prefix ? "$prefix-$alias" : $alias;

            Livewire::component($alias, $component);
        }
    }

    private function bootDirectives(): void
    {
        Blade::directive('bukStyles', function () {
            return "<?php echo BladeUIKit\\BladeUIKit::outputStyles(); ?>";
        });

        Blade::directive('bukScripts', function () {
            return "<?php echo BladeUIKit\\BladeUIKit::outputScripts(); ?>";
        });
    }

    private function bootPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/blade-ui-kit.php' => $this->app->configPath('blade-ui-kit.php'),
            ], 'blade-ui-kit-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => $this->app->resourcePath('views/vendor/blade-ui-kit'),
            ], 'blade-ui-kit-views');
        }
    }
}
