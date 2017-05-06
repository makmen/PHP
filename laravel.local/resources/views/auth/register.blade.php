@extends('layouts.site')

@section('content')
<div>
    <form id="register" method="post" action="/auth/register">
        {!! csrf_field() !!}
        
        <div class="fb">
            <div class="description">Имя:</div>
            <div class="date">
                <input class="w100{{ $errors->has('name') ? ' err' : '' }}" type="text" name="name" value="{{ old('name') }}" />
                @if ($errors->has('name'))
                    <div class="error">
                        <div class="msg">{{ $errors->first('name') }}</div>
                    </div>
                @endif
            </div>
            <div class="cb"></div>
        </div>

        <div class="fb">
            <div class="description">Email:</div>
            <div class="date">
                <input class="w100{{ $errors->has('email') ? ' err' : '' }}" type="text" name="email" value="{{ old('email') }}" />
                @if ($errors->has('email'))
                    <div class="error">
                        <div class="msg">{{ $errors->first('email') }}</div>
                    </div>
                @endif
            </div>
            <div class="cb"></div>
        </div>
        
        <div class="fb">
            <div class="description">Phone:</div>
            <div class="date">
                <input class="w100{{ $errors->has('phone') ? ' err' : '' }}" type="text" name="phone" value="{{ old('phone') }}" />
            </div>
            <div class="cb"></div>
        </div>

        <div class="fb">
            <div class="description">Login:</div>
            <div class="date">
                <input class="w100{{ $errors->has('login') ? ' err' : '' }}" type="text" name="login" value="{{ old('login') }}" />
                @if ($errors->has('login'))
                    <div class="error">
                        <div class="msg">{{ $errors->first('login') }}</div>
                    </div>
                @endif
            </div>
            <div class="cb"></div>
        </div>
        
        <div class="fb">
            <div class="description">Пароль:</div>
            <div class="date">
                <input class="w100{{ $errors->has('password') ? ' err' : '' }}" type="password" name="password" value="" />
                @if ($errors->has('password'))
                    <div class="error">
                        <div class="msg">{{ $errors->first('password') }}</div>
                    </div>
                @endif
            </div>
            <div class="cb"></div>
        </div>
        <div class="fb">
            <div class="description">Повторить пароль:</div>
            <div class="date">
                <input class="w100{{ $errors->has('repassword') ? ' err' : '' }}" type="password" name="password_confirmation" value="" />
            </div>
            <div class="cb"></div>
        </div>
        <div class="fbcaptaha">
            <div class="description">Код подтверждения:</div>
            <div class= "image">
                <img id="captchaDiv" src="{{ url('account/makecaptcha') }}" alt="" />
                <img id="refresh" src="{{ asset('images/refresh.gif') }}" alt="" />
            </div>
            <div class="date">
                <input class="w100{{ $errors->has('key') ? ' err' : '' }}" type="text" name="key" value="" />
                @if ($errors->has('key'))
                    <div class="error">
                        <div class="msg">{{ $errors->first('key') }}</div>
                    </div>
                @endif
            </div>
            <div class="cb"></div>
        </div>
        
        
        <div class="submit">
            <input class="btn" type="submit" value="Сохранить">
        </div> 
    </form>
</div>
    <script type="text/javascript">
        $('#refresh').click(function(){ 
                $('#captchaDiv').attr('src', '{{ url("account/makecaptcha") }}?r='+Math.random());
        });
    </script> 

@endsection 
