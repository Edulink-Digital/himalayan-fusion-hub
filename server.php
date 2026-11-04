<?php

/*
 * Router for PHP's built-in web server on Wasmer Edge (see wasmer.toml).
 *
 * Without a router, the built-in server answers any missing URL that ends in a file
 * extension with a 404 instead of passing it to Laravel, which breaks routes such as
 * the script route of Livewire, which Filament's login form and password toggle need.
 * This mirrors Laravel's own `php artisan serve` router, with the public path fixed.
 */

$publicPath = __DIR__.'/public';

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '');

if ($uri !== '/' && is_file($publicPath.$uri)) {
    return false;
}

require $publicPath.'/index.php';
