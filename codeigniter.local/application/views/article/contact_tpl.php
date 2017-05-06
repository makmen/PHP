<div class="article">
  <h2><span>Contact</span></h2><div class="clr"></div>
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
    <ol><li>
      <label for="name">Name (required)</label>
      <input id="name" name="name" class="text<? if (isset($errs['name'])):?> err<?endif;?>" type="text" value="<? if (isset($name)):?><?= $name?><? else:?><?endif;?>" />
    </li><li>
      <label for="email">Email Address (required)</label>
      <input id="email" name="email" class="text<? if (isset($errs['email'])):?> err<?endif;?>" type="text" value="<? if (isset($email)):?><?= $email?><? else:?><?endif;?>" />
    </li><li>
      <label for="message">Your Message</label>
      <textarea id="message" name="message" class="<? if (isset($errs['message'])):?> err<?endif;?>" rows="8" cols="50"><? if (isset($message)):?><?= $message?><? else:?><?endif;?></textarea>
    </li><li>
      <input type="image" name="imageField" src="/images/submit.gif" class="send" />
      <div class="clr"></div>
    </li></ol>
  </form>
</div>