@extends('layouts.app')
@section('title', 'Cocktails & Bites Menu | Himalayan Fusion Hub Perth')
@section('description', 'Signature Himalayan cocktails, classics and shareable bites at Himalayan Fusion Hub, Balcatta.')
@section('content')
<section class="page-hero">
    @include('partials.hero-bg')
    <div class="wrap"><h1 class="rv">Our Menu</h1><p class="rv" style="--d:1">Cocktails with Himalayan flavour and bites made for sharing. Prices at the bar.</p>
        <div class="crumbs rv" style="--d:2"><a href="{{ route('home') }}">Home</a><b>/</b><span>Menu</span></div></div>
</section>
<section class="sec" style="padding-top:2rem"><div class="wrap">
    <div class="menu-grid">
        @foreach (config('hfh.menu') as $i => $g)
            <article class="card menu-card rv" style="--d:{{ $i }}"><h2>{{ $g['group'] }}</h2><p class="note">{{ $g['note'] }}</p>
                <ul class="dishes">@foreach ($g['items'] as $it)<li><strong>{{ $it[0] }} @if ($it[2] === 'sig')<span class="sig-badge">House pick</span>@endif</strong><span>{{ $it[1] }}</span></li>@endforeach</ul></article>
        @endforeach
    </div>
    <div class="t-center" style="margin-top:2.5rem"><a class="btn" href="{{ route('book') }}">Book a table</a></div>
</div></section>
@endsection
