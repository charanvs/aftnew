<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($route, $output = 'active')
    {
        return Route::currentRouteName() === $route ? $output : '';
    }
}

if (!function_exists('areActiveRoutes')) {
    function areActiveRoutes(array $routes, $output = 'active')
    {
        return in_array(Route::currentRouteName(), $routes) ? $output : '';
    }
}
