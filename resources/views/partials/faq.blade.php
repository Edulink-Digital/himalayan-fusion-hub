<section class="chapter field-paper faq" id="faq" data-field="paper" aria-labelledby="faq-title">
    <div class="grid">
        <h2 class="faq-title rise" id="faq-title">Before<br>you come</h2>
        <div class="faq-list">
            @foreach (config('hfh.faq') as $i => [$question, $answer])
                <details class="tile-q rise" name="faq" @if ($i === 0) open @endif>
                    <summary>{{ $question }}<span class="pm" aria-hidden="true"><i></i><i></i></span></summary>
                    <p>{{ $answer }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>
