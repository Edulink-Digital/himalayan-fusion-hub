@php $arts = [
    'radial-gradient(70% 60% at 30% 20%, #db5eff, transparent 70%), radial-gradient(60% 60% at 80% 90%, #1384cc, transparent 70%), #1a1040',
    'radial-gradient(70% 60% at 70% 20%, #ffd24a, transparent 65%), radial-gradient(60% 60% at 20% 90%, #ff5ea8, transparent 70%), #160f38',
    'radial-gradient(70% 60% at 50% 10%, #38e1ff, transparent 65%), radial-gradient(60% 60% at 80% 90%, #9f23c1, transparent 70%), #12113a',
]; @endphp
@foreach (array_slice(config('hfh.nights'), 0, $limit ?? 99) as $i => $n)
    <article class="card event rv" style="--d:{{ $i }}">
        <div class="poster" style="--art:{{ $arts[$i % 3] }}" role="img" aria-label="{{ $n['title'] }} (photo coming soon)"></div>
        <div>
            <h3>{{ $n['title'] }}</h3>
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
