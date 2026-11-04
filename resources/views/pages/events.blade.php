@extends('layouts.app')
@php $page = config('hfh.events_page'); @endphp
@section('title', $page['meta_title'])
@section('description', $page['meta_description'])
@section('content')
<section class="page-hero">
    @include('partials.hero-bg')
    <div class="wrap"><h1 class="rv">{{ $page['title'] }}</h1><p class="rv" style="--d:1">{{ $page['text'] }}</p>
        <div class="crumbs rv" style="--d:2"><a href="{{ route('home') }}">Home</a><b>/</b><span>Events</span></div></div>
</section>
<section class="sec" style="padding-top:2rem"><div class="wrap">@include('partials.event-cards', ['hl' => 'h2'])</div></section>
<section class="sec" style="padding-top:0" aria-labelledby="faq-title"><div class="wrap">
    <div class="title rv"><span class="ghost">{{ $page['faq_ghost'] }}</span><h2 id="faq-title">{{ $page['faq_title'] }}</h2><span class="rule"></span></div>
    <div class="faq rv">@foreach (config('hfh.faq') as $f)<details><summary>{{ $f['question'] }} @include('partials.icon', ['name' => 'plus'])</summary><p>{{ $f['answer'] }}</p></details>@endforeach</div>
</div></section>
@endsection
