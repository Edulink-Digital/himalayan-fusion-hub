<?php

namespace Tests\Feature;

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
