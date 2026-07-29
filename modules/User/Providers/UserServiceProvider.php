<?php

declare(strict_types=1);

namespace Modules\User\Providers;

use Modules\Support\ModuleServiceProvider;

class UserServiceProvider extends ModuleServiceProvider
{
    protected function moduleName(): string
    {
        return 'User';
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
