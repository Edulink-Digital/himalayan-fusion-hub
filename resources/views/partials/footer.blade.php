<footer class="site-footer">
    <div class="wrap">
        <div class="foot-links">
            <a href="{{ route('home') }}">Home</a><a href="{{ route('events') }}">Events</a><a href="{{ route('menu') }}">Menu</a><a href="{{ route('book') }}">Book a table</a>
        </div>
        <p>&copy; {{ date('Y') }} {{ config('hfh.name') }}. All rights reserved. Photography from <a href="https://unsplash.com" target="_blank" rel="noopener">Unsplash</a>. Please drink responsibly. 18+ only, ID required.</p>
        <p class="credit">Website by <a href="https://digitaledulink.com" target="_blank" rel="noopener">Edulink Digital</a></p>
    </div>
</footer>
