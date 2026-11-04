<?php

namespace Tests\Feature;

use Tests\TestCase;

class SearchAndHeaderTest extends TestCase
{
    public function test_header_shows_contact_socials_navbar_and_search(): void
    {
        $this->get('/')
            ->assertSee('class="topbar"', false)
            ->assertSee('tel:'.config('hfh.phone_href'), false)
            ->assertSee('mailto:'.config('hfh.email'), false)
            ->assertSee(config('hfh.socials.facebook'), false)
            ->assertSee('class="mainnav"', false)
            ->assertSee('data-search', false)
            ->assertSee('action="'.route('search').'"', false);
    }

    public function test_empty_social_links_are_hidden(): void
    {
        config(['hfh.socials' => ['facebook' => '', 'instagram' => '', 'tiktok' => '']]);

        $this->get('/')->assertDontSee('Follow us');
    }

    public function test_navbar_marks_the_current_page(): void
    {
        $this->assertMatchesRegularExpression(
            '#class="is-active"\s+aria-current="page"\s*>Menu</a>#',
            $this->get('/menu')->getContent()
        );
    }

    public function test_search_finds_menu_items_nights_and_faq(): void
    {
        $this->get('/search?q=momo')->assertOk()->assertSee('Chicken Momo')->assertSee(route('menu'), false);
        $this->get('/search?q=karaoke')->assertSee('Karaoke Lounge');
        $this->get('/search?q=snooker+table')->assertSee('Can I book a snooker table?');
    }

    public function test_search_with_no_match_offers_a_phone_call(): void
    {
        $this->get('/search?q=zzzqqq')->assertOk()->assertSee('Nothing matched')->assertSee('tel:', false);
    }

    public function test_empty_search_shows_the_prompt(): void
    {
        $this->get('/search')->assertOk()->assertSee('Search the nights, menu');
    }
}
