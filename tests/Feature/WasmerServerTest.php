<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * PHP's built-in server on Wasmer Edge needs server.php as its router; without it,
 * Livewire's script route returns 404 and the Filament login cannot work.
 */
class WasmerServerTest extends TestCase
{
    public function test_wasmer_starts_php_with_the_router_script(): void
    {
        $manifest = file_get_contents(base_path('wasmer.toml'));

        $this->assertMatchesRegularExpression(
            '#main-args\s*=\s*\["-t",\s*"/app/public",\s*"-S",\s*"[^"]+",\s*"/app/server\.php"\]#',
            $manifest
        );
        $this->assertFileExists(base_path('server.php'));
    }

    /**
     * Several Wasmer instances share one SQLite file on the /data volume. Each instance must
     * take one request at a time, and SQLite must wait for a lock instead of failing at once
     * ("database is locked", seen on the live admin on 4 Nov 2026).
     */
    public function test_wasmer_app_limits_concurrency_and_waits_for_sqlite_locks(): void
    {
        $app = file_get_contents(base_path('app.yaml'));

        $this->assertMatchesRegularExpression('#^scaling:\s*\n\s+mode:\s*single_concurrency\s*$#m', $app);
        $this->assertMatchesRegularExpression('#^\s+DB_BUSY_TIMEOUT:\s*"?\d{4,}"?\s*$#m', $app);
    }

    public function test_sqlite_busy_timeout_comes_from_the_environment_setting(): void
    {
        config(['database.connections.sqlite.busy_timeout' => 5000]);
        DB::purge('sqlite');

        $timeout = DB::connection('sqlite')->selectOne('PRAGMA busy_timeout');

        $this->assertSame(5000, (int) array_values((array) $timeout)[0]);
        $this->assertStringContainsString("env('DB_BUSY_TIMEOUT')", file_get_contents(config_path('database.php')));
    }

    public function test_router_hands_real_public_files_to_the_built_in_server(): void
    {
        $previous = $_SERVER['REQUEST_URI'] ?? null;
        $_SERVER['REQUEST_URI'] = '/css/hfh.css?v=1';

        try {
            $result = require base_path('server.php');
        } finally {
            $_SERVER['REQUEST_URI'] = $previous;
        }

        $this->assertFalse($result);
    }
}
