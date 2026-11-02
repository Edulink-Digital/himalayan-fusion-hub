@extends('layouts.app')
@section('title', 'Book a Table or Private Hire | Himalayan Fusion Hub Perth')
@section('description', 'Reserve a table, VIP booth, birthday or karaoke room at Himalayan Fusion Hub in Balcatta, Perth.')

@section('content')
<section class="page-hero">
    @include('partials.stage')
    <div class="wrap">
        <h1 class="rv">Book your <span class="hl">night</span></h1>
        <p class="rv" style="--d:1">Send a request and we will call to confirm. Prefer to talk now? Ring {{ config('hfh.phone') }}.</p>
    </div>
</section>

<section class="sec" style="padding-top:2rem">
    <div class="wrap book-grid">
        <div class="panel rv" id="booking-form">
            @if (session('booked'))
                <div class="success" role="status">
                    <i class="ph-bold ph-check-circle" aria-hidden="true"></i>
                    <div><strong>Request received, {{ session('booked') }}.</strong>We will call you shortly to confirm your booking.</div>
                </div>
            @endif
            @if ($errors->any())
                <div class="success" role="alert" style="border-color:#ff6b9a;background:rgba(255,107,154,.08)">
                    <i class="ph-bold ph-warning-circle" aria-hidden="true" style="color:#ff8fb3"></i>
                    <div><strong>Check the highlighted fields.</strong>{{ $errors->count() }} {{ Str::plural('thing', $errors->count()) }} need your attention.</div>
                </div>
            @endif
            <form class="form" method="POST" action="{{ route('book.store') }}" novalidate>
                @csrf
                @php
                    $f = fn ($n) => ['id' => $n, 'name' => $n, 'aria-invalid' => $errors->has($n) ? 'true' : 'false', 'aria-describedby' => $errors->has($n) ? $n.'-err' : null];
                @endphp
                <div class="field">
                    <label for="name">Name <em>*</em></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" autocomplete="name" required aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}">
                    @error('name')<span class="err" id="name-err">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="phone">Phone <em>*</em></label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel" inputmode="tel" required aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}">
                    @error('phone')<span class="err" id="phone-err">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
                    @error('email')<span class="err" id="email-err">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="type">Occasion <em>*</em></label>
                    <select id="type" name="type" required aria-invalid="{{ $errors->has('type') ? 'true' : 'false' }}">
                        <option value="">Choose one</option>
                        @foreach (config('hfh.booking_types') as $k => $label)
                            <option value="{{ $k }}" @selected(old('type') === $k)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('type')<span class="err" id="type-err">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="date">Date <em>*</em></label>
                    <input type="date" id="date" name="date" value="{{ old('date') }}" data-min-today required aria-invalid="{{ $errors->has('date') ? 'true' : 'false' }}">
                    @error('date')<span class="err" id="date-err">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="guests">Guests <em>*</em></label>
                    <input type="number" id="guests" name="guests" min="1" max="200" value="{{ old('guests', 4) }}" inputmode="numeric" required aria-invalid="{{ $errors->has('guests') ? 'true' : 'false' }}">
                    @error('guests')<span class="err" id="guests-err">{{ $message }}</span>@enderror
                </div>
                <div class="field full">
                    <label for="notes">Anything we should know?</label>
                    <textarea id="notes" name="notes" placeholder="Birthday, dietary needs, song requests...">{{ old('notes') }}</textarea>
                    <span class="hint">This is a request, not a confirmed booking, until we call you back.</span>
                </div>
                <button class="btn btn-glow" type="submit">Send request <i class="ph-bold ph-paper-plane-tilt" aria-hidden="true"></i></button>
            </form>
        </div>
        <aside class="panel rv" style="--d:1">
            <h2 style="font-size:1.6rem">Prefer to <span class="hl">call</span>?</h2>
            <div class="info">
                <div><i class="ph-bold ph-phone" aria-hidden="true"></i><p><strong>Phone</strong><a href="tel:{{ config('hfh.phone_href') }}">{{ config('hfh.phone') }}</a></p></div>
                <div><i class="ph-bold ph-map-pin" aria-hidden="true"></i><p><strong>Where</strong>{{ config('hfh.address') }}</p></div>
                <div><i class="ph-bold ph-ticket" aria-hidden="true"></i><p><strong>Typical spend</strong>{{ config('hfh.price_range') }}</p></div>
            </div>
        </aside>
    </div>
</section>
@endsection
