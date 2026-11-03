<header class="bar" data-bar>
    <a class="wordmark" href="{{ route('home') }}" aria-label="{{ config('hfh.name') }} home"><span class="wm-long">Himalayan Fusion Hub</span><span class="wm-short" aria-hidden="true">HFH</span></a>
    <nav class="bar-links" aria-label="Primary">
        @foreach (config('hfh.nav') as $item)
            <a href="{{ url($item['url']) }}" @if (! str_contains($item['url'], '#') && request()->is(ltrim($item['url'], '/'))) aria-current="page" @endif>{{ $item['label'] }}</a>
        @endforeach
    </nav>
    <a class="btn bar-book" href="{{ route('book') }}">Book</a>
    <button class="bar-menu" type="button" aria-expanded="false" aria-controls="sheet" data-menu-open>Menu</button>
</header>
<div class="sheet" id="sheet" role="dialog" aria-modal="true" aria-label="Site menu" hidden data-sheet>
    <div class="sheet-top">
        <a class="wordmark" href="{{ route('home') }}">HFH</a>
        <button class="sheet-close" type="button" aria-label="Close menu" data-menu-close>@include('partials.icon', ['name' => 'close'])</button>
    </div>
    <nav class="sheet-links" aria-label="Site">
        <a href="{{ route('home') }}">Home</a>
        @foreach (config('hfh.nav') as $item)
            <a href="{{ url($item['url']) }}">{{ $item['label'] }}</a>
        @endforeach
        <a href="{{ route('book') }}">Book a table</a>
    </nav>
    <div class="sheet-foot">
        <a href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a>
        <a href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener">{{ config('hfh.address') }}</a>
        <p>Fridays from 6:30 pm. 18+ with photo ID.</p>
    </div>
</div>
