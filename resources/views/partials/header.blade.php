<header class="site-header" data-header>
    <div class="wrap header-row">
        <a class="brand" href="{{ route('home') }}" aria-label="{{ config('hfh.name') }} home">
            <span class="brand-mark" aria-hidden="true"><i class="ph-bold ph-mountains"></i></span>
            <span class="brand-text">Himalayan<b>Fusion</b>Hub</span>
        </a>
        <nav class="nav" id="nav" aria-label="Primary" data-nav>
            @foreach (config('hfh.nav') as $item)
                @if ($item['route'] !== 'book')
                    <a href="{{ route($item['route']) }}" @class(['is-active' => request()->routeIs($item['route'])]) @if(request()->routeIs($item['route'])) aria-current="page" @endif>{{ $item['label'] }}</a>
                @endif
            @endforeach
            <a class="btn btn-glow nav-cta" href="{{ route('book') }}">Book a table</a>
        </nav>
        <button class="burger" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="nav" data-burger>
            <span></span><span></span>
        </button>
    </div>
</header>
