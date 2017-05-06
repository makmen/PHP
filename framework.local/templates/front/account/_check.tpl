{if isset($_SESSION['login'])}
    <div class="ambitios_grid_7 ambitios_alpha">
        <h1 class="ambitios_uppercase user">Добрый день, {$_SESSION['name']} {$_SESSION['middlename']} {$_SESSION['lastname']}</h1>
    </div>
    <div class="cb"></div>
    <div>Вы вошли, как {if $_SESSION['group'] == 1}Администратор{else}Пользователь{/if}</div>
{else}
<form action="{url $module $template}" method="post"  class="cmxform">
<div class="account">
   <div class="ambitios_login">
       <label for="formlogin">Логин:</label>
       <input name="formlogin" class="ambitios_input" type="text" />
   </div>
   <div class="ambitios_password">
       <label for="formpassword">Пароль:</label>
       <input name="formpassword" class="ambitios_input" type="password" />
   </div>
   <div class="ambitios_submit">
       <input name="logIn" value="1" type="hidden">
       <input type="submit" class="submit_button" value="Войти" name="lk" />
   </div>
   <div class="cb"></div>
   <div class="errorlogin">&nbsp;<span {if $checkfalse == false}style="display:none;"{/if}>Не верный логин или пароль</span></div>
    <div class="register">
        <a href="{url account}">Регистрация</a>
    </div>
    <div class="forget">
        <a href="{url account forget}">Забыли пароль</a>
    </div>
    <div class="cb"></div>
</div>
</form>
{/if}