@extends('layouts.app')

@section('content')
@php $page = config('hfh.home'); @endphp
<section class="hero" aria-labelledby="hero-title">
    @include('partials.hero-bg')
    <span class="shape sh-tri" style="left:6%;top:24%" aria-hidden="true"></span>
    <span class="shape sh-line" style="right:34%;top:30%" aria-hidden="true"></span>
    <div class="wrap hero-grid">
        <div>
            <p class="kicker rv">{{ $page['hero_kicker'] }}</p>
            <h1 id="hero-title" class="rv" style="--d:1">{{ $page['hero_title'] }}</h1>
            <p class="lead rv" style="--d:2">{{ $page['hero_lead'] }}</p>
            <div class="cta-row rv" style="--d:3">
                <a class="btn" href="{{ route('book') }}">{{ $page['hero_cta'] }}</a>
                <a class="btn btn-outline" href="{{ route('book') }}?type=vip">{{ $page['hero_cta_secondary'] }}</a>
            </div>
        </div>
        <div class="deck rv" style="--d:2">
            <div class="halo" aria-hidden="true"></div>
            <div class="frame"><img src="{{ asset('images/hero-dj.webp') }}" width="900" height="1100" alt="DJ wearing headphones mixing on the decks" fetchpriority="high"></div>
            <div class="eqbig" aria-hidden="true">@for ($i = 0; $i < 22; $i++)<i style="animation-delay:-{{ ($i * 0.17) % 1.1 }}s;animation-duration:{{ 0.7 + (($i * 7) % 9) / 10 }}s"></i>@endfor</div>
        </div>
    </div>
</section>

<section class="sec" id="about" aria-labelledby="about-title">
    <div class="wrap about">
        <div class="collage rv">
            <div class="pic p1"><img src="{{ asset('images/about-dance.webp') }}" width="700" height="800" loading="lazy" alt="Crowd in red laser light on the dance floor"></div>
            <div class="pic p2"><img src="{{ asset('images/about-mic.webp') }}" width="700" height="800" loading="lazy" alt="Vintage microphone against a blue backdrop"></div>
            <div class="pic p3"><img src="{{ asset('images/about-bar.webp') }}" width="800" height="560" loading="lazy" alt="Cocktail being poured at a lit bar"></div>
            <span class="shape sh-ring" aria-hidden="true"></span><span class="shape sh-tri" aria-hidden="true"></span>
        </div>
        <div>
            <div class="title title-l rv"><span class="ghost">{{ $page['about_ghost'] }}</span><h2 id="about-title">{{ $page['about_title'] }}</h2><span class="rule"></span></div>
            <p class="rv">{{ $page['about_text'] }}</p>
            <div class="mini">
                @foreach ($page['about_cards'] as $i => $card)
                    <div class="card rv" style="--d:{{ $i + 1 }}"><h3>{{ $card['title'] }}</h3><span class="rule"></span><p>{{ $card['text'] }}</p></div>
                @endforeach
            </div>
            <a class="btn rv" href="{{ route('events') }}">{{ $page['about_cta'] }}</a>
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="live-title">
    <div class="wrap">
        <div class="ticket rv">
            <span class="shape sh-tri" style="right:5%;bottom:8%" aria-hidden="true"></span>
            <p class="sale">{{ $page['ticket_label'] }}</p>
            <h2 id="live-title">{{ $page['ticket_title'] }}</h2>
            <p>{{ $page['ticket_text'] }}</p>
            @include('partials.countdown')
            <ul class="meta">
                <li>Day: <strong>{{ $page['ticket_day'] }}</strong></li>
                <li>Doors: <strong>{{ $page['ticket_doors'] }}</strong></li>
                <li>Typical spend: <strong>{{ config('hfh.price_range') }}</strong></li>
                <li>Location: <strong>{{ config('hfh.address') }}</strong></li>
            </ul>
            <a class="btn" href="{{ route('book') }}">{{ $page['ticket_cta'] }}</a>
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="services-title">
    <div class="wrap">
        <div class="title rv"><span class="ghost">{{ $page['services_ghost'] }}</span><h2 id="services-title">{{ $page['services_title'] }}</h2><span class="rule"></span><p>{{ $page['services_text'] }}</p></div>
        <div class="grid-3 features">
            @foreach (config('hfh.features') as $i => $feature)
                <article class="card service rv" style="--d:{{ $i % 3 }}">
                    <div class="ico">@include('partials.icon', ['name' => $feature['icon']])</div>
                    <div class="service-body">
                        <h3>{{ $feature['title'] }}</h3>
                        <p>{{ $feature['text'] }}</p>
                        <a class="service-link" href="{{ url($feature['link']) }}">{{ $feature['cta'] }} <span aria-hidden="true">&rarr;</span></a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" id="gallery" aria-labelledby="gallery-title">
    <div class="wrap">
        <div class="title rv"><span class="ghost">{{ $page['gallery_ghost'] }}</span><h2 id="gallery-title">{{ $page['gallery_title'] }}</h2><span class="rule"></span><p>{{ $page['gallery_text'] }}</p></div>
        <div class="tabs rv" role="group" aria-label="Filter gallery" data-tabs>
            <button type="button" aria-pressed="true" data-f="all">All</button>
            <button type="button" aria-pressed="false" data-f="Dancing">Dancing</button>
            <button type="button" aria-pressed="false" data-f="Drinks">Drinks</button>
            <button type="button" aria-pressed="false" data-f="Karaoke">Karaoke</button>
            <button type="button" aria-pressed="false" data-f="Food">Food</button>
            <button type="button" aria-pressed="false" data-f="Music">Music</button>
        </div>
        <div class="gallery" data-gallery>
            @foreach (config('hfh.gallery') as $g)
                @php [$w, $h] = explode('/', $g[2]); @endphp
                <figure class="shot" data-cat="{{ $g[0] }}" data-label="{{ $g[1] }}" style="--ar:{{ $g[2] }}"><img src="{{ asset('images/'.$g[3].'.webp') }}" width="{{ $w }}" height="{{ $h }}" loading="lazy" alt="{{ $g[4] }}"></figure>
            @endforeach
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="events-title">
    <div class="wrap">
        <div class="title rv"><span class="ghost">{{ $page['events_ghost'] }}</span><h2 id="events-title">{{ $page['events_title'] }}</h2><span class="rule"></span><p>{{ $page['events_text'] }}</p></div>
        @include('partials.event-cards', ['limit' => 2])
        <div class="t-center"><a class="btn btn-outline" href="{{ route('events') }}">{{ $page['events_cta'] }}</a></div>
    </div>
