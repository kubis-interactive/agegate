@extends(view()->first(['vendor.kubis.agegate.main', 'agegate::main'])->getName())

@section('agegate.form.fields')
    <input type="number" name="year" value="{{ old('year') }}"/>

    @error('year')
        <p>{{ $message }}</p>
    @enderror
@endsection