<h3 class="register">Восстановление пороля</h3>
{if $errs['message']} 
	<div class="mess-top">
		<div class="error"><div class="msg">{$errs['message']}</div></div>
	</div>
{/if}
{if isset($reg_ok)}
	<div class="mess-top">
		<div class="fbok">
			<div class="success">Письмо отправлено</div>
		</div>
	</div>
{else}
<div>
	<form id="register" method="post" action="">
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
		<div class="submit">
			 <input class="btn" type="submit" value="Отправить">
		</div> 
	</form>
</div>

<script type="text/javascript">
	$('#refresh').click(function(){ 
		$('#captchaDiv').attr('src', '{url account makecaptcha}?r='+Math.random());
	});
</script> 
{/if}
