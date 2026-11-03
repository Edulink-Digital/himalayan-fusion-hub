@php $imgs = ['event-friday' => 'Crowd with hands up under bright stage lights', 'event-karaoke' => 'Microphone glowing in warm bokeh light', 'event-private' => 'Warm-lit cocktail bar with hanging bulbs']; $keys = array_keys($imgs); @endphp
@foreach (array_slice(config('hfh.nights'), 0, $limit ?? 99) as $i => $n)
    <article class="card event rv" style="--d:{{ $i }}">
        <div class="poster"><img src="{{ asset('images/'.$keys[$i % 3].'.webp') }}" width="800" height="600" loading="lazy" alt="{{ $imgs[$keys[$i % 3]] }}"></div>
        <div>
            <{{ $hl ?? 'h3' }}>{{ $n['title'] }}</{{ $hl ?? 'h3' }}>
            <p>{{ $n['blurb'] }}</p>
            <div class="ev-meta">
                <span>@include('partials.icon', ['name' => 'calendar-blank']){{ $n['when'] }}</span>
                <span>@include('partials.icon', ['name' => 'ticket']){{ config('hfh.price_range') }}</span>
                <span>@include('partials.icon', ['name' => 'map-pin'])Balcatta, Perth</span>
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
