<footer class="site-footer">
    <div class="wrap">
        <div class="foot-top">
            <div>
                <a class="brand" href="{{ route('home') }}">
                    <span class="brand-mark" aria-hidden="true"><i class="ph-bold ph-mountains"></i></span>
                    <span class="brand-text">Himalayan<b>Fusion</b>Hub</span>
                </a>
                <p class="foot-tag">{{ config('hfh.tagline') }}</p>
            </div>
            <div class="foot-cols">
                <div>
                    <h3>Visit</h3>
                    <address>
                        @foreach (config('hfh.address_lines') as $line){{ $line }}<br>@endforeach
                    </address>
                    <a href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener">Get directions</a>
                </div>
                <div>
                    <h3>Call</h3>
                    <a class="foot-phone" href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a>
                    <p class="muted">{{ config('hfh.price_range') }}</p>
                </div>
                <div>
                    <h3>Explore</h3>
                    @foreach (config('hfh.nav') as $item)
                        <a href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="foot-bottom">
            <span>&copy; {{ date('Y') }} {{ config('hfh.name') }}. Please drink responsibly. 18+ only, ID required.</span>
        </div>
    </div>
</footer>
