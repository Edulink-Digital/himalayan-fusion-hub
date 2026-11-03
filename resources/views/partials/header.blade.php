<header class="site-header" data-header>
    <div class="wrap header-row">
        <a class="brand" href="{{ route('home') }}" aria-label="{{ config('hfh.name') }} home">
            <strong>HF<span class="mk">H</span><span class="eqmini" aria-hidden="true"><i></i><i></i><i></i></span></strong>
            <small>Himalayan Fusion Hub</small>
        </a>
        <a class="head-phone" href="tel:{{ config('hfh.phone_href') }}">@include('partials.icon', ['name' => 'phone'])<span>{{ config('hfh.phone') }}</span></a>
        <a class="btn btn-sm" href="{{ route('book') }}">Book now</a>
        <button class="burger" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="menu" data-burger><span></span><span></span><span></span></button>
    </div>
</header>
<div class="menu" id="menu" data-menu aria-label="Site menu">
    <div class="wrap menu-grid">
        <nav aria-label="Primary">
            @foreach (config('hfh.nav') as $i => $item)
                <a style="--i:{{ $i }}" href="{{ url($item['url']) }}" @class(['is-active' => $item['url'] !== '/' && request()->is(ltrim($item['url'], '/')) || ($item['url'] === '/' && request()->is('/'))])>{{ $item['label'] }}</a>
            @endforeach
        </nav>
        <aside>
            <div class="block"><p class="menu-h">Find us</p><address>@foreach (config('hfh.address_lines') as $l)<p>{{ $l }}</p>@endforeach</address></div>
            <div class="block"><p class="menu-h">Call</p><a href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a></div>
            <div class="block"><p class="menu-h">Friday</p><p>Doors open 6:30 pm</p></div>
        </aside>
    </div>
</div>
