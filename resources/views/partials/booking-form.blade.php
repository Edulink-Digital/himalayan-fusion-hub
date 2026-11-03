@if (session('booked'))
    <div class="notice notice-ok" role="status">
        @include('partials.icon', ['name' => 'check'])
        <p><strong>Request received, {{ session('booked') }}.</strong> We will call you shortly to confirm your booking.</p>
    </div>
@endif
@if ($errors->any())
    <div class="notice notice-bad" role="alert">
        <p><strong>Check the highlighted fields.</strong> {{ $errors->count() }} {{ Str::plural('thing', $errors->count()) }} need your attention.</p>
    </div>
@endif
@php $selected = old('type', request('type', 'table')); @endphp
<form class="form" method="POST" action="{{ route('book.store') }}" novalidate data-form>
    @csrf
    <fieldset class="field occasions rise" @error('type') aria-describedby="type-err" @enderror>
        <legend>What's the occasion?</legend>
        <div class="choices">
            @foreach (config('hfh.booking_types') as $key => $label)
                <label class="choice">
                    <input type="radio" name="type" value="{{ $key }}" @checked($selected === $key) required>
                    <span><img src="{{ asset('images/'.config('hfh.booking_images.'.$key).'.webp') }}" width="400" height="300" loading="lazy" alt=""><b>{{ $label }}</b></span>
                </label>
            @endforeach
        </div>
        @error('type')<p class="err" id="type-err">{{ $message }}</p>@enderror
    </fieldset>

    <div class="pair rise">
        <div class="field">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="{{ old('date') }}" data-min-today required aria-invalid="{{ $errors->has('date') ? 'true' : 'false' }}" @error('date') aria-describedby="date-err" @enderror>
            @error('date')<p class="err" id="date-err">{{ $message }}</p>@enderror
        </div>
        <div class="field">
            <label for="guests">Guests</label>
            <div class="stepper">
                <button type="button" aria-label="One fewer guest" data-step="-1">@include('partials.icon', ['name' => 'minus'])</button>
                <input type="number" id="guests" name="guests" min="1" max="200" value="{{ old('guests', 4) }}" inputmode="numeric" required aria-invalid="{{ $errors->has('guests') ? 'true' : 'false' }}" @error('guests') aria-describedby="guests-err" @enderror>
                <button type="button" aria-label="One more guest" data-step="1">@include('partials.icon', ['name' => 'plus'])</button>
            </div>
            @error('guests')<p class="err" id="guests-err">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="field rise">
        <label for="name">Your name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" autocomplete="name" required aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" @error('name') aria-describedby="name-err" @enderror>
        @error('name')<p class="err" id="name-err">{{ $message }}</p>@enderror
    </div>
    <div class="pair rise">
        <div class="field">
            <label for="phone">Mobile</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel" inputmode="tel" required aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}" aria-describedby="phone-hint @error('phone') phone-err @enderror">
            <p class="hint" id="phone-hint">We call this number to confirm.</p>
            @error('phone')<p class="err" id="phone-err">{{ $message }}</p>@enderror
        </div>
        <div class="field">
            <label for="email">Email <span class="opt">(optional)</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" inputmode="email" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" @error('email') aria-describedby="email-err" @enderror>
            @error('email')<p class="err" id="email-err">{{ $message }}</p>@enderror
        </div>
    </div>
    <div class="field rise">
        <label for="notes">Anything we should know? <span class="opt">(optional)</span></label>
        <textarea id="notes" name="notes" rows="4" placeholder="Birthday cake, dietary needs, song requests">{{ old('notes') }}</textarea>
    </div>
    <button class="btn btn-big btn-block rise" type="submit" data-submit>Send request</button>
</form>
