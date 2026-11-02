<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Himalayan Fusion Hub | Night Club in Balcatta, Perth')</title>
    <meta name="description" content="@yield('description', 'Himalayan Fusion Hub is a Perth night club in Balcatta WA with great cocktails, karaoke and dancing. Book a table or private hire today.')">
    <meta name="theme-color" content="#07060e">
    <meta property="og:title" content="Himalayan Fusion Hub | Perth Night Club">
    <meta property="og:description" content="Cocktails, karaoke and dancing in Balcatta, Perth.">
    <meta property="og:type" content="website">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&family=Unbounded:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/bold/style.css">
    <link rel="stylesheet" href="{{ asset('css/hfh.css') }}?v={{ filemtime(public_path('css/hfh.css')) }}">
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'NightClub',
        'name' => config('hfh.name'),
        'telephone' => config('hfh.phone_href'),
        'priceRange' => '$$',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Unit 2/98 Erindale Rd',
            'addressLocality' => 'Balcatta',
            'addressRegion' => 'WA',
            'postalCode' => '6021',
            'addressCountry' => 'AU',
        ],
    ], JSON_UNESCAPED_SLASHES) !!}
    </script>
</head>
<body class="@yield('body-class')">
<a class="skip" href="#main">Skip to content</a>
<div class="grain" aria-hidden="true"></div>

@include('partials.header')

<main id="main">
    @yield('content')
</main>

@include('partials.footer')

<script src="{{ asset('js/hfh.js') }}?v={{ filemtime(public_path('js/hfh.js')) }}" defer></script>
</body>
</html>
