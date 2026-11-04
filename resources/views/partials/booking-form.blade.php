@if (session('booked'))
    <div class="success" role="status">@include('partials.icon', ['name' => 'check-circle'])<div><strong>Request received, {{ session('booked') }}.</strong>{{ config('hfh.book_page.form_success') }}</div></div>
@endif
@if ($errors->any())
    <div class="success bad" role="alert">@include('partials.icon', ['name' => 'warning-circle'])<div><strong>Check the highlighted fields.</strong>{{ $errors->count() }} {{ Str::plural('thing', $errors->count()) }} need your attention.</div></div>
@endif
@php $sel = old('type', request('type')); @endphp
<form class="form" method="POST" action="{{ route('book.store') }}" novalidate>
    @csrf
    <div class="field"><label for="name">Name <em>*</em></label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" autocomplete="name" required aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" @error('name') aria-describedby="name-err" @enderror>
        @error('name')<span class="err" id="name-err">{{ $message }}</span>@enderror</div>
    <div class="field"><label for="phone">Phone <em>*</em></label>
        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel" inputmode="tel" required aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}" @error('phone') aria-describedby="phone-err" @enderror>
        @error('phone')<span class="err" id="phone-err">{{ $message }}</span>@enderror</div>
    <div class="field"><label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" @error('email') aria-describedby="email-err" @enderror>
        @error('email')<span class="err" id="email-err">{{ $message }}</span>@enderror</div>
    <div class="field"><label for="type">Occasion <em>*</em></label>
        <select id="type" name="type" required aria-invalid="{{ $errors->has('type') ? 'true' : 'false' }}" @error('type') aria-describedby="type-err" @enderror>
            <option value="">Choose one</option>
            @foreach (config('hfh.booking_types') as $k => $label)<option value="{{ $k }}" @selected($sel === $k)>{{ $label }}</option>@endforeach
        </select>
        @error('type')<span class="err" id="type-err">{{ $message }}</span>@enderror</div>
    <div class="field"><label for="date">Date <em>*</em></label>
        <input type="date" id="date" name="date" value="{{ old('date') }}" data-min-today required aria-invalid="{{ $errors->has('date') ? 'true' : 'false' }}" @error('date') aria-describedby="date-err" @enderror>
        @error('date')<span class="err" id="date-err">{{ $message }}</span>@enderror</div>
    <div class="field"><label for="guests">Guests <em>*</em></label>
        <input type="number" id="guests" name="guests" min="1" max="200" value="{{ old('guests', 4) }}" inputmode="numeric" required aria-invalid="{{ $errors->has('guests') ? 'true' : 'false' }}" @error('guests') aria-describedby="guests-err" @enderror>
        @error('guests')<span class="err" id="guests-err">{{ $message }}</span>@enderror</div>
    <div class="field full"><label for="notes">Write message</label>
        <textarea id="notes" name="notes" placeholder="Birthday, dietary needs, song requests...">{{ old('notes') }}</textarea>
        <span class="hint">{{ config('hfh.book_page.form_hint') }}</span></div>
    <button class="btn" type="submit">{{ config('hfh.book_page.form_submit') }}</button>
</form>
