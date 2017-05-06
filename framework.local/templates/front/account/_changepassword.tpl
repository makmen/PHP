<h3 class="register">Изменить пароль</h3>
{if $errs['message']} 
	<div class="mess-top">
		<div class="error"><div class="msg">{$errs['message']}</div></div>
	</div>
{/if}
{if isset($reg_ok)}
	<div class="mess-top">
		<div class="fbok">
			<div class="success">Пароль был изменён</div>
		</div>
	</div>
{else}
<div>
	<form id="register" method="post" action="">
		<div class="fb">
			<div class="description">Старый пароль:</div>
			<div class="date">
				<input class="w100{if isset($errs['oldpass'])} err{/if}" type="password" name="oldpass" value="{$oldpass}" />
				{if isset($errs['oldpass'])}
					<div class="error">
						<div class="msg">{$errs['oldpass']}</div>
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
		<div class="submit news">
			 <input class="btn" type="submit" value="Сохранить">
		</div> 
	</form>
</div>


{/if}
