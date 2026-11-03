<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>@yield('title', 'Himalayan Fusion Hub | Night Club in Balcatta, Perth')</title>
    <meta name="description" content="@yield('description', 'Himalayan Fusion Hub is a Perth night club in Balcatta WA with Himalayan cocktails, karaoke and dancing. Fusion Friday from 6:30 pm. Book a table or private hire.')">
    <meta name="theme-color" content="#eceeee">
    <meta property="og:title" content="Himalayan Fusion Hub | Perth Night Club">
    <meta property="og:description" content="Fusion Friday from 6:30 pm. Cocktails, karaoke and dancing in Balcatta, Perth.">
    <meta property="og:type" content="website">
    <script>document.documentElement.classList.add('js')</script>
    <link rel="preconnect" href="https://api.fontshare.com">
    <link rel="preconnect" href="https://cdn.fontshare.com" crossorigin>
    <link href="https://api.fontshare.com/v2/css?f[]=roundo@400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org', '@type' => 'NightClub', 'name' => config('hfh.name'),
        'telephone' => config('hfh.phone_href'), 'priceRange' => '$$',
        'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Unit 2/98 Erindale Rd', 'addressLocality' => 'Balcatta', 'addressRegion' => 'WA', 'postalCode' => '6021', 'addressCountry' => 'AU'],
        'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => 'Friday', 'opens' => '18:30']],
    ], JSON_UNESCAPED_SLASHES) !!}
    </script>
</head>
<body @class(['page-'.(request()->route()?->getName() ?? 'page')])>
<a class="skip" href="#main">Skip to content</a>
@include('partials.header')
<main id="main">@yield('content')</main>
@include('partials.footer')
@unless (request()->routeIs('book'))
    <nav class="dock" aria-label="Quick actions">
        <a class="dock-book" href="{{ route('book') }}">Book a table</a>
        <a class="dock-icon" href="tel:{{ config('hfh.phone_href') }}" aria-label="Call {{ config('hfh.phone') }}">@include('partials.icon', ['name' => 'phone'])</a>
        <a class="dock-icon" href="{{ config('hfh.maps_link') }}" target="_blank" rel="noopener" aria-label="Directions in Google Maps">@include('partials.icon', ['name' => 'pin'])</a>
    </nav>
@endunless
</body>
</html>
