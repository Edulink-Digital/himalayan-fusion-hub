<?php

/*
 * Single source of truth for venue facts and page content.
 * Items marked CONFIRM are placeholders the owner should verify before launch.
 */
return [
    'name' => 'Himalayan Fusion Hub',
    'short' => 'HFH',
    'tagline' => 'Perth\'s after-dark home for cocktails, karaoke and dancing.',
    'address' => 'Unit 2/98 Erindale Rd, Balcatta WA 6021',
    'address_lines' => ['Unit 2/98 Erindale Rd', 'Balcatta WA 6021'],
    'phone' => '0493 964 334',
    'phone_href' => '+61493964334',
    'maps_embed' => 'https://www.google.com/maps?q=Unit+2%2F98+Erindale+Rd%2C+Balcatta+WA+6021&output=embed',
    'maps_link' => 'https://www.google.com/maps/search/?api=1&query=Himalayan+Fusion+Hub+98+Erindale+Rd+Balcatta+WA',
    'price_range' => '$20 - $100 per person',

    // CONFIRM: only Friday opening (6:30 pm) is confirmed from the Google listing.
    'hours' => [
        ['day' => 'Friday', 'time' => 'Opens 6:30 pm', 'live' => true],
        ['day' => 'Saturday', 'time' => 'Ask us for tonight\'s hours', 'live' => false],
        ['day' => 'Sun - Thu', 'time' => 'Private hire & special events', 'live' => false],
    ],

    'nav' => [
        ['label' => 'Home', 'route' => 'home', 'url' => '/'],
        ['label' => 'About', 'route' => 'home', 'url' => '/#about'],
        ['label' => 'Events', 'route' => 'events', 'url' => '/events'],
        ['label' => 'Menu', 'route' => 'menu', 'url' => '/menu'],
        ['label' => 'Gallery', 'route' => 'home', 'url' => '/#gallery'],
        ['label' => 'Book a Table', 'route' => 'book', 'url' => '/book'],
        ['label' => 'Contact', 'route' => 'home', 'url' => '/#contact'],
    ],

    // Gallery tiles are light-art placeholders. Swap for real photos (resources/views/pages/home.blade.php).
    'gallery' => [
        ['Dancing', 'Dance floor', '1', 'radial-gradient(70% 60% at 30% 20%, #db5eff, transparent 70%), radial-gradient(60% 60% at 80% 90%, #1384cc, transparent 70%), #1a1040'],
        ['Drinks', 'Signature pours', '1.25', 'radial-gradient(70% 60% at 70% 20%, #ffd24a, transparent 65%), radial-gradient(60% 60% at 20% 90%, #ff5ea8, transparent 70%), #160f38'],
        ['Karaoke', 'Karaoke lounge', '.8', 'radial-gradient(70% 60% at 50% 10%, #38e1ff, transparent 65%), radial-gradient(60% 60% at 80% 90%, #9f23c1, transparent 70%), #12113a'],
        ['Music', 'DJ booth', '1.1', 'radial-gradient(70% 70% at 20% 30%, #9f23c1, transparent 65%), radial-gradient(60% 60% at 90% 80%, #3a53d8, transparent 70%), #0f0c2c'],
        ['Food', 'Momo & bites', '.9', 'radial-gradient(70% 60% at 60% 20%, #ff8a4a, transparent 65%), radial-gradient(60% 60% at 10% 90%, #9f23c1, transparent 70%), #1a1040'],
        ['Dancing', 'Lights on', '1.2', 'radial-gradient(70% 60% at 40% 20%, #3a53d8, transparent 65%), radial-gradient(60% 60% at 90% 90%, #db5eff, transparent 70%), #130f35'],
    ],

    'booking_types' => [
        'table' => 'Table for the night',
        'vip' => 'VIP booth & bottle service',
        'birthday' => 'Birthday or celebration',
        'private' => 'Private hire / function',
        'karaoke' => 'Karaoke group',
    ],

    // CONFIRM: nights are indicative formats, not a published calendar.
    'nights' => [
        [
            'slug' => 'fusion-friday',
            'title' => 'Fusion Friday',
            'when' => 'Fridays from 6:30 pm',
            'blurb' => 'Bollywood, Nepali pop, Afrobeats and house, blended by the DJ until late. Dress sharp, dance harder.',
            'tone' => 'magenta',
            'tag' => 'Dancing',
            'book' => 'table',
            'count' => true,
        ],
        [
            'slug' => 'karaoke-nights',
            'title' => 'Karaoke Lounge',
            'when' => 'Book a private room or take the stage',
            'blurb' => 'Hindi, Nepali and English songbooks, a proper sound system and a crowd that cheers every note.',
            'tone' => 'gold',
            'tag' => 'Karaoke',
            'book' => 'karaoke',
        ],
        [
            'slug' => 'private-hire',
            'title' => 'Private Hire',
            'when' => 'Birthdays, farewells, corporate nights',
            'blurb' => 'Take over the floor with your own guest list, menu and playlist. We handle the lights.',
            'tone' => 'violet',
            'tag' => 'Functions',
            'book' => 'private',
        ],
    ],

    'menu' => [
        [
            'group' => 'Signature Cocktails',
            'note' => 'Shaken with Himalayan flavours.',
            'items' => [
                ['Everest Sunrise', 'Vodka, passionfruit, chilli-honey, lime, saffron mist', 'sig'],
                ['Kathmandu Mule', 'Ginger, timur pepper, lime, ginger beer, mint', 'sig'],
                ['Yak & Yeti', 'Dark rum, chai syrup, bitters, orange peel', 'sig'],
                ['Himal Spritz', 'Aperol, elderflower, prosecco, soda', ''],
                ['Mango Lassi Martini', 'Vodka, mango, yoghurt cream, cardamom', ''],
                ['Rhododendron Sour', 'Gin, rhododendron cordial, lemon, egg white', ''],
            ],
        ],
        [
            'group' => 'Classics',
            'note' => 'Done properly.',
            'items' => [
                ['Espresso Martini', 'Vodka, coffee liqueur, fresh espresso', ''],
                ['Margarita', 'Tequila, triple sec, lime, salt rim', ''],
                ['Old Fashioned', 'Bourbon, bitters, sugar, orange', ''],
                ['Mojito', 'White rum, mint, lime, soda', ''],
            ],
        ],
        [
            'group' => 'Bites to Share',
            'note' => 'Built for the table.',
            'items' => [
                ['Chicken Momo', 'Steamed or fried, with tomato achar', 'sig'],
                ['Chilli Paneer', 'Wok-tossed peppers, spring onion', ''],
                ['Sekuwa Skewers', 'Charcoal-grilled, house marinade', ''],
                ['Loaded Fries', 'Masala dust, cheese, mint chutney', ''],
            ],
        ],
    ],

    'faq' => [
        ['Is there an entry fee?', 'Spend usually lands between $20 and $100 per person depending on your night. Call us for door details on event nights.'],
        ['Can I book a private room for karaoke?', 'Yes. Send a booking request with your group size and we will confirm by phone.'],
        ['Do you take group and birthday bookings?', 'Yes. Pick the occasion on the booking page and tell us what you need.'],
        ['How do I get there?', 'We are at Unit 2/98 Erindale Rd, Balcatta, just off the main road with parking nearby.'],
    ],
];