</section>

<section class="sec" style="padding-top:0" id="book" aria-labelledby="tables-title">
    <div class="wrap">
        <div class="title rv"><span class="ghost">{{ $page['booking_ghost'] }}</span><h2 id="tables-title">{{ $page['booking_title'] }}</h2><span class="rule"></span><p>{{ $page['booking_text'] }}</p></div>
        <div class="card home-form rv" style="max-width:900px;margin-inline:auto;padding:2.2rem">
            @include('partials.booking-form')
        </div>
        <a class="btn book-cta rv" href="{{ route('book') }}">{{ $page['booking_mobile_cta'] }}</a>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="sub-title">
    <div class="wrap">
        <div class="card subscribe rv">
            <div><h3 id="sub-title">{{ $page['callout_title'] }}</h3></div>
            <div><a class="btn" href="tel:{{ config('hfh.phone_href') }}">@include('partials.icon', ['name' => 'phone']) Call {{ config('hfh.phone') }}</a></div>
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" id="contact" aria-labelledby="contact-title">
    <div class="wrap">
        <div class="title rv"><span class="ghost">{{ $page['contact_ghost'] }}</span><h2 id="contact-title">{{ $page['contact_title'] }}</h2><span class="rule"></span></div>
        <div class="contact">
            <div class="card rv"><h3>{{ $page['contact_address_label'] }}</h3><span class="rule"></span><div class="info"><div>@include('partials.icon', ['name' => 'map-pin'])<p><a href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener">{{ config('hfh.address') }}</a></p></div></div></div>
            <div class="card rv" style="--d:1"><h3>{{ $page['contact_call_label'] }}</h3><span class="rule"></span><div class="info"><div>@include('partials.icon', ['name' => 'phone'])<p><a href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a></p></div></div></div>
            <div class="card rv" style="--d:2"><h3>{{ $page['contact_hours_label'] }}</h3><span class="rule"></span>
                <ul class="hours-list">@foreach (config('hfh.hours') as $h)<li @class(['on' => $h['live']])><strong>{{ $h['day'] }}</strong><span>{{ $h['time'] }}</span></li>@endforeach</ul>
            </div>
        </div>
        <a class="btn btn-outline map-open rv" href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener">@include('partials.icon', ['name' => 'map-pin']) Open in Google Maps</a>
        <div class="map rv" data-map="{{ config('hfh.maps_embed') }}">
            <button class="map-load" type="button" data-map-load>@include('partials.icon', ['name' => 'map-pin'])<span>Show the map</span><small>{{ config('hfh.address') }}</small></button>
            <noscript><iframe title="Map to {{ config('hfh.name') }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="{{ config('hfh.maps_embed') }}"></iframe></noscript>
        </div>
    </div>
</section>
@endsection
