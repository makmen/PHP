@if (Auth::check())
    <div class="ambitios_grid_7 ambitios_alpha">
        <h1 class="ambitios_uppercase user">Добрый день, {{ Auth::user()->name }} </h1>
    </div>
    <div class="cb"></div>
@else
<form method="POST" action="/auth/login"  class="cmxform">

    {!! csrf_field() !!}

    <div class="account">
       <div class="ambitios_login">
           <label for="login">Логин:</label>
           <input name="login" class="ambitios_input" type="text" />
       </div>
       <div class="ambitios_password">
           <label for="password">Пароль:</label>
           <input name="password" class="ambitios_input" type="password" />
       </div>
       <div class="ambitios_submit">
           <input name="logIn" value="1" type="hidden">
           <input type="submit" class="submit_button" value="Войти" name="lk" />
       </div>
       <div class="cb"></div>

       <div class="errorlogin">&nbsp;<span @if (!isset($out['checkfalse'])) style="display:none;" @endif>Не верный логин или пароль</span></div>
        <div class="register">
            <a href="/auth/register">Регистрация</a>
        </div>
        <div class="forget">
            <a href="{url account forget}">Забыли пароль</a>
        </div>
        <div class="cb"></div>
    </div>
</form>
@endif
