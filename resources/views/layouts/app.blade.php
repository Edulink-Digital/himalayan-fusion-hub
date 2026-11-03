<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>@yield('title', 'Himalayan Fusion Hub | Night Club in Balcatta, Perth')</title>
    <meta name="description" content="@yield('description', 'Himalayan Fusion Hub is a Perth night club in Balcatta WA with great cocktails, karaoke and dancing. Book a table or private hire today.')">
    <meta name="theme-color" content="#0a0820">
    <meta property="og:title" content="Himalayan Fusion Hub | Perth Night Club">
    <meta property="og:description" content="Cocktails, karaoke and dancing in Balcatta, Perth.">
    <meta property="og:type" content="website">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Volkhov&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/hfh.css') }}?v={{ filemtime(public_path('css/hfh.css')) }}">
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org', '@type' => 'NightClub', 'name' => config('hfh.name'),
        'telephone' => config('hfh.phone_href'), 'priceRange' => '$$',
        'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Unit 2/98 Erindale Rd', 'addressLocality' => 'Balcatta', 'addressRegion' => 'WA', 'postalCode' => '6021', 'addressCountry' => 'AU'],
    ], JSON_UNESCAPED_SLASHES) !!}
    </script>
</head>
<body @class(['no-dock' => request()->routeIs('book')])>
<a class="skip" href="#main">Skip to content</a>
@include('partials.header')
<main id="main">@yield('content')</main>
@include('partials.footer')
@unless (request()->routeIs('book'))
    <nav class="dock" aria-label="Quick actions">
        <a class="btn dock-book" href="{{ route('book') }}">Book a table</a>
        <a class="dock-ico" href="tel:{{ config('hfh.phone_href') }}" aria-label="Call {{ config('hfh.phone') }}">@include('partials.icon', ['name' => 'phone'])</a>
        <a class="dock-ico" href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener" aria-label="Directions in Google Maps">@include('partials.icon', ['name' => 'map-pin'])</a>
    </nav>
@endunless
<script src="{{ asset('js/hfh.js') }}?v={{ filemtime(public_path('js/hfh.js')) }}" defer></script>
</body>
</html>
