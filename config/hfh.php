<?php

/*
 * Single source of truth for venue facts and page content.
 * Items marked CONFIRM are placeholders the owner should verify before launch.
 */
return [
    'name' => 'Himalayan Fusion Hub',
    'short' => 'HFH',
    'tagline' => 'A Bhutanese-owned night club in Perth for Bhutanese, Nepali, Indian and Australian crowds.',
    'address' => 'Unit 2/98 Erindale Rd, Balcatta WA 6021',
    'address_lines' => ['Unit 2/98 Erindale Rd', 'Balcatta WA 6021'],
    'phone' => '0493 964 334',
    'phone_href' => '+61493964334',
    'whatsapp' => '61493964334',
    // CONFIRM: placeholder address; replace with the club's real email before launch.
    'email' => 'hfh@gmail.com',
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

    // Photos: Unsplash License (free to use). Sources listed in public/images/CREDITS.md.
    'gallery' => [
        ['Dancing', 'Dance floor', '700/900', 'gal-dance-1', 'Friends dancing with their hands up on a night out'],
        ['Drinks', 'Signature pours', '800/650', 'gal-drink-2', 'Friends toasting with cocktails at a dim bar'],
        ['Karaoke', 'Karaoke lounge', '700/900', 'gal-karaoke', 'Microphone on a stand ready for karaoke'],
        ['Music', 'DJ booth', '800/660', 'gal-music-1', 'DJ hands on a mixer with coloured lights'],
        ['Food', 'Momo and bites', '800/720', 'gal-food-1', 'Platter of momo dumplings and fried snacks'],
        ['Dancing', 'Lights on', '800/800', 'gal-dance-2', 'Crowd dancing and smiling in a busy club'],
        ['Drinks', 'Behind the bar', '700/800', 'gal-drink-1', 'Bartender pouring a drink over ice'],
        ['Food', 'Steamed momo', '800/800', 'gal-food-2', 'Steamed dumplings in a bamboo basket'],
        ['Music', 'Resident DJ', '700/820', 'gal-music-2', 'DJ wearing headphones behind the decks'],
    ],

    'booking_types' => [
        'table' => 'Table for the night',
        'vip' => 'VIP booth & bottle service',
        'special' => 'Special event pre-booking',
        'birthday' => 'Birthday or celebration',
        'karaoke' => 'Karaoke group',
        'snooker' => 'Snooker table',
        'private' => 'Private hire / function',
    ],

    /*
     * What the venue offers, shown as cards on the home page.
     * Each: [title, icon, description, link label, link (relative URL)].
     * CONFIRM: wording for snooker, the festival list and the Dzongkha songbook.
     */
    'features' => [
        ['Karaoke', 'microphone-stage', 'Private karaoke rooms and a main stage with Dzongkha, Nepali, Hindi and English songbooks. Grab the mic and own the room.', 'Book karaoke', '/book?type=karaoke'],
        ['Snooker', 'snooker', 'Snooker tables for a relaxed frame with friends, before or between rounds on the dance floor.', 'Book a snooker table', '/book?type=snooker'],
        ['Bar', 'martini', 'Himalayan-spiced cocktails, cold beers and heavy-handed pours from a fully stocked bar.', 'See the menu', '/menu'],
        ['DJ', 'vinyl-record', 'Our DJ moves from Bhutanese Rigsar and Nepali hits to Bollywood and Aussie party anthems, with lights that follow every drop.', 'See the nights', '/events'],
        ['Organised Events', 'confetti', 'Festival nights for Losar, Dashain, Tihar and Diwali, plus themed parties and live shows hosted by our team.', 'Upcoming events', '/events'],
        ['Pre-Booking', 'calendar-check', 'Lock in your table, booth or package before festival nights and special events sell out.', 'Pre-book now', '/book?type=special'],
    ],

    // CONFIRM: nights are indicative formats, not a published calendar.
    'nights' => [
        [
            'slug' => 'fusion-friday',
            'title' => 'Fusion Friday',
            'when' => 'Fridays from 6:30 pm',
            'blurb' => 'Bhutanese and Nepali hits, Bollywood bangers and Aussie party anthems, blended by the DJ until late. Dress sharp, dance harder.',
            'tone' => 'magenta',
            'tag' => 'Dancing',
            'book' => 'table',
            'count' => true,
        ],
        [
            'slug' => 'karaoke-nights',
            'title' => 'Karaoke Lounge',
            'when' => 'Book a private room or take the stage',
            'blurb' => 'Dzongkha, Nepali, Hindi and English songbooks, a proper sound system and a crowd that cheers every note.',
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
        ['Who comes to Himalayan Fusion Hub?', 'We are Bhutanese-owned, and our regulars are Bhutanese, Nepali, Indian and Australian. Everyone 18+ is welcome.'],
        ['Is there an entry fee?', 'Spend usually lands between $20 and $100 per person depending on your night. Call us for door details on event nights.'],
        ['Can I book a snooker table?', 'Yes. Choose "Snooker table" on the booking page, or ask at the bar on the night.'],
        ['Can I book a private room for karaoke?', 'Yes. Send a booking request with your group size and we will confirm by phone.'],
        ['Do you take group and birthday bookings?', 'Yes. Pick the occasion on the booking page and tell us what you need.'],
        ['How do I get there?', 'We are at Unit 2/98 Erindale Rd, Balcatta, just off the main road with parking nearby.'],
    ],
];
