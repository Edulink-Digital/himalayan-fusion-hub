<?php

namespace Tests\Feature;

use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

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
        preg_match_all('#/images/([a-z0-9-]+\.webp)#', $html, $m);

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
        $this->get('/book?type=vip')->assertSee('value="vip" selected', false);
    }

    public function test_floating_buttons_link_to_whatsapp_and_top(): void
    {
        $this->get('/')
            ->assertSee('https://wa.me/61493964334', false)
            ->assertSee('data-to-top', false)
            ->assertDontSee('mailto:', false);
    }

    public function test_email_button_appears_once_an_address_is_set(): void
    {
        config(['hfh.email' => 'hello@example.com']);

        $this->get('/')->assertSee('mailto:hello@example.com', false);
    }
}
