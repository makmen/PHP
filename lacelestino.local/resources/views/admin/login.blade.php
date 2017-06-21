@extends( 'layouts.main' )

@section('navigation')
    {!! $navigation !!}
@endsection

@section('content')
<div id="content-page" class="span12 content group">
    <div class="page type-page status-publish hentry group">
        <h3>Авторизация пользователя</h3>
        <p>&nbsp;</p>
        <form id="login-form" class="contact-form row" method="POST" action="{{ url('/login') }}">
            <div class="usermessagea"></div>
            {{ csrf_field() }}
            <fieldset>
                <ul>
                    <li class="text-field span6">
                        <label for="login">
                            <span class="mainlabel">Login</span>
                        </label>
                        <div class="input-prepend">
                            <span class="add-on">
                                <i class="icon-user"></i>
                            </span>
                            <input type="text" name="login" id="login" class="required {{ count($errors) > 0 ? ' error' : '' }}" value="{{ old('login') }}" />

                        </div>
                        <div class="msg-error">
                            @if ( count($errors) > 0 ){{ Lang::get('auth.failed') }}@endif
                        </div>
                        <div class="clear"></div>
                    </li>

                    <li class="span6 text-field">
                        <label for="password-contact-form">
                            <span class="mainlabel">Password</span>
                        </label>
                        <div class="input-prepend">
                            <span class="add-on">
                                <i class="icon-bookmark"></i>
                            </span>
                            <input type="password" name="password" id="password-contact-form"  class="required" value="" />
                        </div>

                        <div class="msg-error"></div>
                        <div class="clear"></div>
                    </li>

                    <li class="submit-button span7">
                        <div class="input-prepend">
                            <input type="submit" id="signin" name="signin" value="Login " class="sendmail alignright" />
                        </div>
                        <div class="clear"></div>
                    </li>
                </ul>
            </fieldset>
        </form>

        <script type="text/javascript">
            var messages_form_3 = {
                login: "Insert the name",
                password: "Insert a valid email"
            };
        </script>

    </div>


</div>
<div class="clear"></div>

@endsection

