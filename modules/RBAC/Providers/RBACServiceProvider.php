<?php

declare(strict_types=1);

namespace Modules\RBAC\Providers;

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
    }
}
