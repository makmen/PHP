<div id="contact-details">
  <h3 class="title">Get In Touch</h3>
  <div class="post">
    <p>Please use the form on this page to discuss the possibility of working with us or contact us directly via phone or email.</p>
  </div>
  <h3>Contact Details</h3>
  <h4>Phone: <span>+44 (0) 1234 567 890</span></h4>
  <h4>Fax: <span>+44 (0) 1234 567 890</span></h4>
  <h4>Email: <span>info@akono.com</span></h4>
</div>
<!--end contact-details-->
<div id="contact-form-container">
  <form class="ak-form" method="post" action="">
    <fieldset>
      <?php if ( isset($ok) ) :?>  
        <div class="alertbox success-box">
            <?= $ok?>
        </div>
      <?php endif; ?>
        
      <?php if ( isset($errors) &&  count($errors) >0 ) :?>  
        <?= $allErrors?>
      <?php endif; ?>
      
      <input id="form_name" class="<?php echo (isset($errors['name']) ? 'err' : ''); ?>" type="text" name="name" value="<?php echo $user->name??'Name'; ?>" onFocus="if(this.value=='Name'){this.value=''};" onBlur="if(this.value==''){this.value='Name'};" />
      <input id="form_login" class="<?php echo (isset($errors['login']) ? 'err' : ''); ?>" type="text" name="login" value="<?php echo $user->login??'Login'; ?>" onFocus="if(this.value=='Login'){this.value=''};" onBlur="if(this.value==''){this.value='Login'};" />
      <input id="form_email" class="<?php echo (isset($errors['email']) ? 'err' : ''); ?>" type="text" name="email" value="<?php echo $user->email??'Email'; ?>" onFocus="if(this.value=='Email'){this.value=''};" onBlur="if(this.value==''){this.value='Email'};" />

      <?php if ( $canWordWithUsers ) : ?>  
      <div>
          <p>Роль пользователя</p>
        <select class="w50" name="role">
            <?php foreach($roles as $k=>$v): ?>
                <option value="<?= $k ?>" <?php if ($k == $user->role_id) : ?>selected<?php endif?>  ><?= $v['name'] ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>
      
      <?php if ( URL::$action == 'register' || (URL::$action == 'edit' && $owner) ) : ?>  

        <input id="form_password" class="<?php echo (isset($errors['password']) ? 'err' : ''); ?>" type="password" name="password" value="Password" onFocus="if(this.value=='Password'){this.value=''};" onBlur="if(this.value==''){this.value='Password'};" />
        <input id="form_repassword" class="<?php echo (isset($errors['repassword']) ? 'err' : ''); ?>" type="password" name="repassword" value="RePassword" onFocus="if(this.value=='RePassword'){this.value=''};" onBlur="if(this.value==''){this.value='RePassword'};" />
      
      <?php endif; ?>
      
      <?php if ( URL::$action == 'register' && !$canWordWithUsers ) : ?>  
        <div>
            <label for="captcha">Введите код с картинки:</label>
            <input type="text" name="captcha" class="<?php echo (isset($errors['captcha']) ? 'err' : ''); ?>"  />
        </div>
        <div class="captcha">
            <img class="refresh" src="/images/refresh.gif" alt="Обновить" />
            <img id="captcha" src="/captcha.php" alt="Капча" />
        </div>
      
        <script type="text/javascript">
            $('img.refresh').click(function(){ 
                $('#captcha').attr('src', '/captcha.php?r='+Math.random());
            });
        </script> 
      <?php endif; ?>
      
      <input id="form_submit" class="submit" type="submit" name="submit" value="Submit &raquo;" />
    </fieldset>
  </form>
</div>
<!--end contact-form-container-->