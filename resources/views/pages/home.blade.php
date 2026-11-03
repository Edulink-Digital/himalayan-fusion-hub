@extends('layouts.app')

@section('content')
<section class="hero" aria-labelledby="hero-title">
    @include('partials.hero-bg')
    <span class="shape sh-tri" style="left:6%;top:24%" aria-hidden="true"></span>
    <span class="shape sh-line" style="right:34%;top:30%" aria-hidden="true"></span>
    <div class="wrap hero-grid">
        <div>
            <p class="kicker rv">Unleashing the power of the night</p>
            <h1 id="hero-title" class="rv" style="--d:1">Discover The Best Night Out In Perth</h1>
            <p class="lead rv" style="--d:2">Join us for great cocktails, karaoke and dancing. The beats are loud, the vibes are high and the night is unforgettable.</p>
            <div class="cta-row rv" style="--d:3">
                <a class="btn" href="{{ route('book') }}">Book a table</a>
                <a class="btn btn-outline" href="{{ route('book') }}?type=vip">Book VIP</a>
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
            <div class="title title-l rv"><span class="ghost">About us</span><h2 id="about-title">We are The Best in The Field</h2><span class="rule"></span></div>
            <p class="rv">Himalayan Fusion Hub blends the energy of Kathmandu nights with the polish of a Perth club. Whether you are here to dance with friends, take the mic or simply lose yourself in the rhythm, the night is built to deliver.</p>
            <div class="mini">
                <div class="card rv" style="--d:1"><h3>VIP Service</h3><span class="rule"></span><p>Private booths, bottle service and a host for your group.</p></div>
                <div class="card rv" style="--d:2"><h3>Karaoke Rooms</h3><span class="rule"></span><p>Hindi, Nepali and English songbooks with a full sound system.</p></div>
            </div>
            <a class="btn rv" href="{{ route('events') }}">Read more</a>
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="live-title">
    <div class="wrap">
        <div class="ticket rv">
            <span class="shape sh-tri" style="right:5%;bottom:8%" aria-hidden="true"></span>
            <p class="sale">Doors open soon</p>
            <h2 id="live-title">Where the party never ends</h2>
            <p>Fusion Friday is the weekly main event. Dancing, cocktails and a DJ who reads the room.</p>
            @include('partials.countdown')
            <ul class="meta">
                <li>Day: <strong>Every Friday</strong></li>
                <li>Doors: <strong>6:30 pm</strong></li>
                <li>Typical spend: <strong>{{ config('hfh.price_range') }}</strong></li>
                <li>Location: <strong>{{ config('hfh.address') }}</strong></li>
            </ul>
            <a class="btn" href="{{ route('book') }}">Book table</a>
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="services-title">
    <div class="wrap">
        <div class="title rv"><span class="ghost">Services</span><h2 id="services-title">What We Provide</h2><span class="rule"></span><p>Three reasons to make Himalayan Fusion Hub your night out.</p></div>
        <div class="grid-3">
            <article class="card service rv"><div class="ico">@include('partials.icon', ['name' => 'martini'])</div><h3>Cocktails</h3><p>Masterfully crafted cocktails with Himalayan spice, fresh citrus and heavy-handed pours, served at our stylish bar.</p></article>
            <article class="card service rv" style="--d:1"><div class="ico">@include('partials.icon', ['name' => 'microphone-stage'])</div><h3>Karaoke</h3><p>Bollywood, Nepali classics and chart hits. Bring the group, grab a mic and own the room.</p></article>
            <article class="card service rv" style="--d:2"><div class="ico">@include('partials.icon', ['name' => 'disc'])</div><h3>Dancing</h3><p>A DJ who reads the floor, lights that follow the beat and enough space to move all night.</p></article>
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" id="gallery" aria-labelledby="gallery-title">
    <div class="wrap">
        <div class="title rv"><span class="ghost">Photos</span><h2 id="gallery-title">Our Gallery</h2><span class="rule"></span><p>Discover the magic of music, one photo at a time.</p></div>
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
        <div class="title rv"><span class="ghost">Events</span><h2 id="events-title">Upcoming Events</h2><span class="rule"></span><p>Celebrate the rhythm, energy and passion, all in one unforgettable night.</p></div>
        @include('partials.event-cards', ['limit' => 2])
        <div class="t-center"><a class="btn btn-outline" href="{{ route('events') }}">View all</a></div>
    </div>
</section>

<section class="sec" style="padding-top:0" id="book" aria-labelledby="tables-title">
    <div class="wrap">
        <div class="title rv"><span class="ghost">Tables</span><h2 id="tables-title">Book Your Table</h2><span class="rule"></span><p>Spend less time waiting and more time on the dance floor.</p></div>
        <div class="card home-form rv" style="max-width:900px;margin-inline:auto;padding:2.2rem">
            @include('partials.booking-form')
        </div>
        <a class="btn book-cta rv" href="{{ route('book') }}">Open the booking form</a>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="sub-title">
    <div class="wrap">
        <div class="card subscribe rv">
            <div><h3 id="sub-title">Questions about tonight? Talk to the team</h3></div>
            <div><a class="btn" href="tel:{{ config('hfh.phone_href') }}">@include('partials.icon', ['name' => 'phone']) Call {{ config('hfh.phone') }}</a></div>
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" id="contact" aria-labelledby="contact-title">
    <div class="wrap">
        <div class="title rv"><span class="ghost">Contact</span><h2 id="contact-title">Get In Touch</h2><span class="rule"></span></div>
        <div class="contact">
            <div class="card rv"><h3>Address</h3><span class="rule"></span><div class="info"><div>@include('partials.icon', ['name' => 'map-pin'])<p><a href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener">{{ config('hfh.address') }}</a></p></div></div></div>
            <div class="card rv" style="--d:1"><h3>Call Us</h3><span class="rule"></span><div class="info"><div>@include('partials.icon', ['name' => 'phone'])<p><a href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a></p></div></div></div>
            <div class="card rv" style="--d:2"><h3>Opening Hours</h3><span class="rule"></span>
                <ul class="hours-list">@foreach (config('hfh.hours') as $h)<li @class(['on' => $h['live']])><strong>{{ $h['day'] }}</strong><span>{{ $h['time'] }}</span></li>@endforeach</ul>
            </div>
        </div>
        <a class="btn btn-outline map-open rv" href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener">@include('partials.icon', ['name' => 'map-pin']) Open in Google Maps</a>
        <div class="map rv" data-map="{{ config('hfh.maps_embed') }}">
            <button class="map-load" type="button" data-map-load>@include('partials.icon', ['name' => 'map-pin'])<span>Show the map</span><small>{{ config('hfh.address') }}</small></button>
            <noscript><iframe title="Map to Himalayan Fusion Hub" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="{{ config('hfh.maps_embed') }}"></iframe></noscript>
        </div>
    </div>
</section>
@endsection
