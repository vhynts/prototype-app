<?php

namespace Modules\RBAC\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

class RBACServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(module_path('RBAC', 'resources/views'), 'rbac');
        
        if (file_exists(module_path('RBAC', 'routes/web.php'))) {
            Route::middleware('web')
                ->group(module_path('RBAC', 'routes/web.php'));
        }

        // Register Spatie middleware aliases
        $this->app->booted(function () {
            $router = $this->app->make(Router::class);
            $router->aliasMiddleware('role', \Spatie\Permission\Middleware\RoleMiddleware::class);
            $router->aliasMiddleware('permission', \Spatie\Permission\Middleware\PermissionMiddleware::class);
            $router->aliasMiddleware('role_or_permission', \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class);
        });
    }
}
