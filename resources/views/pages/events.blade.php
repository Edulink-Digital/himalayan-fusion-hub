@extends('layouts.app')
@section('title', 'Events & Nights | Himalayan Fusion Hub Perth')
@section('description', 'Fusion Fridays, karaoke lounge and private hire at Himalayan Fusion Hub, Balcatta WA.')
@section('content')
<section class="page-hero">
    @include('partials.hero-bg')
    <div class="wrap"><h1 class="rv">Upcoming Events</h1><p class="rv" style="--d:1">From the Friday dance floor to private karaoke rooms.</p>
        <div class="crumbs rv" style="--d:2"><a href="{{ route('home') }}">Home</a><b>/</b><span>Events</span></div></div>
</section>
<section class="sec" style="padding-top:2rem"><div class="wrap">@include('partials.event-cards', ['hl' => 'h2'])</div></section>
<section class="sec" style="padding-top:0" aria-labelledby="faq-title"><div class="wrap">
    <div class="title rv"><span class="ghost">FAQ</span><h2 id="faq-title">Good to Know</h2><span class="rule"></span></div>
    <div class="faq rv">@foreach (config('hfh.faq') as $f)<details><summary>{{ $f[0] }} @include('partials.icon', ['name' => 'plus'])</summary><p>{{ $f[1] }}</p></details>@endforeach</div>
</div></section>
@endsection
