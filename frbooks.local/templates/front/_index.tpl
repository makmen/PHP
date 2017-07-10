<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title><? echo $this->out["title"]; ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link href="<?= SERVER_ROOT?>css/reset.css" rel="stylesheet">
    <link href="<?= SERVER_ROOT?>css/style.css" rel="stylesheet">
    <!--[if IE]><link rel="stylesheet" type="text/css" media="screen,projection" href="css/ie6.css" /><![endif]-->
    <script type="text/javascript" src="<?= SERVER_ROOT?>js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="<?= SERVER_ROOT?>js/script.js"></script> 
    <script type="text/javascript" src="<?= SERVER_ROOT?>js/cufon-yui.js"></script>
    <script type="text/javascript" src="<?= SERVER_ROOT?>js/arial.js"></script> 
</head>
<body>
<div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
        <h1><a href="<?= SERVER_ROOT?>">Venti<span>x</span><small>Simple web template</small></a></h1>
      </div>

        <? echo $this->run("account", "check"); ?>

        <? include 'menu.tpl'; ?>
        
      <div class="clr"></div>
      <div class="hbg"><img src="<?= SERVER_ROOT?>images/header_images.jpg" width="946" height="268" alt="header images" /></div>
    </div>
    <div class="content">
      <div class="content_bg">
        <div class="mainbar">
            <? if ($this->out["module"] == ''):?>
            <div class="article">
              <h2><span>Support to</span> Company Name</h2><div class="clr"></div>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Suspendisse nulla ligula, blandit ultricies aliquet ac, lobortis in massa. Nunc dolor sem, tincidunt vitae viverra in, egestas sed lacus.</strong> Etiam in ullamcorper felis. Nulla cursus feugiat leo, ut dictum metus semper a. Vivamus euismod, arcu gravida sollicitudin vestibulum, quam sem tempus quam, quis ullamcorper erat nunc in massa. Donec aliquet ante non diam sollicitudin quis auctor velit sodales. Morbi neque est, posuere at fringilla non, mollis nec nibh. Sed commodo tortor nec sem tincidunt mattis. Nam convallis aliquam nibh eu luctus. Nunc vel tincidunt lacus. Suspendisse sit amet pulvinar ante.</p>
              <p>Phasellus diam justo, laoreet vel vulputate eu, congue vel est. Maecenas eros libero, sollicitudin a vulputate fermentum, ultrices vel lacus. Nam in metus non augue fermentum consequat ultrices ac enim. Integer aliquam urna non diam aliquam eget hendrerit sem molestie.</p>
              <p><strong>Lorem ipsum dolor sit amet</strong></p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget bibendum tellus. Nunc vel imperdiet tellus. Mauris ornare aliquam urna, accumsan bibendum eros auctor ac.</p>
              <ul class="sb_menu">
                <li><a href="#"><strong>Lorem ipsum</strong></a></li>
                <li><a href="#"><strong>Lorem ipsum</strong></a></li>
                <li><a href="#"><strong>Lorem ipsum</strong></a></li>
                <li><a href="#"><strong>Lorem ipsum</strong></a></li>
                <li><a href="#"><strong>Lorem ipsum</strong></a></li>
                <li><a href="#"><strong>Lorem ipsum</strong></a></li>
              </ul>
            </div>
            <?else:?>
                <?= $this->out["modulecontent"]?>
            <?endif;?>
        </div>
        <div class="sidebar">
          <div class="gadget">
            <h2><span>Sponsors</span></h2>
            <div class="clr"></div>
            <ul class="ex_menu">
              <li class="active"><a href="http://www.dreamtemplate.com" title="Website Templates">DreamTemplate</a> <span>Over 6,000+ Premium Web Templates</span></li>
              <li><a href="http://www.templatesold.com" title="WordPress Themes">TemplateSOLD</a> <span>Premium WordPress &amp; Joomla Themes</span></li>
              <li><a href="http://www.imhosted.com" title="Affordable Hosting">ImHosted.com</a> <span>Affordable Web Hosting Provider</span></li>
              <li><a href="http://www.dreamstock.com/">DreamStock</a> <span>Unlimited Amazing Stock Photos</span></li>
              <li><a href="http://www.evrsoft.com" title="Website Builder">Evrsoft</a> <span>Website Builder Software &amp; Tools</span></li>
              <li><a href="http://www.csshub.com/" title="CSS Templates">CSS Hub</a> <span>Premium CSS Templates</span></li>
            </ul>
          </div>
        </div>
        <div class="clr"></div>
      </div>
    </div>
  </div>
  <div class="fbg">
    <div class="fbg_resize">
      <div class="col c1">
        <h2><span>Image Gallery</span></h2>
        <a href="#"><img src="<?= SERVER_ROOT?>images/pic_1.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="<?= SERVER_ROOT?>images/pic_2.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="<?= SERVER_ROOT?>images/pic_3.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="<?= SERVER_ROOT?>images/pic_4.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="<?= SERVER_ROOT?>images/pic_5.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="<?= SERVER_ROOT?>images/pic_6.jpg" width="58" height="58" alt="pix" /></a> </div>
      <div class="col c2">
        <h2><span>Lorem Ipsum</span></h2>
        <p>Lorem ipsum dolor<br />
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam</a>, lectus turpis varius lorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam.</p>
      </div>
      <div class="col c3">
        <h2><span>Contact</span></h2>
        <p>Nullam quam lorem, tristique non vestibulum nec, consectetur in risus. Aliquam a quam vel leo gravida gravida eu porttitor dui. Nulla pharetra, mauris vitae interdum dignissim, justo nunc suscipit ipsum. <br />
          <a href="mail@example.com">mail@example.com</a><br />
          +1 (123) 444-5677</p>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="clr"></div>
</div>
<div class="footer">
  <div class="footer_resize">
    <p class="lf">© Copyright <a href="#">MyWebSite</a>.</p>
    <p class="rf">Layout by Cool <a href="http://www.coolwebtemplates.net/">Website Templates</a></p>
    <div class="clr"></div>
  </div>
</div>
</body>
</body>
</html>