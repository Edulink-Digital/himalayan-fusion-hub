@extends('layouts.app')
@section('title', ($query !== '' ? 'Search: '.$query : 'Search').' | '.config('hfh.name'))
@section('description', 'Search nights, the menu, venue features and answers at '.config('hfh.name').'.')
@section('content')
<section class="page-hero">
    @include('partials.hero-bg')
    <div class="wrap"><h1 class="rv">Search</h1>
        <form class="page-search rv" style="--d:1" role="search" action="{{ route('search') }}" method="GET">
            <label class="sr-only" for="page-search">Search the site</label>
            <input type="search" id="page-search" name="q" value="{{ $query }}" placeholder="Try karaoke, momo, Friday, parking" enterkeyhint="search">
            <button class="btn" type="submit">@include('partials.icon', ['name' => 'magnifying-glass']) Search</button>
        </form>
        <div class="crumbs rv" style="--d:2"><a href="{{ route('home') }}">Home</a><b>/</b><span>Search</span></div></div>
</section>
<section class="sec" style="padding-top:2rem"><div class="wrap search-results">
    @if ($query === '')
        <p class="search-note rv">Search the nights, menu, venue features and frequently asked questions.</p>
    @elseif ($results === [])
        <p class="search-note rv" role="status">Nothing matched <strong>&ldquo;{{ $query }}&rdquo;</strong>. Try a shorter word, or <a href="tel:{{ config('hfh.phone_href') }}">call {{ config('hfh.phone') }}</a> and ask the team.</p>
    @else
        <p class="search-note rv" role="status">{{ count($results) }} {{ Str::plural('result', count($results)) }} for <strong>&ldquo;{{ $query }}&rdquo;</strong></p>
        <ul class="result-list">
            @foreach ($results as $i => $result)
                <li class="card result rv" style="--d:{{ min($i, 4) }}">
                    <span class="result-kind">{{ $result['kind'] }}</span>
                    <h2><a href="{{ $result['url'] }}">{{ $result['title'] }}</a></h2>
                    <p>{{ Str::limit($result['text'], 180) }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div></section>
@endsection
