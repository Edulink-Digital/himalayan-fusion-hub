@extends('layouts.app')
@section('title', 'Nights & Events | Himalayan Fusion Hub Perth')
@section('description', 'Fusion Friday from 6:30 pm, the karaoke lounge and private hire at Himalayan Fusion Hub, Balcatta WA.')
@section('content')
<x-hero title="Three ways<br>to go out" low="blue">
    <x-slot:above>
        <p class="doors rise" data-countdown="{{ $doors->toIso8601String() }}">
            <span class="doors-label">Next Fusion Friday in</span> <span class="doors-time" data-countdown-text>{{ $doors->format('l g:i a') }}</span>
        </p>
    </x-slot:above>
    <p class="hero-when rise">Dance, sing or take the whole floor</p>
    <p class="hero-line rise">Every night here is one of three things. Pick yours and send a request; we call back to confirm.</p>
</x-hero>

@foreach (config('hfh.nights') as $i => $night)
    <section @class(['chapter', 'night', 'field-'.$night['field'], 'night-flip' => $i % 2 === 1]) id="{{ $night['slug'] }}" data-field="{{ $night['field'] }}" aria-labelledby="{{ $night['slug'] }}-title">
        <div class="grid">
            <figure class="night-pic rise"><div class="drift"><img src="{{ asset('images/'.$night['image'][0].'.webp') }}" width="800" height="600" loading="lazy" alt="{{ $night['image'][1] }}"></div></figure>
            <div class="night-copy">
                <h2 class="rise" id="{{ $night['slug'] }}-title">{{ $night['title'] }}</h2>
                <p class="night-when rise">{{ $night['when'] }}</p>
                <p class="rise">{{ $night['blurb'] }}</p>
                <p class="night-spend rise">Typical spend {{ config('hfh.price_range') }}</p>
                <a class="btn btn-big rise" href="{{ route('book', ['type' => $night['book']]) }}">Book {{ $night['title'] }}</a>
            </div>
        </div>
    </section>
@endforeach

@include('partials.gallery')

@include('partials.faq')
@endsection
