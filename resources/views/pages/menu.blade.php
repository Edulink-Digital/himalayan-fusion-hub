@extends('layouts.app')
@php $page = config('hfh.menu_page'); @endphp
@section('title', $page['meta_title'])
@section('description', $page['meta_description'])
@section('content')
<section class="page-hero">
    @include('partials.hero-bg')
    <div class="wrap"><h1 class="rv">{{ $page['title'] }}</h1><p class="rv" style="--d:1">{{ $page['text'] }}</p>
        <div class="crumbs rv" style="--d:2"><a href="{{ route('home') }}">Home</a><b>/</b><span>Menu</span></div></div>
</section>
<section class="sec" style="padding-top:2rem"><div class="wrap">
    <div class="menu-grid">
        @foreach (config('hfh.menu') as $i => $g)
            <article class="card menu-card rv" style="--d:{{ $i }}"><h2>{{ $g['group'] }}</h2><p class="note">{{ $g['note'] }}</p>
                <ul class="dishes">@foreach ($g['items'] as $it)<li><strong>{{ $it['name'] }} @if ($it['house_pick'] ?? false)<span class="sig-badge">House pick</span>@endif</strong><span>{{ $it['description'] }}</span></li>@endforeach</ul></article>
        @endforeach
    </div>
    <div class="t-center" style="margin-top:2.5rem"><a class="btn" href="{{ route('book') }}">{{ $page['cta'] }}</a></div>
</div></section>
@endsection
