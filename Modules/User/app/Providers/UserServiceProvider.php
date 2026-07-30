<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class UserServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('User', 'database/migrations'));
        
        $this->loadViewsFrom(module_path('User', 'resources/views'), 'user');
        
        // Ensure web middleware wraps the routes if they exist
        if (file_exists(module_path('User', 'routes/web.php'))) {
            Route::middleware('web')
                ->group(module_path('User', 'routes/web.php'));
        }
    }
}
