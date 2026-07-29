<?php

declare(strict_types=1);

if (! function_exists('module_path')) {
    /**
     * Dapatkan path ke module tertentu.
     *
     * @param  string  $module  Nama module (contoh: 'Auth', 'User')
     * @param  string  $path    Path tambahan di dalam module
     * @return string
     */
    function module_path(string $module, string $path = ''): string
    {
        $basePath = base_path('modules/' . ucfirst($module));

        if ($path) {
            return $basePath . '/' . ltrim($path, '/');
        }

        return $basePath;
    }
}

if (! function_exists('module_namespace')) {
    /**
     * Dapatkan namespace untuk module tertentu.
     *
     * @param  string  $module  Nama module (contoh: 'Auth', 'User')
     * @param  string  $path    Path tambahan di dalam namespace
     * @return string
     */
    function module_namespace(string $module, string $path = ''): string
    {
        $namespace = 'Modules\\' . ucfirst($module);

        if ($path) {
            return $namespace . '\\' . str_replace('/', '\\', $path);
        }

        return $namespace;
    }
}

if (! function_exists('module_view')) {
    /**
     * Dapatkan view dari module tertentu.
     *
     * @param  string  $module  Nama module (contoh: 'Auth', 'User')
     * @param  string  $view    Nama view
     * @return string
     */
    function module_view(string $module, string $view): string
    {
        return strtolower($module) . '::' . $view;
    }
}
