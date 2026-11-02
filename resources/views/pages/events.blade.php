@extends('layouts.app')
@section('title', 'Events & Nights | Himalayan Fusion Hub Perth')
@section('description', 'Fusion Fridays, karaoke lounge and private hire at Himalayan Fusion Hub, Balcatta WA.')

@section('content')
<section class="page-hero">
    @include('partials.stage')
    <div class="wrap">
        <h1 class="rv">Events & <span class="glow hl">nights</span></h1>
        <p class="rv" style="--d:1">From the Friday dance floor to private karaoke rooms. Pick a format and we will light it up.</p>
    </div>
</section>

<section class="sec" style="padding-top:2rem">
    <div class="wrap">
        <div class="bento">
            @foreach (config('hfh.nights') as $i => $n)
                <article class="tile t-{{ $n['tone'] }} rv" style="--d:{{ $i }}">
                    <span class="tag">{{ $n['tag'] }}</span>
                    <h3>{{ $n['title'] }}</h3>
                    <p class="when">{{ $n['when'] }}</p>
                    <p>{{ $n['blurb'] }}</p>
                    <a class="tile-link" href="{{ route('book') }}">Reserve <i class="ph-bold ph-arrow-right" aria-hidden="true"></i></a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="sec" style="padding-top:0" aria-labelledby="faq-title">
    <div class="wrap" style="max-width:860px">
        <div class="sec-head"><h2 id="faq-title" class="rv">Good to <span class="hl">know</span></h2></div>
        <div class="faq rv">
            @foreach (config('hfh.faq') as $f)
                <details>
                    <summary>{{ $f[0] }} <i class="ph-bold ph-plus" aria-hidden="true"></i></summary>
                    <p>{{ $f[1] }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>
@endsection
