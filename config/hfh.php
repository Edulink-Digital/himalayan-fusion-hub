<?php

/*
 * Default venue facts and page content. Everything editable in the admin panel
 * (/admin > Site content) starts from these values; saved edits live in the
 * site_settings table and override the matching top-level key at boot.
 * Items marked CONFIRM are placeholders the owner should verify before launch.
 */
return [
    'name' => 'Himalayan Fusion Hub',

    // Hosts with an empty disk (Wasmer Edge volume) create and migrate the SQLite file on first boot.
    'auto_migrate' => env('HFH_AUTO_MIGRATE', false),

    // First admin login, created on boot when no users exist and both are set (e.g. Wasmer secrets).
    'admin_email' => env('ADMIN_EMAIL'),
    'admin_password' => env('ADMIN_PASSWORD'),

    // Colour theme: one of the keys in 'themes'. Changed in the admin panel.
    'theme' => 'midnight',
    'themes' => [
        'midnight' => 'Midnight (violet and blue)',
        'disco' => 'Disco Ball (magenta, cyan and gold)',
        'vice' => 'Vice City (sunset pink and neon cyan)',
    ],

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

    // Top-bar social links. Empty ones are hidden.
    // CONFIRM: placeholders open each platform's search; replace with the club's real pages in the admin panel.
    'socials' => [
        'facebook' => 'https://www.facebook.com/search/top?q=Himalayan%20Fusion%20Hub',
        'instagram' => 'https://www.instagram.com/explore/search/keyword/?q=Himalayan%20Fusion%20Hub',
        'tiktok' => 'https://www.tiktok.com/search?q=Himalayan%20Fusion%20Hub',
    ],

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

    'seo' => [
        'title' => 'Himalayan Fusion Hub | Night Club in Balcatta, Perth',
        'description' => 'Himalayan Fusion Hub is a Bhutanese-owned night club in Balcatta, Perth, loved by Bhutanese, Nepali, Indian and Australian crowds. Karaoke, snooker, a full bar, DJ nights and festival events.',
        'share_description' => 'Bhutanese-owned night club in Balcatta, Perth: karaoke, snooker, cocktails, DJ nights and festival events.',
    ],

    'home' => [
        'hero_kicker' => 'Unleashing the power of the night',
        'hero_title' => 'Discover The Best Night Out In Perth',
        'hero_lead' => 'A Bhutanese-owned club where Bhutanese, Nepali, Indian and Aussie friends share one dance floor. Great drinks, karaoke, snooker and a DJ who plays for everyone.',
        'hero_cta' => 'Book a table',
        'hero_cta_secondary' => 'Book VIP',

        'about_ghost' => 'About us',
        'about_title' => 'Bhutanese Owned, Built for Everyone',
        'about_text' => 'Himalayan Fusion Hub is a Bhutanese-owned night club bringing Himalayan warmth to Balcatta. Our regulars are Bhutanese, Nepali, Indian and Australian, and the night is built for all of them: songs in Dzongkha, Nepali, Hindi and English, a DJ who moves from Rigsar to Bollywood to the charts, and a team that treats every guest like family.',
        'about_cards' => [
            ['title' => 'VIP Service', 'text' => 'Private booths, bottle service and a host for your group.'],
            ['title' => 'Karaoke Rooms', 'text' => 'Dzongkha, Nepali, Hindi and English songbooks with a full sound system.'],
        ],
        'about_cta' => 'Read more',

        'ticket_label' => 'Doors open soon',
        'ticket_title' => 'Where the party never ends',
        'ticket_text' => 'Fusion Friday is the weekly main event. Dancing, cocktails and a DJ who reads the room.',
        'ticket_day' => 'Every Friday',
        'ticket_doors' => '6:30 pm',
        'ticket_cta' => 'Book table',

        'services_ghost' => 'Services',
        'services_title' => 'What We Provide',
        'services_text' => 'Sing, play, sip and dance: everything for your night out under one roof in Balcatta.',

        'gallery_ghost' => 'Photos',
        'gallery_title' => 'Our Gallery',
        'gallery_text' => 'Discover the magic of music, one photo at a time.',

        'events_ghost' => 'Events',
        'events_title' => 'Upcoming Events',
        'events_text' => 'Celebrate the rhythm, energy and passion, all in one unforgettable night.',
        'events_cta' => 'View all',

        'booking_ghost' => 'Tables',
        'booking_title' => 'Book Your Table',
        'booking_text' => 'Spend less time waiting and more time on the dance floor.',
        'booking_mobile_cta' => 'Open the booking form',

        'callout_title' => 'Questions about tonight? Talk to the team',

        'contact_ghost' => 'Contact',
        'contact_title' => 'Get In Touch',
        'contact_address_label' => 'Address',
        'contact_call_label' => 'Call Us',
        'contact_hours_label' => 'Opening Hours',
    ],

    'events_page' => [
        'meta_title' => 'Events & Nights | Himalayan Fusion Hub Perth',
        'meta_description' => 'Fusion Fridays, festival nights, the karaoke lounge and private hire at Bhutanese-owned Himalayan Fusion Hub, Balcatta WA.',
        'title' => 'Upcoming Events',
        'text' => 'From the Friday dance floor to private karaoke rooms.',
        'faq_ghost' => 'FAQ',
        'faq_title' => 'Good to Know',
    ],

    'menu_page' => [
        'meta_title' => 'Cocktails & Bites Menu | Himalayan Fusion Hub Perth',
        'meta_description' => 'Signature Himalayan cocktails, classics and shareable bites at Himalayan Fusion Hub, Balcatta.',
        'title' => 'Our Menu',
        'text' => 'Cocktails with Himalayan flavour and bites made for sharing. Prices at the bar.',
        'cta' => 'Book a table',
    ],

    'book_page' => [
        'meta_title' => 'Book a Table or Private Hire | Himalayan Fusion Hub Perth',
        'meta_description' => 'Reserve a table, VIP booth, birthday or karaoke room at Himalayan Fusion Hub in Balcatta, Perth.',
        'title' => 'Book Your Table',
        'text' => 'Send a request and we will call to confirm.',
        'side_title' => 'Prefer to call?',
        'form_hint' => 'This is a request until we call you back to confirm.',
        'form_submit' => 'Send request',
        'form_success' => 'We will call you shortly to confirm your booking.',
    ],

    'footer' => [
        'note' => 'Please drink responsibly. 18+ only, ID required.',
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
     * CONFIRM: wording for snooker, the festival list and the Dzongkha songbook.
     */
    'features' => [
        ['title' => 'Karaoke', 'icon' => 'microphone-stage', 'text' => 'Private karaoke rooms and a main stage with Dzongkha, Nepali, Hindi and English songbooks. Grab the mic and own the room.', 'cta' => 'Book karaoke', 'link' => '/book?type=karaoke'],
        ['title' => 'Snooker', 'icon' => 'snooker', 'text' => 'Snooker tables for a relaxed frame with friends, before or between rounds on the dance floor.', 'cta' => 'Book a snooker table', 'link' => '/book?type=snooker'],
        ['title' => 'Bar', 'icon' => 'martini', 'text' => 'Himalayan-spiced cocktails, cold beers and heavy-handed pours from a fully stocked bar.', 'cta' => 'See the menu', 'link' => '/menu'],
        ['title' => 'DJ', 'icon' => 'vinyl-record', 'text' => 'Our DJ moves from Bhutanese Rigsar and Nepali hits to Bollywood and Aussie party anthems, with lights that follow every drop.', 'cta' => 'See the nights', 'link' => '/events'],
        ['title' => 'Organised Events', 'icon' => 'confetti', 'text' => 'Festival nights for Losar, Dashain, Tihar and Diwali, plus themed parties and live shows hosted by our team.', 'cta' => 'Upcoming events', 'link' => '/events'],
        ['title' => 'Pre-Booking', 'icon' => 'calendar-check', 'text' => 'Lock in your table, booth or package before festival nights and special events sell out.', 'cta' => 'Pre-book now', 'link' => '/book?type=special'],
    ],

    // CONFIRM: nights are indicative formats, not a published calendar.
    'nights' => [
        [
            'title' => 'Fusion Friday',
            'when' => 'Fridays from 6:30 pm',
            'blurb' => 'Bhutanese and Nepali hits, Bollywood bangers and Aussie party anthems, blended by the DJ until late. Dress sharp, dance harder.',
            'book' => 'table',
            'count' => true,
        ],
        [
            'title' => 'Karaoke Lounge',
            'when' => 'Book a private room or take the stage',
            'blurb' => 'Dzongkha, Nepali, Hindi and English songbooks, a proper sound system and a crowd that cheers every note.',
            'book' => 'karaoke',
            'count' => false,
        ],
        [
            'title' => 'Private Hire',
            'when' => 'Birthdays, farewells, corporate nights',
            'blurb' => 'Take over the floor with your own guest list, menu and playlist. We handle the lights.',
            'book' => 'private',
            'count' => false,
        ],
    ],

    'menu' => [
        [
            'group' => 'Signature Cocktails',
            'note' => 'Shaken with Himalayan flavours.',
            'items' => [
                ['name' => 'Everest Sunrise', 'description' => 'Vodka, passionfruit, chilli-honey, lime, saffron mist', 'house_pick' => true],
                ['name' => 'Kathmandu Mule', 'description' => 'Ginger, timur pepper, lime, ginger beer, mint', 'house_pick' => true],
                ['name' => 'Yak & Yeti', 'description' => 'Dark rum, chai syrup, bitters, orange peel', 'house_pick' => true],
                ['name' => 'Himal Spritz', 'description' => 'Aperol, elderflower, prosecco, soda', 'house_pick' => false],
                ['name' => 'Mango Lassi Martini', 'description' => 'Vodka, mango, yoghurt cream, cardamom', 'house_pick' => false],
                ['name' => 'Rhododendron Sour', 'description' => 'Gin, rhododendron cordial, lemon, egg white', 'house_pick' => false],
            ],
        ],
        [
            'group' => 'Classics',
            'note' => 'Done properly.',
            'items' => [
                ['name' => 'Espresso Martini', 'description' => 'Vodka, coffee liqueur, fresh espresso', 'house_pick' => false],
                ['name' => 'Margarita', 'description' => 'Tequila, triple sec, lime, salt rim', 'house_pick' => false],
                ['name' => 'Old Fashioned', 'description' => 'Bourbon, bitters, sugar, orange', 'house_pick' => false],
                ['name' => 'Mojito', 'description' => 'White rum, mint, lime, soda', 'house_pick' => false],
            ],
        ],
        [
            'group' => 'Bites to Share',
            'note' => 'Built for the table.',
            'items' => [
                ['name' => 'Chicken Momo', 'description' => 'Steamed or fried, with tomato achar', 'house_pick' => true],
                ['name' => 'Chilli Paneer', 'description' => 'Wok-tossed peppers, spring onion', 'house_pick' => false],
                ['name' => 'Sekuwa Skewers', 'description' => 'Charcoal-grilled, house marinade', 'house_pick' => false],
                ['name' => 'Loaded Fries', 'description' => 'Masala dust, cheese, mint chutney', 'house_pick' => false],
            ],
        ],
    ],

    'faq' => [
        ['question' => 'Who comes to Himalayan Fusion Hub?', 'answer' => 'We are Bhutanese-owned, and our regulars are Bhutanese, Nepali, Indian and Australian. Everyone 18+ is welcome.'],
        ['question' => 'Is there an entry fee?', 'answer' => 'Spend usually lands between $20 and $100 per person depending on your night. Call us for door details on event nights.'],
        ['question' => 'Can I book a snooker table?', 'answer' => 'Yes. Choose "Snooker table" on the booking page, or ask at the bar on the night.'],
        ['question' => 'Can I book a private room for karaoke?', 'answer' => 'Yes. Send a booking request with your group size and we will confirm by phone.'],
        ['question' => 'Do you take group and birthday bookings?', 'answer' => 'Yes. Pick the occasion on the booking page and tell us what you need.'],
        ['question' => 'How do I get there?', 'answer' => 'We are at Unit 2/98 Erindale Rd, Balcatta, just off the main road with parking nearby.'],
    ],
];
