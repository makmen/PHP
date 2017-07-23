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
      <input id="form_login" type="text" name="auth_login" value="Name" onFocus="if(this.value=='Name'){this.value=''};" onBlur="if(this.value==''){this.value='Name'};" />
      <input id="form_password" type="password" name="auth_password" value="Password" onFocus="if(this.value=='Password'){this.value=''};" onBlur="if(this.value==''){this.value='Password'};" />
      <p><a href="<?= URL::buildUrl('auth', 'register') ?>">Регистрация</a></p> 
      <p><a href="<?= URL::buildUrl('auth', 'forget') ?>">Забыли пароль</a></p>
      <?php if (isset($loginError)): ?>
        <p class="error-p"><?= $loginError ?></p>
      <?php endif; ?>
      <input id="form_submit" class="submit" type="submit" name="submit" value="Submit &raquo;" />
    </fieldset>
  </form>
</div>
<!--end contact-form-container-->