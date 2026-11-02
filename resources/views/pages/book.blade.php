@extends('layouts.app')
@section('title', 'Book a Table or Private Hire | Himalayan Fusion Hub Perth')
@section('description', 'Reserve a table, VIP booth, birthday or karaoke room at Himalayan Fusion Hub in Balcatta, Perth.')
@section('content')
<section class="page-hero">
    @include('partials.hero-bg')
    <div class="wrap"><h1 class="rv">Book Your Table</h1><p class="rv" style="--d:1">Send a request and we will call to confirm. Prefer to talk now? Ring {{ config('hfh.phone') }}.</p>
        <div class="crumbs rv" style="--d:2"><a href="{{ route('home') }}">Home</a><b>/</b><span>Book</span></div></div>
</section>
<section class="sec" style="padding-top:2rem"><div class="wrap book-wrap">
    <div class="card rv" id="booking-form">@include('partials.booking-form')</div>
    <aside class="card rv" style="--d:1"><h2>Prefer to call?</h2><span class="rule"></span>
        <div class="info">
            <div><i class="ph-bold ph-phone" aria-hidden="true"></i><p><strong>Phone</strong><a href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a></p></div>
            <div><i class="ph-bold ph-map-pin" aria-hidden="true"></i><p><strong>Where</strong>{{ config('hfh.address') }}</p></div>
            <div><i class="ph-bold ph-ticket" aria-hidden="true"></i><p><strong>Typical spend</strong>{{ config('hfh.price_range') }}</p></div>
        </div>
    </aside>
</div></section>
@endsection
