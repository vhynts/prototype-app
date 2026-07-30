<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(module_path('Auth', 'resources/views'), 'auth');
        
        Route::middleware('web')
            ->group(module_path('Auth', 'routes/web.php'));
    }
}
