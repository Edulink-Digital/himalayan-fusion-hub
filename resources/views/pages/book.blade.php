@extends('layouts.app')
@section('title', 'Book a Table or Private Hire | Himalayan Fusion Hub Perth')
@section('description', 'Reserve a table, VIP booth, birthday or karaoke lounge at Himalayan Fusion Hub in Balcatta, Perth.')
@section('content')
<x-hero title="Book a<br>table" low="jade" class="hero-short">
    <p class="hero-when rise">Two minutes, then we call you</p>
    <p class="hero-line rise">A request, not a payment. We ring within the day to confirm. In a hurry? <a class="inline" href="tel:{{ config('hfh.phone_href') }}">Call {{ config('hfh.phone') }}</a>.</p>
</x-hero>

<section class="chapter field-paper booking" id="booking-form" data-field="paper" aria-label="Booking request">
    <div class="grid">
        <div class="booking-form">@include('partials.booking-form')</div>
        <aside class="booking-side">
            <div class="side-tile rise">
                <h2>Rather talk?</h2>
                <a class="big-link" href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a>
            </div>
            <div class="side-tile rise">
                <h2>Where</h2>
                <a href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener">{{ config('hfh.address') }}</a>
            </div>
            <div class="side-tile rise">
                <h2>Typical spend</h2>
                <p>{{ config('hfh.price_range') }}</p>
            </div>
        </aside>
    </div>
</section>
@endsection
