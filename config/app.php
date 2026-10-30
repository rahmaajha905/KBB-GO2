<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'name' => env('APP_NAME', 'KBB GO!'),

    'env' => env('APP_ENV', 'production'),

    'debug' => (bool) env('APP_DEBUG', false),

    'url' => env('APP_URL', 'http://localhost:8000'),

    'asset_url' => env('ASSET_URL'),

    'timezone' => 'Asia/Jakarta',

    'locale' => 'id',

    'fallback_locale' => 'en',

    'faker_locale' => 'id_ID',

    'key' => env('APP_KEY', 'base64:7KqM+q0sL2NqD5O9vF1sZ8wU4eR3tY6aP0oI9uY8tXw='),

    'cipher' => 'AES-256-CBC',

    'maintenance' => [
        'driver' => 'file',
    ],

    'providers' => ServiceProvider::defaultProviders()->merge([
        App\Providers\AppServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ])->toArray(),

    'aliases' => Facade::defaultAliases()->merge([
        //
    ])->toArray(),

];
