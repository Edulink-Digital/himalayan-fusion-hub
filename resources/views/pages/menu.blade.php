@extends('layouts.app')
@section('title', 'Cocktails & Bites Menu | Himalayan Fusion Hub Perth')
@section('description', 'Signature Himalayan cocktails, classics and shareable momo and sekuwa at Himalayan Fusion Hub, Balcatta.')
@section('content')
<x-hero title="Pour, then<br>share" low="saffron">
    <x-slot:above>
        <nav class="jump rise" aria-label="Menu sections">
            @foreach (config('hfh.menu') as $group)
                <a href="#{{ Str::slug($group['group']) }}">{{ $group['group'] }}</a>
            @endforeach
        </nav>
    </x-slot:above>
    <p class="hero-when rise">Himalayan cocktails and bites</p>
    <p class="hero-line rise">Timur pepper, chai, rhododendron and saffron in the glass; momo and sekuwa on the table. Prices at the bar.</p>
</x-hero>

@foreach (config('hfh.menu') as $group)
    <section class="chapter menu-group field-{{ $group['field'] }}" id="{{ Str::slug($group['group']) }}" data-field="{{ $group['field'] }}" aria-labelledby="{{ Str::slug($group['group']) }}-title">
        <div class="grid">
            <div class="menu-head">
                <h2 class="rise" id="{{ Str::slug($group['group']) }}-title">{{ $group['group'] }}</h2>
                <p class="rise">{{ $group['note'] }}</p>
                <img class="menu-pic rise" src="{{ asset('images/'.$group['image'][0].'.webp') }}" width="700" height="560" loading="lazy" alt="{{ $group['image'][1] }}">
            </div>
            <ul class="dishes" role="list">
                @foreach ($group['items'] as [$dish, $what, $flag])
                    <li class="dish rise">
                        <strong>{{ $dish }}</strong>
                        <p>{{ $what }}@if ($flag === 'sig')<em>House pick</em>@endif</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endforeach

<section class="chapter field-paper menu-close" data-field="paper" aria-labelledby="menu-book-title">
    <div class="grid">
        <h2 class="rise" id="menu-book-title">Save the<br>table first</h2>
        <img class="menu-close-pic rise" src="{{ asset('images/gal-drink-2.webp') }}" width="800" height="650" loading="lazy" alt="Friends toasting with cocktails at a dim bar">
        <div class="menu-close-copy">
            <p class="rise">Groups get the booth, the bottle service and a host. Send a request and we call to confirm.</p>
            <a class="btn btn-big rise" href="{{ route('book') }}">Book a table</a>
        </div>
    </div>
</section>
@endsection
