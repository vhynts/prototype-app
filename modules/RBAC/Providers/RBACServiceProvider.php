<?php

declare(strict_types=1);

namespace Modules\RBAC\Providers;

use Illuminate\Routing\Router;
use Modules\Support\ModuleServiceProvider;

class RBACServiceProvider extends ModuleServiceProvider
{
    protected function moduleName(): string
    {
        return 'RBAC';
    }

    public function register(): void
    {
        parent::register();
    }

    public function boot(): void
    {
        parent::boot();

        // Register Spatie middleware aliases
        $this->app->booted(function () {
            $router = $this->app->make(Router::class);
            $router->aliasMiddleware('role', \Spatie\Permission\Middleware\RoleMiddleware::class);
            $router->aliasMiddleware('permission', \Spatie\Permission\Middleware\PermissionMiddleware::class);
            $router->aliasMiddleware('role_or_permission', \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class);
        });
    }
}
