@php $imgs = ['event-friday' => 'Crowd with hands up under bright stage lights', 'event-karaoke' => 'Microphone glowing in warm bokeh light', 'event-private' => 'Warm-lit cocktail bar with hanging bulbs']; $keys = array_keys($imgs); @endphp
@foreach (array_slice(config('hfh.nights'), 0, $limit ?? 99) as $i => $n)
    <article class="card event rv" style="--d:{{ $i }}">
        <div class="poster"><img src="{{ asset('images/'.$keys[$i % 3].'.webp') }}" width="800" height="600" loading="lazy" alt="{{ $imgs[$keys[$i % 3]] }}"></div>
        <div>
            <{{ $hl ?? 'h3' }}>{{ $n['title'] }}</{{ $hl ?? 'h3' }}>
            <p>{{ $n['blurb'] }}</p>
            <div class="ev-meta">
                <span><i class="ph-bold ph-calendar-blank" aria-hidden="true"></i>{{ $n['when'] }}</span>
                <span><i class="ph-bold ph-ticket" aria-hidden="true"></i>{{ config('hfh.price_range') }}</span>
                <span><i class="ph-bold ph-map-pin" aria-hidden="true"></i>Balcatta, Perth</span>
            </div>
            <a class="btn btn-sm" href="{{ route('book') }}?type={{ $n['book'] }}">Book now</a>
        </div>
        @if ($n['count'] ?? false)
            <div class="mini-count" data-countdown aria-label="Time until doors open">
                <div><b data-u="d">00</b><span>Days</span></div><div><b data-u="h">00</b><span>Hours</span></div>
                <div><b data-u="m">00</b><span>Mins</span></div><div><b data-u="s">00</b><span>Secs</span></div>
            </div>
        @else
            <div></div>
        @endif
    </article>
@endforeach
