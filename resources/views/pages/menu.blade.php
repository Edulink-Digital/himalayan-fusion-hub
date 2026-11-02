@extends('layouts.app')
@section('title', 'Cocktails & Bites Menu | Himalayan Fusion Hub Perth')
@section('description', 'Signature Himalayan cocktails, classics and shareable bites at Himalayan Fusion Hub, Balcatta.')

@section('content')
<section class="page-hero">
    @include('partials.stage')
    <div class="wrap">
        <h1 class="rv">The <span class="hl">menu</span></h1>
        <p class="rv" style="--d:1">Cocktails with Himalayan flavour and bites made for sharing. Prices at the bar.</p>
    </div>
</section>

<section class="sec" style="padding-top:2rem">
    <div class="wrap menu-grid">
        @foreach (config('hfh.menu') as $i => $g)
            <article class="panel menu-card rv" style="--d:{{ $i }}">
                <h2>{{ $g['group'] }}</h2>
                <p class="note">{{ $g['note'] }}</p>
                <ul class="dishes">
                    @foreach ($g['items'] as $it)
                        <li>
                            <strong>{{ $it[0] }} @if ($it[2] === 'sig')<span class="sig-badge">House pick</span>@endif</strong>
                            <span>{{ $it[1] }}</span>
                        </li>
                    @endforeach
                </ul>
            </article>
        @endforeach
    </div>
    <div class="wrap center-cta"><a class="btn btn-glow" href="{{ route('book') }}">Book a table</a></div>
</section>
@endsection
