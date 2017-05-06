<?php
    if ($this->out["errs"]["message"]) {
?>
    <div class="mess-top">
        <div class="error"><div class="msg"><?= $this->out["errs"]["message"]?></div></div>
    </div>
<?php } ?> 
<?php
    if (isset($this->out["reg_ok"])) {
?>
    <div class="mess-top">
        <div class="fbok">
            <div class="success">
                <?php
                    if ($this->out["mode"] == 'add') {
                        echo "Регистрация завершена успешно";
                    } else {
                        echo "Данные сохранены";
                    }
                ?>
            </div>
        </div>
    </div>
<?php } ?>
<div>
    <form id="register" method="post" action="">
    <ol>
      <li>
          <label for="name">Name</label>
          <input id="name" name="name" class="text<?php if (isset($this->out['errs']['name'])) { echo ' err'; } ?>" type="text" value="<? echo $this->out['name']; ?>" />
          <?php
            if (isset($this->out['errs']['name'])) {
          ?>
            <div class="error">
                <div class="msg"><?= $this->out['errs']['name']?></div>
            </div>
          <?php
            }
          ?>
      </li>
      <li>
          <label for="middlename">Middlename</label>
          <input id="middlename" name="middlename" class="text<?php if (isset($this->out['errs']['middlename'])) { echo ' err'; } ?>" type="text" value="<? echo $this->out['middlename']; ?>" />
          <?php
            if (isset($this->out['errs']['middlename'])) {
          ?>
            <div class="error">
                <div class="msg"><?= $this->out['errs']['middlename']?></div>
            </div>
          <?php
            }
          ?>
      </li>
      <li>
          <label for="lastname">Lastname</label>
          <input id="lastname" name="lastname" class="text<?php if (isset($this->out['errs']['lastname'])) { echo ' err'; } ?>" type="text" value="<? echo $this->out['lastname']; ?>" />
          <?php
            if (isset($this->out['errs']['lastname'])) {
          ?>
            <div class="error">
                <div class="msg"><?= $this->out['errs']['lastname']?></div>
            </div>
          <?php
            }
          ?>
      </li>
      <li>
          <label for="email">Email Address</label>
          <input id="email" name="email" class="text<?php if (isset($this->out['errs']['email'])) { echo ' err'; } ?>" type="text" value="<? echo $this->out['email']; ?>" />
          <?php
            if (isset($this->out['errs']['email'])) {
          ?>
            <div class="error">
                <div class="msg"><?= $this->out['errs']['email']?></div>
            </div>
          <?php
            }
          ?>
      </li>
      <li>
          <label for="phone">Phone</label>
          <input id="phone" name="phone" class="text" type="text" value="<? echo $this->out['phone']; ?>" />
      </li>
<?php
    if ($this->out['mode'] == 'add') {
?>
      <li>
          <label for="login">Login</label>
          <input id="login" name="login" class="text<?php if (isset($this->out['errs']['login'])) { echo ' err'; } ?>" type="text" value="<? echo $this->out['login']; ?>" />
          <?php
            if (isset($this->out['errs']['login'])) {
          ?>
            <div class="error">
                <div class="msg"><?= $this->out['errs']['login']?></div>
            </div>
          <?php
            }
          ?>
      </li>
      <li>
          <label for="password">Password</label>
          <input id="password" name="password" class="text<?php if (isset($this->out['errs']['password'])) { echo ' err'; } ?>" type="password" value="<? echo $this->out['password']; ?>" />
          <?php
            if (isset($this->out['errs']['password'])) {
          ?>
            <div class="error">
                <div class="msg"><?= $this->out['errs']['password']?></div>
            </div>
          <?php } ?>
      </li>
      <li>
          <label for="repass">Repeat password:</label>
          <input id="repass" name="repass" class="text<?php if (isset($this->out['errs']['repass'])) { echo ' err'; } ?>" type="password" value="<? echo $this->out['repass']; ?>" />
          <?php
            if (isset($this->out['errs']['repass'])) {
          ?>
            <div class="error">
                <div class="msg"><?= $this->out['errs']['repass']?></div>
            </div>
          <?php
            }
          ?>
      </li>
      <li>
          <label for="key">Enter key:</label>
            <div class= "image">
                <img id="captchaDiv" src="<?= SERVER_ROOT?>account/makecaptcha" alt="" />
                <img id="refresh" src="<?= SERVER_ROOT?>images/refresh.gif" alt="" />
            </div>
          <input id="key" name="key" class="text<?php if (isset($this->out['errs']['key'])) { echo ' err'; } ?>" type="text" value="<? echo $this->out['key']; ?>" />
          <?php
            if (isset($this->out['errs']['key'])) {
          ?>
            <div class="error">
                <div class="msg"><?= $this->out['errs']['key']?></div>
            </div>
          <?php
            }
          ?>
      </li>
<?php } ?>
      <li>
          <input type="submit" name="imageField" id="imageField" src="<?= SERVER_ROOT?>images/submit.gif" class="send" />
      </li>
       <div class="clr"></div>
    </ol>

    </form>
</div>
    <?php
        if ($this->out['mode'] == 'add') {
    ?>
    <script type="text/javascript">
        $('#refresh').click(function(){ 
            $('#captchaDiv').attr('src', '<?= SERVER_ROOT?>account/makecaptcha?r='+Math.random());
        });
    </script> 
    <?php } ?>

