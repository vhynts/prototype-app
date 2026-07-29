<?php

declare(strict_types=1);

namespace Modules\Support;

use Illuminate\Support\ServiceProvider;

abstract class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Nama module (contoh: 'Auth', 'User', 'RBAC').
     * Digunakan untuk namespace views dan path.
     */
    abstract protected function moduleName(): string;

    /**
     * Base path module (contoh: modules/Auth).
     */
    protected function modulePath(): string
    {
        return module_path($this->moduleName());
    }

    /**
     * Register service provider.
     */
    public function register(): void
    {
        $this->registerRoutes();
        $this->registerViews();
        $this->registerMigrations();
    }

    /**
     * Boot service provider.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register routes dari module.
     */
    protected function registerRoutes(): void
    {
        $routesPath = $this->modulePath() . '/Routes/web.php';

        if (file_exists($routesPath)) {
            $this->callAfterResolving('router', function ($router) use ($routesPath) {
                $router->middleware('web')
                    ->group($routesPath);
            });
        }
    }

    /**
     * Register views dari module.
     * Views bisa diakses dengan prefix nama module (contoh: auth::login).
     */
    protected function registerViews(): void
    {
        $viewsPath = $this->modulePath() . '/Views';

        if (is_dir($viewsPath)) {
            $this->loadViewsFrom($viewsPath, strtolower($this->moduleName()));
        }
    }

    /**
     * Register migrations dari module.
     */
    protected function registerMigrations(): void
    {
        $migrationsPath = $this->modulePath() . '/Database/migrations';

        if (is_dir($migrationsPath)) {
            $this->loadMigrationsFrom($migrationsPath);
        }
    }
}
