<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\QueryException;
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
        $this->applySavedContent();
        $this->ensureAdminUser();
    }

    /**
     * Create the SQLite database when it is missing and run any new migrations, for hosts
     * without shell access (such as Wasmer Edge). A marker file named after the current set of
     * migrations means this only migrates once per deploy that adds a migration.
     * Off unless HFH_AUTO_MIGRATE is set.
     */
    private function prepareSqliteDatabase(): void
    {
        if (! config('hfh.auto_migrate') || config('database.default') !== 'sqlite') {
            return;
        }

        $database = config('database.connections.sqlite.database');

        if ($database === ':memory:') {
            return;
        }

        $migrations = array_map('basename', File::glob(database_path('migrations/*.php')));
        $marker = dirname($database).'/.migrated-'.md5(implode(',', $migrations));

        if (File::exists($database) && File::exists($marker)) {
            return;
        }

        File::ensureDirectoryExists(dirname($database));

        if (! File::exists($database)) {
            File::put($database, '');
        }

        Artisan::call('migrate', ['--force' => true]);
        File::put($marker, now()->toIso8601String());
    }

    /**
     * Apply content edited in the admin panel over the config/hfh.php defaults.
     * Before the tables exist (fresh install, tests) the defaults are used as they are.
     */
    private function applySavedContent(): void
    {
        try {
            SiteSetting::applyToConfig();
        } catch (QueryException) {
            //
        }
    }

    /**
     * Create the first admin login from ADMIN_EMAIL and ADMIN_PASSWORD when no user exists yet,
     * so a fresh host (or a fresh volume) can be signed into without shell access.
     */
    private function ensureAdminUser(): void
    {
        $email = config('hfh.admin_email');
        $password = config('hfh.admin_password');

        if (blank($email) || blank($password)) {
            return;
        }

        try {
            if (User::query()->exists()) {
                return;
            }

            User::query()->create(['name' => 'Admin', 'email' => $email, 'password' => $password]);
        } catch (QueryException) {
            //
        }
    }
}
