@extends(view()->first(['vendor.kubis.agegate.main', 'agegate::main'])->getName())

@section('agegate.form.fields')

    <input type="number" name="day" value="{{ old('day') }}"/>
    @error('day')
        <p>{{ $message }}</p>
    @enderror

    <input type="number" name="month" value="{{ old('month') }}"/>
    @error('month')
        <p>{{ $message }}</p>
    @enderror

    <input type="number" name="year" value="{{ old('year') }}"/>
    @error('year')
        <p>{{ $message }}</p>
    @enderror

@endsection