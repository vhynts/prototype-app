<?php

use App\Providers\AppServiceProvider;
use Modules\Auth\Providers\AuthServiceProvider;
use Modules\User\Providers\UserServiceProvider;
use Modules\RBAC\Providers\RBACServiceProvider;

return [
    AppServiceProvider::class,
    AuthServiceProvider::class,
    UserServiceProvider::class,
    RBACServiceProvider::class,
];
