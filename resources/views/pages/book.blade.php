@extends('layouts.app')
@php $page = config('hfh.book_page'); @endphp
@section('title', $page['meta_title'])
@section('description', $page['meta_description'])
@section('content')
<section class="page-hero">
    @include('partials.hero-bg')
    <div class="wrap"><h1 class="rv">{{ $page['title'] }}</h1><p class="rv" style="--d:1">{{ $page['text'] }} Prefer to talk now? Ring {{ config('hfh.phone') }}.</p>
        <div class="crumbs rv" style="--d:2"><a href="{{ route('home') }}">Home</a><b>/</b><span>Book</span></div></div>
</section>
<section class="sec" style="padding-top:2rem"><div class="wrap book-wrap">
    <div class="card rv" id="booking-form">@include('partials.booking-form')</div>
    <aside class="card rv" style="--d:1"><h2>{{ $page['side_title'] }}</h2><span class="rule"></span>
        <div class="info">
            <div>@include('partials.icon', ['name' => 'phone'])<p><strong>Phone</strong><a href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a></p></div>
            <div>@include('partials.icon', ['name' => 'map-pin'])<p><strong>Where</strong>{{ config('hfh.address') }}</p></div>
            <div>@include('partials.icon', ['name' => 'ticket'])<p><strong>Typical spend</strong>{{ config('hfh.price_range') }}</p></div>
        </div>
    </aside>
</div></section>
@endsection
