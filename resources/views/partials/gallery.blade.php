<section class="chapter field-blue gallery" data-field="blue" aria-labelledby="gallery-title">
    <div class="grid gallery-head">
        <h2 class="rise" id="gallery-title">Most Fridays<br>look like this</h2>
        <p class="rise">Swipe the row. The floor, the decks, the karaoke lounge and the kitchen.</p>
    </div>
    <div class="row" tabindex="0" role="region" aria-label="Photos, scroll sideways" data-row>
        @foreach (config('hfh.gallery') as [$kind, $shots])
            <div class="mod mod-{{ $kind }}">
                @foreach ($shots as [$img, $alt])
                    <img src="{{ asset('images/'.$img.'.webp') }}" width="800" height="800" loading="lazy" alt="{{ $alt }}">
                @endforeach
            </div>
        @endforeach
    </div>
</section>
