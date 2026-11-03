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
    'maps_link' => 'https://www.google.com/maps/search/?api=1&query=Himalayan+Fusion+Hub+98+Erindale+Rd+Balcatta+WA',
    'price_range' => '$20 - $100 per person',
    'timezone' => 'Australia/Perth',
    'doors' => ['day' => 'Friday', 'time' => '18:30'],

    // CONFIRM: only Friday opening (6:30 pm) is confirmed from the Google listing.
    'hours' => [
        ['day' => 'Friday', 'time' => 'From 6:30 pm', 'live' => true],
        ['day' => 'Saturday', 'time' => 'Call for tonight\'s hours', 'live' => false],
        ['day' => 'Sun - Thu', 'time' => 'Private hire by booking', 'live' => false],
    ],

    'nav' => [
        ['label' => 'This week', 'route' => 'home', 'url' => '/#week'],
        ['label' => 'Nights', 'route' => 'events', 'url' => '/events'],
        ['label' => 'Menu', 'route' => 'menu', 'url' => '/menu'],
        ['label' => 'Find us', 'route' => 'home', 'url' => '/#contact'],
    ],

    /*
     * The week, shown as day tabs on the home page.
     * CONFIRM: set times inside Friday are a sample running order.
     */
    'week' => [
        [
            'key' => 'fri',
            'tab' => 'Friday',
            'weekday' => 5,
            'slots' => [
                ['6:30 pm', 'Doors open', 'Cocktails at the bar, momo from the kitchen'],
                ['8:00 pm', 'Karaoke lounge opens', 'Hindi, Nepali and English songbooks'],
                ['9:30 pm', 'DJ takes the floor', 'Bollywood, Nepali pop and Afrobeats'],
                ['11:30 pm', 'Late set', 'House until close'],
            ],
        ],
        [
            'key' => 'sat',
            'tab' => 'Saturday',
            'weekday' => 6,
            'slots' => [
                ['Varies', 'Call for tonight\'s plan', 'Ring 0493 964 334 and we will tell you what is on'],
                ['By request', 'Birthdays and groups', 'Book a table or a booth ahead'],
            ],
        ],
        [
            'key' => 'week',
            'tab' => 'Sun - Thu',
            'weekday' => null,
            'slots' => [
                ['By booking', 'Private hire', 'The floor, the bar and the lights for your guest list'],
                ['By booking', 'Karaoke groups', 'Take the lounge for a night of songs'],
            ],
        ],
    ],

    // Photos: Unsplash License (free to use). Sources listed in public/images/CREDITS.md.
    // Gallery row: each module is tall (3:4), pair (two 4:3) or wide (16:10).
    'gallery' => [
        ['tall', [['gal-dance-1', 'Friends dancing with their hands up on a night out']]],
        ['pair', [['gal-music-1', 'DJ hands on a mixer with coloured lights'], ['gal-drink-2', 'Friends toasting with cocktails at a dim bar']]],
        ['wide', [['gal-dance-2', 'Crowd dancing and smiling in a busy club']]],
        ['tall', [['gal-karaoke', 'Microphone on a stand ready for karaoke']]],
        ['pair', [['gal-food-2', 'Steamed dumplings in a bamboo basket'], ['gal-drink-1', 'Bartender pouring a drink over ice']]],
        ['wide', [['about-dance', 'Crowd in red laser light on the dance floor']]],
        ['tall', [['gal-music-2', 'DJ wearing headphones behind the decks']]],
    ],

    // Home page showcase: picks from the menu, each with a stand-in photograph.
    'picks' => [
        ['Everest Sunrise', 'Vodka, passionfruit, chilli-honey, lime and a saffron mist.', 'about-bar', 'Cocktail being poured at a lit bar', 'crimson'],
        ['Kathmandu Mule', 'Ginger, timur pepper, lime, ginger beer and mint.', 'gal-drink-1', 'Bartender pouring a drink over ice', 'blue'],
        ['Yak & Yeti', 'Dark rum, chai syrup, bitters and orange peel.', 'gal-drink-2', 'Friends toasting with cocktails at a dim bar', 'night'],
        ['Chicken Momo', 'Steamed or fried, with tomato achar. Built for the table.', 'gal-food-2', 'Steamed dumplings in a bamboo basket', 'jade'],
        ['Sekuwa & bites', 'Charcoal-grilled skewers, chilli paneer and loaded fries.', 'gal-food-1', 'Platter of momo dumplings and fried snacks', 'crimson'],
    ],

    'booking_types' => [
        'table' => 'Table for the night',
        'vip' => 'VIP booth & bottle service',
        'birthday' => 'Birthday or celebration',
        'private' => 'Private hire / function',
        'karaoke' => 'Karaoke group',
    ],

    // Thumbnail shown on each occasion choice in the booking form.
    'booking_images' => [
        'table' => 'gal-drink-2',
        'vip' => 'about-bar',
        'birthday' => 'gal-dance-2',
        'private' => 'event-private',
        'karaoke' => 'gal-karaoke',
    ],

    // CONFIRM: nights are indicative formats, not a published calendar.
    'nights' => [
        [
            'slug' => 'fusion-friday',
            'title' => 'Fusion Friday',
            'when' => 'Every Friday from 6:30 pm',
            'blurb' => 'Bollywood, Nepali pop, Afrobeats and house, blended by the DJ until late. Dress sharp, dance harder.',
            'field' => 'crimson',
            'image' => ['event-friday', 'Crowd with hands up under bright stage lights'],
            'book' => 'table',
        ],
        [
            'slug' => 'karaoke-nights',
            'title' => 'Karaoke Lounge',
            'when' => 'Fridays from 8 pm, or any night by booking',
            'blurb' => 'Hindi, Nepali and English songbooks, a proper sound system and a crowd that cheers every note.',
            'field' => 'saffron',
            'image' => ['event-karaoke', 'Microphone glowing in warm bokeh light'],
            'book' => 'karaoke',
        ],
        [
            'slug' => 'private-hire',
            'title' => 'Private Hire',
            'when' => 'Birthdays, farewells, corporate nights',
            'blurb' => 'Take over the floor with your own guest list, menu and playlist. We handle the lights.',
            'field' => 'jade',
            'image' => ['event-private', 'Warm-lit cocktail bar with hanging bulbs'],
            'book' => 'private',
        ],
    ],

    'menu' => [
        [
            'group' => 'Signature Cocktails',
            'note' => 'Shaken with Himalayan flavours.',
            'field' => 'crimson',
            'image' => ['about-bar', 'Cocktail being poured at a lit bar'],
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
            'field' => 'night',
            'image' => ['gal-drink-1', 'Bartender pouring a drink over ice'],
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
            'field' => 'jade',
            'image' => ['gal-food-2', 'Steamed dumplings in a bamboo basket'],
            'items' => [
                ['Chicken Momo', 'Steamed or fried, with tomato achar', 'sig'],
                ['Chilli Paneer', 'Wok-tossed peppers, spring onion', ''],
                ['Sekuwa Skewers', 'Charcoal-grilled, house marinade', ''],
                ['Loaded Fries', 'Masala dust, cheese, mint chutney', ''],
            ],
        ],
    ],

    // CONFIRM: dress code, parking and payment answers are sample copy.
    'faq' => [
        ['Is there an entry fee?', 'Spend usually lands between $20 and $100 per person depending on your night. Call us for door details on event nights.'],
        ['Do I need to book?', 'Walk-ins are welcome on Fridays. Book ahead for a table, a VIP booth or a group bigger than six.'],
        ['Can I book the karaoke lounge?', 'Yes. Send a booking request with your group size and we will confirm by phone.'],
        ['Do you take birthdays and groups?', 'Yes. Pick the occasion on the booking page and tell us what you need.'],
        ['Is there a dress code?', 'Smart casual. No thongs or sportswear on the dance floor.'],
        ['How old do I need to be?', 'Eighteen and over only. Bring a photo ID every visit.'],
        ['Where do I park?', 'We are at Unit 2/98 Erindale Rd, Balcatta, with parking on site and along Erindale Rd.'],
    ],

    // Found photographs that need a credit on the page (CC BY 4.0).
    'credits' => [
        ['"Thamel at Night - Kathmandu, Nepal (15)" by Saddam Hussain Ansari, CC BY 4.0', 'https://commons.wikimedia.org/wiki/File:Thamel_at_Night_-_Kathmandu,_Nepal_(15).jpg'],
    ],
];
