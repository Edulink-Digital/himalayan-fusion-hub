@extends('layouts.app')

@section('content')
<section class="hero" aria-labelledby="hero-title">
    @include('partials.stage')
    <div class="wrap hero-grid">
        <div>
            <span class="eyebrow rv"><span class="eq" aria-hidden="true"><i></i><i></i><i></i><i></i></span> Balcatta, Perth</span>
            <h1 id="hero-title" class="rv" style="--d:1">Where the <span class="glow">Himalayas</span> meet the dance floor</h1>
            <p class="lead rv" style="--d:2">Great cocktails, karaoke and dancing under a sky of moving light.</p>
            <div class="cta-row rv" style="--d:3">
                <a class="btn btn-glow" href="{{ route('book') }}">Book a table <i class="ph-bold ph-arrow-right" aria-hidden="true"></i></a>
                <a class="btn btn-ghost" href="{{ route('events') }}">See the nights</a>
            </div>
        </div>
        <aside class="hero-card rv" style="--d:3" aria-label="Opening hours">
            <h2>Opening hours</h2>
            <ul class="hours">
                @foreach (config('hfh.hours') as $h)
                    <li @class(['on' => $h['live']])><strong>{{ $h['day'] }}</strong><span>{{ $h['time'] }}</span></li>
                @endforeach
            </ul>
            <a class="btn btn-ghost btn-sm" href="tel:{{ config('hfh.phone_href') }}"><i class="ph-bold ph-phone" aria-hidden="true"></i> {{ config('hfh.phone') }}</a>
        </aside>
    </div>
</section>

<div class="marquee" aria-hidden="true">
    <div class="marquee-track">
        @for ($i = 0; $i < 2; $i++)
            <span>Cocktails</span><span>Karaoke</span><span>Dancing</span><span>Himalayan Fusion</span><span>Private Hire</span><span>Late Nights</span>
        @endfor
    </div>
</div>

<section class="sec" aria-labelledby="about-title">
    <div class="wrap about">
        <div class="art rv" role="img" aria-label="Abstract stage lighting in magenta, gold and violet">
            <div class="disc"></div>
        </div>
        <div>
            <h2 id="about-title" class="rv">A night out with a <span class="hl">mountain</span> of character</h2>
            <p class="rv" style="--d:1">Himalayan Fusion Hub blends the energy of Kathmandu nights with the polish of a Perth club. Sharp drinks, a booming sound system and a crowd that came to have fun.</p>
            <p class="rv" style="--d:2">Dance with friends, grab a booth, or take the mic. Everyone gets a good night here.</p>
            <div class="pills rv" style="--d:3">
                <span class="pill"><i class="ph-bold ph-martini" aria-hidden="true"></i> Great cocktails</span>
                <span class="pill"><i class="ph-bold ph-microphone-stage" aria-hidden="true"></i> Karaoke</span>
                <span class="pill"><i class="ph-bold ph-disc" aria-hidden="true"></i> Dancing</span>
            </div>
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="nights-title">
    <div class="wrap">
        <div class="sec-head">
            <h2 id="nights-title" class="rv">Pick your <span class="hl">night</span></h2>
            <p class="rv" style="--d:1">Dancing, singing or a full takeover. Every format comes with the lights.</p>
        </div>
        <div class="bento">
            @foreach (config('hfh.nights') as $i => $n)
                <article class="tile t-{{ $n['tone'] }} rv" style="--d:{{ $i }}">
                    <span class="tag">{{ $n['tag'] }}</span>
                    <h3>{{ $n['title'] }}</h3>
                    <p class="when">{{ $n['when'] }}</p>
                    <p>{{ $n['blurb'] }}</p>
                    <a class="tile-link" href="{{ route('book') }}">Reserve <i class="ph-bold ph-arrow-right" aria-hidden="true"></i></a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="exp-title">
    <div class="wrap">
        <div class="sec-head">
            <h2 id="exp-title" class="rv">Three ways to <span class="hl">go out</span></h2>
        </div>
        <div class="exp">
            <div class="exp-row rv">
                <span class="exp-ico"><i class="ph-bold ph-martini" aria-hidden="true"></i></span>
                <h3>Cocktails</h3>
                <p>Himalayan spices, fresh citrus and heavy-handed pours. Order a signature or ask the bar for something off-menu.</p>
            </div>
            <div class="exp-row rv">
                <span class="exp-ico"><i class="ph-bold ph-microphone-stage" aria-hidden="true"></i></span>
                <h3>Karaoke</h3>
                <p>Bollywood, Nepali classics and chart hits. Bring the group, grab a mic and own the room.</p>
            </div>
            <div class="exp-row rv">
                <span class="exp-ico"><i class="ph-bold ph-disc" aria-hidden="true"></i></span>
                <h3>Dancing</h3>
                <p>A DJ who reads the floor, lasers that follow the beat and enough space to move.</p>
            </div>
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="drinks-title">
    <div class="wrap">
        <div class="sec-head">
            <h2 id="drinks-title" class="rv">Signature <span class="hl">pours</span></h2>
            <p class="rv" style="--d:1">Swipe through the house favourites.</p>
        </div>
        <div class="snap rv" tabindex="0" role="region" aria-label="Signature cocktails">
            @php $c = ['var(--magenta)', 'var(--gold)', 'var(--violet-2)', 'var(--magenta-2)']; @endphp
            @foreach (array_slice(config('hfh.menu')[0]['items'], 0, 4) as $k => $d)
                <article class="drink" style="--c: {{ $c[$k] }}">
                    <i class="ph-bold ph-martini" aria-hidden="true"></i>
                    <div>
                        <h3>{{ $d[0] }}</h3>
                        <p>{{ $d[1] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="center-cta"><a class="btn btn-ghost" href="{{ route('menu') }}">Full menu</a></div>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="visit-title">
    <div class="wrap visit">
        <div class="panel rv">
            <h2 id="visit-title">Find <span class="hl">us</span></h2>
            <div class="info">
                <div><i class="ph-bold ph-map-pin" aria-hidden="true"></i><p><strong>Address</strong><a href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener">{{ config('hfh.address') }}</a></p></div>
                <div><i class="ph-bold ph-phone" aria-hidden="true"></i><p><strong>Call</strong><a href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a></p></div>
                <div><i class="ph-bold ph-clock" aria-hidden="true"></i><p><strong>Friday</strong>Opens 6:30 pm</p></div>
                <div><i class="ph-bold ph-ticket" aria-hidden="true"></i><p><strong>Typical spend</strong>{{ config('hfh.price_range') }}</p></div>
            </div>
        </div>
        <div class="map rv" style="--d:1">
            <iframe title="Map to Himalayan Fusion Hub" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="{{ config('hfh.maps_embed') }}"></iframe>
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0">
    <div class="wrap">
        <div class="cta-band rv">
            <h2>Your table is <span class="hl">waiting</span></h2>
            <p>Tell us the date and the crew size. We confirm by phone.</p>
            <a class="btn btn-glow" href="{{ route('book') }}">Book a table <i class="ph-bold ph-arrow-right" aria-hidden="true"></i></a>
        </div>
    </div>
</section>
@endsection
