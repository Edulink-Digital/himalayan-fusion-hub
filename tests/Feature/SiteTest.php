<?php

namespace Tests\Feature;

use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    /** @return array<string, array{string}> */
    public static function pages(): array
    {
        return ['home' => ['/'], 'events' => ['/events'], 'menu' => ['/menu'], 'book' => ['/book']];
    }

    #[DataProvider('pages')]
    public function test_public_pages_render(string $uri): void
    {
        $this->get($uri)->assertOk()->assertSee('Himalayan Fusion Hub');
    }

    public function test_referenced_images_exist(): void
    {
        $html = $this->get('/')->getContent().$this->get('/events')->getContent();
        preg_match_all('#/images/([a-z0-9-]+\.(?:webp|jpg))#', $html, $m);

        $this->assertNotEmpty($m[1]);
        foreach (array_unique($m[1]) as $file) {
            $this->assertFileExists(public_path('images/'.$file));
        }
    }

    public function test_valid_booking_is_stored(): void
    {
        $this->post('/book', [
            'name' => 'Test User', 'phone' => '0400 000 000', 'type' => 'table',
            'date' => now()->addWeek()->toDateString(), 'guests' => 6,
        ])->assertRedirect()->assertSessionHas('booked', 'Test');

        $this->assertSame(1, Reservation::count());
    }

    public function test_invalid_booking_is_rejected(): void
    {
        $this->post('/book', ['name' => '', 'phone' => '1', 'type' => 'nope', 'date' => '2001-01-01', 'guests' => 0])
            ->assertSessionHasErrors(['name', 'phone', 'type', 'date', 'guests']);

        $this->assertSame(0, Reservation::count());
    }

    public function test_booking_type_preselected_from_query(): void
    {
        $this->get('/book?type=vip')->assertSee('value="vip" checked', false);
    }

    public function test_home_shows_the_week_and_next_doors(): void
    {
        $this->get('/')
            ->assertSee('This week')
            ->assertSee('Doors open')
            ->assertSee('data-countdown="', false)
            ->assertSee('role="tab"', false);
    }

    public function test_menu_lists_every_dish(): void
    {
        $response = $this->get('/menu');

        foreach (config('hfh.menu') as $group) {
            foreach ($group['items'] as [$dish]) {
                $response->assertSee($dish);
            }
        }
    }
}
