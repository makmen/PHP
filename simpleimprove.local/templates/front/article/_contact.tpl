<div class="article">
  <h2><span>Send us</span> mail</h2>
  <div class="clr"></div>
    <?php
        if ($this->out["errs"]["sendError"]) {
    ?>
        <div class="mess-top">
            <div class="error">
                <div class="msg"><? echo $this->out['errs']['sendError']; ?></div>
            </div>
        </div>
    <?php
        } elseif ($this->out["sendSuccess"]) {
    ?>    
        <div class="mess-top">
            <div class="fbok">
                <div class="success">Письмо отправлено</div>
            </div>
        </div>
    <?php
       }
    ?>
  <form action="" method="post" id="sendemail">
  <ol>
    <li>
        <label for="name">Name (required)</label>
        <input id="name" name="name" class="text<?php if (isset($this->out['errs']['name'])) { echo ' err'; } ?>" type="text" value="<? echo $this->out['name']; ?>" />
    </li>
    <li>
        <label for="email">Email Address (required)</label>
        <input id="email" name="email" class="text<?php if (isset($this->out['errs']['email'])) { echo ' err'; } ?>" type="text" value="<? echo $this->out['email']; ?>" />
    </li>
    <li>
        <label for="message">Your Message</label>
        <textarea id="message" name="message" class="<?php if (isset($this->out['errs']['message'])) { echo 'err'; } ?>" rows="8" cols="50"><? echo $this->out['message']; ?></textarea>
    </li>
    <li>
        <input type="image" name="imageField" id="imageField" src="<?= SERVER_ROOT?>images/submit.gif" class="send" />
        <div class="clr"></div>
    </li>
  </ol>
  </form>
</div>