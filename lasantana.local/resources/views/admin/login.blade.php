@extends( 'layouts.main' )

@section('navigation')
{!! $navigation !!}
@endsection

@section('content')
<div class="main-container col1-layout"> 
    <!--Start of Home Content-->
    <div class="main">
        <div class="col-main">
            <div class="std"> 

                <div class="box-center">
                    <div id="messages_product_view"></div>
                    <!--Page Title-->
                    <div class="page-title">
                        <h1>Contact Us</h1>
                    </div>

                    <!--Start of Login Form-->
                    <form id="loginForm" method="post" action="{{ url('/login') }}">
                        <div class="fieldset">
                            <h2 class="legend">Авторизация пользователя</h2>
                            <ul class="form-list">
                                <li class="fields">
                                    <div class="field">
                                        <label for="login" class="required"><em>*</em>Логин</label>
                                        <div class="input-box">
                                            <input name="login" id="login" class="input-text {{ ($errors->has('login') ? ' error' : '') }}" type="text" value="{{ old('login') }}" />
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <label for="password">Пароль</label>
                                    <div class="input-box">
                                        <input name="password" id="password" class="input-text required" type="password" />
                                    </div>
                                </li>
                            </ul>
                            
                            @if ( count($errors) > 0 )
                                <p class="error-left">{{ Lang::get('auth.failed') }}</p>
                            @endif
                            
                        </div>
                        <div class="buttons-set-login">
                            {{ csrf_field() }}
                            <button type="submit" title="Submit" class="button"><span><span>Submit</span></span></button>
                        </div>
                    </form>
                    <!--End of Login Form--> 
                </div>
            </div>
        </div>
    </div>

    <div style="display: none;" id="back-top"> <a href="#"><img alt="" src="{{ asset('images/backtop.gif') }}" /></a> </div>
</div>

@endsection

