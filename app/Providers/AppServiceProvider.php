<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->prepareSqliteDatabase();
    }

    /**
     * Create and migrate the SQLite database when it is missing, for hosts that start
     * with an empty disk (such as a Wasmer Edge volume). Off unless HFH_AUTO_MIGRATE is set.
     */
    private function prepareSqliteDatabase(): void
    {
        if (! config('hfh.auto_migrate') || config('database.default') !== 'sqlite') {
            return;
        }

        $database = config('database.connections.sqlite.database');

        if ($database === ':memory:' || File::exists($database)) {
            return;
        }

        File::ensureDirectoryExists(dirname($database));
        File::put($database, '');

        Artisan::call('migrate', ['--force' => true]);
    }
}
