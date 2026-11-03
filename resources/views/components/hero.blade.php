@props(['title', 'low' => 'crimson'])
{{-- Two flat fields meeting at a seam; the headline crosses it and changes ink. --}}
<section {{ $attributes->class(['hero', 'low-'.$low]) }} data-field="paper" aria-labelledby="hero-title">
    <div class="hero-fields" aria-hidden="true"><span class="hero-up"></span><span class="hero-low" data-field="{{ $low }}"></span></div>
    <div class="hero-top">{{ $above ?? '' }}</div>
    <h1 class="hero-title" id="hero-title">
        <span class="ht ht-up">{!! $title !!}</span>
        <span class="ht ht-low" aria-hidden="true">{!! $title !!}</span>
    </h1>
    <div class="hero-below">{{ $slot }}</div>
</section>
