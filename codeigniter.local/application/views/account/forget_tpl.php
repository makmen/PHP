<div class="article">
  <h2><span>Forget password</span></h2><div class="clr"></div>
  <p>You can find more of my free template designs at my website. For premium commercial designs, you can check out DreamTemplate.com.</p>
</div>
<div class="article">
    <h2><span>Send us</span> mail</h2><div class="clr"></div>
    <? if(isset($errs["sendError"])):?>
        <div class="mess-top">
            <div class="error">
                <div class="msg"><?=$errs['sendError']?></div>
            </div>
        </div>
    <? elseif (isset($sendSuccess)):?>
        <div class="mess-top">
            <div class="fbok">
                <div class="success">Письмо отправлено</div>
            </div>
        </div>
    <? else:?>

    <? endif;?>

  <form action="" method="post" id="sendemail">
    <ol>
    <li>
      <label for="email">Email Address (required)</label>
      <input id="email" name="email" class="text<? if (isset($errs['email'])):?> err<?endif;?>" type="text" value="<? if (isset($email)):?><?= $email?><? else:?><?endif;?>" />
            <? if (isset($errs['email'])):?>
            <div class="error">
                <div class="msg"><?= $errs['email']?></div>
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
    <li>
      <input type="image" name="imageField" src="/images/submit.gif" class="send" />
      <div class="clr"></div>
    </li></ol>
  </form>
</div>
    <script type="text/javascript">
        $('#refresh').click(function(){ 
            $('#captchaDiv').attr('src', '/account/makecaptcha?r='+Math.random());
        });
    </script> 