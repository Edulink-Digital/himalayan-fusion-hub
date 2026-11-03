@extends('layouts.app')

@section('content')
<x-hero title="Fusion<br>Friday" low="crimson" class="hero-home">
    <x-slot:above>
        <p class="doors rise" data-countdown="{{ $doors->toIso8601String() }}">
            <span class="doors-label">Doors open in</span> <span class="doors-time" data-countdown-text>{{ $doors->format('l g:i a') }}</span>
        </p>
    </x-slot:above>
    <p class="hero-when rise">Fridays from 6:30 pm, Balcatta</p>
    <p class="hero-line rise">Bollywood, Nepali pop and house on the floor, Himalayan cocktails at the bar, a karaoke lounge out back.</p>
    <div class="hero-actions rise">
        <a class="btn btn-big" href="{{ route('book') }}">Book a table</a>
        <a class="link-arrow" href="#week">See the running order @include('partials.icon', ['name' => 'arrow'])</a>
    </div>
</x-hero>

<section class="chapter field-night week" id="week" data-field="night" aria-labelledby="week-title">
    <div class="grid week-head">
        <h2 class="rise" id="week-title">This week<br><span class="soft">at the Hub</span></h2>
        <a class="btn rise" href="{{ route('book') }}">Book a table</a>
    </div>
    <div class="grid week-body" data-tabs>
        <div class="days" role="tablist" aria-label="Day">
            @foreach ($week as $i => $day)
                <button class="day" type="button" role="tab" id="tab-{{ $day['key'] }}" aria-controls="panel-{{ $day['key'] }}" aria-selected="{{ $i === 0 ? 'true' : 'false' }}" @if ($i > 0) tabindex="-1" @endif>
                    <strong>{{ $day['tab'] }}</strong>
                    <span>{{ $day['date'] ?? 'By booking' }}</span>
                </button>
            @endforeach
        </div>
        <div class="panels">
            @foreach ($week as $i => $day)
                <div class="panel" role="tabpanel" id="panel-{{ $day['key'] }}" aria-labelledby="tab-{{ $day['key'] }}" data-panel>
                    <ol class="bands">
                        @foreach ($day['slots'] as [$time, $title, $note])
                            <li class="band rise">
                                <span class="band-time">{{ $time }}</span>
                                <span class="band-what"><strong>{{ $title }}</strong><span>{{ $note }}</span></span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="chapter field-jade fusion" data-field="jade" aria-labelledby="fusion-title">
    <div class="grid">
        <figure class="fusion-pic rise">
            <div class="drift"><img src="{{ asset('images/thamel-lights.jpg') }}" width="1280" height="960" loading="lazy" alt="A Thamel street in Kathmandu at night, strung with lights under red Devanagari neon"></div>
            <figcaption>Thamel, Kathmandu, after dark. Photo by Saddam Hussain Ansari, CC BY 4.0.</figcaption>
        </figure>
        <div class="fusion-copy">
            <h2 class="rise" id="fusion-title">From Thamel<br>to Balcatta</h2>
            <p class="rise">In Kathmandu, Thamel stays lit long after dark: neon in Devanagari, strings of bulbs across the lanes, dohori songs drifting down from upstairs bars.</p>
            <p class="rise">We brought that night to a unit on Erindale Rd. Nepali and Bollywood on the decks, momo from the kitchen, a karaoke lounge that knows every word, and doors at 6:30 every Friday, which is 4:15 in the afternoon back in Kathmandu.</p>
        </div>
    </div>
</section>

<section class="chapter field-saffron picks" data-field="saffron" aria-labelledby="picks-title" data-picks>
    <div class="grid">
        <div class="stage rise" aria-hidden="true">
            <span class="disc" data-disc data-tone="{{ config('hfh.picks.0.4') }}"></span>
            @foreach (config('hfh.picks') as $i => [$name, $fact, $img, $alt, $tone])
                <img class="pick-img" src="{{ asset('images/'.$img.'.webp') }}" width="700" height="875" loading="lazy" alt="" data-pick-img="{{ $i }}" @if ($i > 0) hidden @endif>
            @endforeach
        </div>
        <div class="pick-list">
            <h2 class="pick-head rise" id="picks-title">From the bar</h2>
            <ul class="pick-names" role="list">
                @foreach (config('hfh.picks') as $i => [$name, $fact, $img, $alt, $tone])
                    <li><button type="button" class="pick" aria-pressed="{{ $i === 0 ? 'true' : 'false' }}" data-pick="{{ $i }}" data-tone="{{ $tone }}" data-fact="{{ $fact }}">{{ $name }}</button></li>
                @endforeach
            </ul>
            <p class="pick-fact" aria-live="polite" data-pick-fact>{{ config('hfh.picks.0.1') }}</p>
            <a class="link-arrow" href="{{ route('menu') }}">The full menu @include('partials.icon', ['name' => 'arrow'])</a>
        </div>
    </div>
</section>

@include('partials.gallery')

@include('partials.faq')

<section class="chapter field-crimson contact" id="contact" data-field="crimson" aria-label="Find us">
    <a class="row-line" href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener"><span>Unit 2/98 Erindale Rd</span></a>
    <a class="row-line" href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener"><span>Balcatta WA 6021</span></a>
    <p class="row-line"><span>Fridays <span class="nowrap">from 6:30 pm</span></span></p>
    <a class="row-line" href="tel:{{ config('hfh.phone_href') }}"><span>{{ config('hfh.phone') }}</span></a>
    <a class="row-line row-go" href="{{ route('book') }}"><span>Book</span><span class="round">@include('partials.icon', ['name' => 'arrow'])</span></a>
</section>
@endsection
