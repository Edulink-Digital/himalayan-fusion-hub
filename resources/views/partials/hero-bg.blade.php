<div class="hero-bg" aria-hidden="true">
    <picture>
        <source media="(max-width: 800px)" srcset="{{ asset('images/hero-lasers-800.webp') }}" width="800" height="450">
        <img src="{{ asset('images/hero-lasers.webp') }}" width="1920" height="1080" alt="" @unless (request()->routeIs('home')) fetchpriority="high" @endunless>
    </picture>
    <div class="lights"><span></span><span></span><span></span></div>
</div>
