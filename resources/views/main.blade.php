<form action="" method="POST">
    @csrf

    @yield('agegate.form.fields')

    @error('too_young')
        Too young for this
    @enderror

    @error('too_old')
        Too old for this
    @enderror

    <br />
    <label for="">
        <input type="checkbox" value="1" name="remember" @if(old('remember') == 1) checked="checked" @endif /> Remember me
    </label> <br />
    <button type="submit">Send</button>
</form>