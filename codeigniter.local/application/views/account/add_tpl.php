<? if(isset($errs["message"])):?>
    <div class="mess-top">
        <div class="error"><div class="msg"><?= $this->out["errs"]["message"]?></div></div>
    </div>
<? endif;?>

<? if(isset($success)):?>
<div class="mess-top">
    <div class="fbok">
        <div class="success">
            <? if($mode == "add"):?>Регистрация завершена успешно<? else:?>Данные сохранены<? endif;?>
        </div>
    </div>
</div>
<? endif;?>
<div>
    <form id="register" method="post" action="">
    <ol>
      <li>
          <label for="name">name</label>
          <input id="name" name="name" class="text<? if (isset($errs['name'])):?> err<?endif;?>" type="text" value="<? if (isset($name)):?><?= $name?><?endif;?>" />
          <? if (isset($errs['name'])):?>
            <div class="error">
                <div class="msg"><?= $errs['name']?></div>
            </div>
          <? endif;?>
      </li>
      <li>
          <label for="email">Email Address</label>
          <input id="email" name="email" class="text<? if (isset($errs['email'])):?> err<?endif;?>" type="text" value="<? if (isset($email)):?><?= $email?><?endif;?>" />
          <? if (isset($errs['email'])):?>
            <div class="error">
                <div class="msg"><?= $errs['email']?></div>
            </div>
          <? endif;?>
      </li>
      
<? if ($mode == "add"):?>
      <li>
          <label for="login">Login</label>
          <input id="login" name="login" class="text<? if (isset($errs['login'])):?> err<?endif;?>" type="text" value="<? if (isset($login)):?><?= $login?><?endif;?>" />
            <? if (isset($errs['login'])):?>
            <div class="error">
                <div class="msg"><?= $errs['login']?></div>
            </div>
            <? endif;?>
      </li>
      <li>
          <label for="password">Password</label>
          <input id="password" name="password" class="text<? if (isset($errs['password'])):?> err<?endif;?>" type="password" value="" />
          <? if (isset($errs['password'])):?>
            <div class="error">
                <div class="msg"><?= $errs['password']?></div>
            </div>
          <? endif;?>
      </li>
      <li>
          <label for="repass">Repeat password:</label>
          <input id="repass" name="repass" class="text<? if (isset($errs['repass'])):?> err<?endif;?>" type="password" value="" />
          <? if (isset($errs['repass'])):?>
            <div class="error">
                <div class="msg"><?= $errs['repass']?></div>
            </div>
          <? endif;?>
      </li>
      <li>
          <label for="key">Enter key:</label>
            <div class= "image">
                <img id="captchaDiv" src="/account/makecaptcha" alt="" />
                <img id="refresh" src="/images/refresh.gif" alt="" />
            </div>
          <input id="key" name="key" class="text<? if (isset($errs['key'])):?> err<?endif;?>" type="text" value="<? if (isset($key)):?><?= $key?><?endif;?>" />
          <? if (isset($errs['key'])):?>
            <div class="error">
                <div class="msg"><?= $errs['key']?></div>
            </div>
          <? endif;?>
      </li>
<? endif;?>
      
      <li>
          <input type="submit" name="imageField" id="imageField" src="/images/submit.gif" class="send" />
      </li>
       <div class="clr"></div>
    </ol>

    </form>
</div>
    <? if ($mode == "add"):?>
    <script type="text/javascript">
        $('#refresh').click(function(){ 
            $('#captchaDiv').attr('src', '/account/makecaptcha?r='+Math.random());
        });
    </script> 
    <? endif;?>

