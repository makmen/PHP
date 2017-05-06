<h3 class="register">{if $mode =='add'}Регистрация {if !isset($_SESSION['group'])}пользователя{else}администратора{/if}{else}Изменение данных пользователя{/if}</h3>
{if $errs['message']} 
	<div class="mess-top">
		<div class="error"><div class="msg">{$errs['message']}</div></div>
	</div>
{/if}
{if isset($reg_ok)}
	<div class="mess-top">
		<div class="fbok">
			<div class="success">{if $mode =='add'}Регистрация завершена успешно{else}Данные сохранены{/if}</div>
		</div>
	</div>
{else}
<div>
	<form id="register" method="post" action="">
		<div class="fb">
			<div class="description">Имя:</div>
			<div class="date">
				<input class="w100{if isset($errs['name'])} err{/if}" type="text" name="name" value="{$name}" />
				{if isset($errs['name'])}
					<div class="error">
						<div class="msg">{$errs['name']}</div>
					</div>
				{/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">Отчество:</div>
			<div class="date">
				<input class="w100{if isset($errs['middlename'])} err{/if}" type="text" name="middlename" value="{$middlename}" />
				{if isset($errs['middlename'])}
					<div class="error">
						<div class="msg">{$errs['middlename']}</div>
					</div>
				{/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">Фамилия:</div>
			<div class="date">
				<input class="w100{if isset($errs['lastname'])} err{/if}" type="text" name="lastname" value="{$lastname}" />
				{if isset($errs['lastname'])}
					<div class="error">
						<div class="msg">{$errs['lastname']}</div>
					</div>
				{/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">E-mail:</div>
			<div class="date">
                            <input class="w100{if isset($errs['email'])} err{/if}" type="text" name="email" value="{$email}" />
                            {if isset($errs['email'])}
                                <div class="error">
                                    <div class="msg">{$errs['email']}</div>
                                </div>
                            {/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">Телефон:</div>
			<div class="date">
				<input class="w100{if isset($errs['phone'])} err{/if}" type="text" name="phone" value="{$phone}" />
			{if isset($errs['phone'])}
				<div class="error">
					<div class="msg">{$errs['phone']}</div>
				</div>
			{/if}
			</div>
			<div class="cb"></div>
		</div>
		{if $mode =='add'}
		<div class="fb">
			<div class="description">Логин:</div>
			<div class="date">
				<input class="w100{if isset($errs['login'])} err{/if}" type="text" name="login" value="{$login}" />
				{if isset($errs['login'])}
					<div class="error">
						<div class="msg">{$errs['login']}</div>
					</div>
				{/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">Пароль:</div>
			<div class="date"><input class="w100{if isset($errs['pass'])} err{/if}" type="password" name="pass" value="{$pass}" />
			{if isset($errs['pass'])}
				<div class="error">
					<div class="msg">{$errs['pass']}</div>
				</div>
			{/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">Повторить пароль:</div>
			<div class="date"><input class="w100{if isset($errs['repass'])} err{/if}" type="password" name="repass" value="{$repass}" />
			{if isset($errs['repass'])}
				<div class="error">
					<div class="msg">{$errs['repass']}</div>
				</div>
			{/if}
			</div>
			<div class="cb"></div>
		</div>
                    {if !isset($_SESSION['group'])}
                        <div class="fbcaptaha">
                            <div class="description">Код подтверждения:</div>
                            <div class= "image">
                                    <img id="captchaDiv" src="{url account makecaptcha}" alt="" />
                                    <img id="refresh" src="{uri 'images/refresh.gif'}" alt="" />
                            </div>
                            <div class="date"><input class="w100{if isset($errs['key'])} err{/if}" type="text" name="key" value="{$key}" />
                            {if isset($errs['key'])}
                                    <div class="error">
                                            <div class="msg">{$errs['key']}</div>
                                    </div>
                            {/if}
                            </div>
                            <div class="cb"></div>
                        </div>
                    {/if} 
		{/if} 
		<div class="submit {if $mode =='edit'}news{/if} ">
			 <input class="btn" type="submit" value="Сохранить">
		</div> 
	</form>
</div>
    {if !isset($_SESSION['group'])}
    <script type="text/javascript">
        $('#refresh').click(function(){ 
                $('#captchaDiv').attr('src', '{url account makecaptcha}?r='+Math.random());
        });
    </script> 
    {/if}
    <script type="text/javascript">
        $(function(){  
            $('input[name=email]').change(function() { 
                var url = "{url account checkmail}";
                $.ajax({ type: "POST", url: url, data: { "email": $(this).val() },
                success: function(res) { 
                    var item = $('input[name=email]');
                    if (res == 'ok') {  
                        item.removeClass('err');
                        $('div.date:has(input[name=email]) > div.error').remove();
                    } else if (res) {  
                        item.addClass('err');
                        $('div.date:has(input[name=email]) > div.error').remove();
                        item.after('<div class="error"><div class="msg">' + res + '</div></div>');
                    } else { 

                    }
                }
                });
            });
        });
    </script> 
{/if}
