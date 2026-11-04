@php
    $socialLabels = ['facebook' => 'Facebook', 'instagram' => 'Instagram', 'tiktok' => 'TikTok'];
    $isActive = fn (array $item): bool => ! str_contains($item['url'], '#') && ($item['url'] === '/' ? request()->is('/') : request()->is(ltrim($item['url'], '/')));
@endphp
<header class="site-header" data-header>
    <div class="topbar">
        <div class="wrap topbar-row">
            <div class="topbar-contact">
                <a href="tel:{{ config('hfh.phone_href') }}">@include('partials.icon', ['name' => 'phone'])<span>{{ config('hfh.phone') }}</span></a>
                @if (config('hfh.email'))
                    <a href="mailto:{{ config('hfh.email') }}">@include('partials.icon', ['name' => 'envelope-simple'])<span>{{ config('hfh.email') }}</span></a>
                @endif
            </div>
            @if (array_filter(config('hfh.socials', [])))
                <div class="topbar-social">
                    <span>Follow us:</span>
                    @foreach (config('hfh.socials') as $network => $url)
                        @if ($url)
                            <a class="soc" href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ config('hfh.name') }} on {{ $socialLabels[$network] ?? ucfirst($network) }}">@include('partials.icon', ['name' => $network.'-logo'])</a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="wrap header-row">
        <a class="brand" href="{{ route('home') }}" aria-label="{{ config('hfh.name') }} home">
            <strong>HF<span class="mk">H</span><span class="eqmini" aria-hidden="true"><i></i><i></i><i></i></span></strong>
            <small>{{ config('hfh.name') }}</small>
        </a>
        <nav class="mainnav" aria-label="Primary">
            @foreach (config('hfh.nav') as $item)
                @continue($item['route'] === 'book')
                <a href="{{ url($item['url']) }}" @class(['is-active' => $isActive($item)]) @if ($isActive($item)) aria-current="page"@endif>{{ $item['label'] }}</a>
            @endforeach
        </nav>
        <form class="search" role="search" action="{{ route('search') }}" method="GET" data-search>
            <label class="sr-only" for="site-search">Search the site</label>
            <input type="search" id="site-search" name="q" value="{{ request()->routeIs('search') ? request('q') : '' }}" placeholder="Search nights, menu, FAQ" autocomplete="off" enterkeyhint="search">
            <button class="icon-btn search-toggle" type="button" aria-label="Open search" aria-expanded="false" aria-controls="site-search" data-search-toggle>@include('partials.icon', ['name' => 'magnifying-glass'])</button>
        </form>
        <a class="btn btn-sm head-book" href="{{ route('book') }}">Book now</a>
        <button class="burger" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="menu" data-burger><span></span><span></span><span></span></button>
    </div>
</header>
<div class="menu" id="menu" data-menu aria-label="Site menu">
    <div class="wrap menu-grid">
        <nav aria-label="Primary">
            @foreach (config('hfh.nav') as $i => $item)
                <a style="--i:{{ $i }}" href="{{ url($item['url']) }}" @class(['is-active' => $isActive($item)])>{{ $item['label'] }}</a>
            @endforeach
        </nav>
        <aside>
            <form class="menu-search" role="search" action="{{ route('search') }}" method="GET">
                <label class="menu-h" for="menu-search">Search</label>
                <div class="menu-search-row">
                    <input type="search" id="menu-search" name="q" placeholder="Nights, menu, FAQ" enterkeyhint="search">
                    <button class="icon-btn" type="submit" aria-label="Search">@include('partials.icon', ['name' => 'magnifying-glass'])</button>
                </div>
            </form>
            <div class="block"><p class="menu-h">Find us</p><address>@foreach (config('hfh.address_lines') as $l)<p>{{ $l }}</p>@endforeach</address></div>
            <div class="block"><p class="menu-h">Call</p><a href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a></div>
            @if (array_filter(config('hfh.socials', [])))
                <div class="block menu-social"><p class="menu-h">Follow us</p>
                    @foreach (config('hfh.socials') as $network => $url)
                        @if ($url)
                            <a class="soc" href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ $socialLabels[$network] ?? ucfirst($network) }}">@include('partials.icon', ['name' => $network.'-logo'])</a>
                        @endif
                    @endforeach
                </div>
            @endif
        </aside>
    </div>
</div>
