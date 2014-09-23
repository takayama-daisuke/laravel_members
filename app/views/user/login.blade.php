@if ( Auth::guest() )
未ログイン
@else
ログイン済みです
@endif

{{ Form::open() }}
    {{ Form::label("name", "Username") }}
    {{ Form::text("name", Input::old('name', ''), [
             "placeholder" => "web帳"
    ]) }}

    {{ Form::label("password", "Password") }}
    {{ Form::password("password", [
         "placeholder" => "password"
    ]) }}

    @if ($error = $errors->first("password"))
        <div class="error">
            {{ $error }}
        </div>
    @endif
    {{ Form::submit("login") }}
{{ Form::close() }}