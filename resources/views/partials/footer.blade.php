@php
    $perth = now(config('hfh.timezone'));
    $ktm = now('Asia/Kathmandu');
@endphp
<footer class="foot" data-field="night">
    <div class="tiles">
        <a class="tile tile-mark" href="{{ route('home') }}" aria-label="{{ config('hfh.name') }} home"><span aria-hidden="true">HFH</span></a>
        <a class="tile tile-go" href="{{ route('book') }}">
            <span>Book your table</span>
            @include('partials.icon', ['name' => 'arrow'])
        </a>
        <nav class="tile tile-nav" aria-label="Footer">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('events') }}">Nights</a>
            <a href="{{ route('menu') }}">Menu</a>
            <a href="{{ route('book') }}">Book</a>
        </nav>
        <div class="tile tile-call">
            <a class="big-link" href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a>
            <a href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener">{{ config('hfh.address') }}</a>
        </div>
        <div class="tile tile-time" data-clock>
            <p>Balcatta <strong data-clock-tz="{{ config('hfh.timezone') }}">{{ $perth->format('g:i a') }}</strong></p>
            <p>Kathmandu <strong data-clock-tz="Asia/Kathmandu">{{ $ktm->format('g:i a') }}</strong></p>
        </div>
        <div class="tile tile-say">
            <p class="say">Kathmandu nights at a Balcatta address.</p>
            <p class="legal">&copy; {{ date('Y') }} {{ config('hfh.name') }}. 18+ only, photo ID required. Please drink responsibly.
                Club photos via <a href="https://unsplash.com" target="_blank" rel="noopener">Unsplash</a>.
                Thamel photo by Saddam Hussain Ansari, CC BY 4.0, via Wikimedia Commons
                (@foreach (config('hfh.credits') as $i => [$credit, $url])<a href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ $credit }}">source</a>@endforeach).
            </p>
        </div>
    </div>
</footer>
