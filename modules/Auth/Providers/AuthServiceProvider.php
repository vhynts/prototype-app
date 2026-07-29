<?php

declare(strict_types=1);

namespace Modules\Auth\Providers;

use Modules\Support\ModuleServiceProvider;

class AuthServiceProvider extends ModuleServiceProvider
{
    protected function moduleName(): string
    {
        return 'Auth';
    }

    public function register(): void
    {
        parent::register();
    }

    public function boot(): void
    {
        parent::boot();
    }
}
