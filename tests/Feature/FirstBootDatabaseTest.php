<?php

namespace Tests\Feature;

use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class FirstBootDatabaseTest extends TestCase
{
    private string $directory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->directory = storage_path('framework/testing/first-boot-'.uniqid());
    }

    protected function tearDown(): void
    {
        DB::purge('sqlite');
        File::deleteDirectory($this->directory);

        parent::tearDown();
    }

    private function bootWithDatabaseAt(string $path, bool $autoMigrate): void
    {
        config([
            'hfh.auto_migrate' => $autoMigrate,
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => $path,
        ]);
        DB::purge('sqlite');

        (new AppServiceProvider($this->app))->boot();
    }

    public function test_missing_sqlite_file_is_created_and_migrated_when_enabled(): void
    {
        $path = $this->directory.'/database.sqlite';

        $this->bootWithDatabaseAt($path, autoMigrate: true);

        $this->assertFileExists($path);
        $this->assertTrue(Schema::connection('sqlite')->hasTable('reservations'));
    }

    public function test_existing_database_gets_new_migrations_once(): void
    {
        $path = $this->directory.'/database.sqlite';
        File::ensureDirectoryExists($this->directory);
        File::put($path, '');

        $this->bootWithDatabaseAt($path, autoMigrate: true);

        $this->assertTrue(Schema::connection('sqlite')->hasTable('site_settings'));
        $this->assertCount(1, File::glob($this->directory.'/.migrated-*'));
    }

    public function test_nothing_is_created_when_disabled(): void
    {
        $path = $this->directory.'/database.sqlite';

        $this->bootWithDatabaseAt($path, autoMigrate: false);

        $this->assertFileDoesNotExist($path);
    }
}
