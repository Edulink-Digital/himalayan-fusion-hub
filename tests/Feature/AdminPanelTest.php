<?php

namespace Tests\Feature;

use App\Filament\Pages\SiteContent;
use App\Filament\Resources\Reservations\Pages\ListReservations;
use App\Models\Reservation;
use App\Models\SiteSetting;
use App\Models\User;
use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_panel_requires_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_signed_in_admin_sees_site_content_and_bookings(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get('/admin/site-content')->assertOk()->assertSee('Colour theme');
        $this->get('/admin/reservations')->assertOk();
    }

    public function test_saving_site_content_updates_the_public_site(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(SiteContent::class)
            ->set('data.home.hero_title', 'Momo Night In Balcatta')
            ->set('data.theme', 'vice')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame('vice', SiteSetting::query()->where('key', 'theme')->value('value'));

        $this->get('/')
            ->assertSee('Momo Night In Balcatta')
            ->assertSee('data-theme="vice"', false);
    }

    public function test_saved_settings_are_applied_on_boot(): void
    {
        SiteSetting::query()->create(['key' => 'faq', 'value' => [['question' => 'Is there snooker?', 'answer' => 'Yes, every night.']]]);

        (new AppServiceProvider($this->app))->boot();

        $this->get('/events')->assertSee('Is there snooker?')->assertSee('Yes, every night.');
    }

    public function test_phone_and_address_derive_their_link_formats(): void
    {
        $derived = SiteSetting::derivedFrom([
            'name' => 'Himalayan Fusion Hub',
            'phone' => '0412 345 678',
            'address' => 'Unit 5/10 Main St, Osborne Park WA 6017',
        ]);

        $this->assertSame('+61412345678', $derived['phone_href']);
        $this->assertSame('61412345678', $derived['whatsapp']);
        $this->assertSame(['Unit 5/10 Main St', 'Osborne Park WA 6017'], $derived['address_lines']);
        $this->assertStringContainsString('Osborne+Park', $derived['maps_link']);
    }

    /** @return array<string, array{string}> */
    public static function themes(): array
    {
        return ['midnight' => ['midnight'], 'disco' => ['disco'], 'vice' => ['vice']];
    }

    #[DataProvider('themes')]
    public function test_each_theme_renders(string $theme): void
    {
        config(['hfh.theme' => $theme]);

        $this->get('/')->assertOk()->assertSee('data-theme="'.$theme.'"', false);
    }

    public function test_unknown_theme_falls_back_to_midnight(): void
    {
        config(['hfh.theme' => 'neon-nonsense']);

        $this->get('/')->assertSee('data-theme="midnight"', false);
    }

    public function test_bookings_inbox_lists_requests(): void
    {
        $this->actingAs(User::factory()->create());
        $booking = Reservation::query()->forceCreate([
            'name' => 'Pema Dorji', 'phone' => '0400 111 222', 'type' => 'snooker',
            'date' => now()->addDays(3)->toDateString(), 'guests' => 5,
        ]);

        Livewire::test(ListReservations::class)->assertCanSeeTableRecords([$booking]);
    }

    public function test_first_admin_is_created_from_environment_when_none_exists(): void
    {
        config(['hfh.admin_email' => 'owner@example.test', 'hfh.admin_password' => 'a-long-test-password']);

        (new AppServiceProvider($this->app))->boot();

        $this->assertTrue(User::query()->where('email', 'owner@example.test')->exists());
    }
}
