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
    
    <?php if ( isset($error) ) :?>  
      <div class="alertbox error-box">
          <?= $error?>
      </div>
    <?php endif; ?>
        
      <?php if ( isset($errors) &&  count($errors) >0 ) :?>  
        <?= $allErrors?>
      <?php endif; ?>
      
      <input id="form_email" class="<?php echo (isset($errors['email']) ? 'err' : ''); ?>" type="text" name="email" value="<?php echo $forget->email??'Email'; ?>" onFocus="if(this.value=='Email'){this.value=''};" onBlur="if(this.value==''){this.value='Email'};" />
        
        <div>
            <label for="captcha">Введите код с картинки:</label>
            <input type="text" name="captcha" class="<?php echo (isset($errors['captcha']) ? 'err' : ''); ?>"  />
        </div>
        <div class="captcha">
            <img class="refresh" src="/images/refresh.gif" alt="Обновить" />
            <img id="captcha" src="/captcha.php" alt="Капча" />
        </div>
        
      <input id="form_submit" class="submit" type="submit" name="submit" value="Submit &raquo;" />
    </fieldset>
  </form>
      
<script type="text/javascript">
    $('img.refresh').click(function(){ 
        $('#captcha').attr('src', '/captcha.php?r='+Math.random());
    });
</script> 
      
</div>
<!--end contact-form-container-->