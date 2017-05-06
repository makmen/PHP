<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>CoolWebTemplates.net</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="/css/reset.css" rel="stylesheet" type="text/css" />
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/css/prettyPhoto.css" type="text/css"/>
    <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
</head>
<body>
<div class="line">
    <div class="block_top_text">
        <p>Number one in business</p>
    </div>
    <div class="block_top_lnks">
        <? if (!isset($this->session->userdata['login'])):?>
        <ul>
            <li>
                <p>Login:</p>
                <input type="text" class="w_focus" name="reglogin" />
            </li>
            <li>
                <p>Password:</p>
                <input type="password" class="w_focus" name="regpassword" />
            </li>
            <li>
                <input id="singin" class="sign" name="imageField" src="/images/submit.gif" type="image">
            </li>
        </ul>
        <div class="clr"></div>
        <p class="loginerror">&nbsp;<span>Не верный логин или пароль</span></p>
        <?else:?>
        <div class='greetings'>
            <p>Добрый день, <?= $this->session->userdata['login']?>
                <span class="signout"><a href="/account/signout">Signout</a></span>
            </p>
        </div>
        <?endif;?>
    </div>
    <div class="clr"></div>
</div>
<div class="main">
  <div class="header">
    <div class="logo">
      <h1><a href="/"><span>biz</span> solution<small>Simple web template</small></a></h1>
    </div>
    <div class="menu_nav">
      <ul>
        <li<? if ($this->router->class == 'article' && $this->router->method == 'index'):?> class="active"<?endif;?>><a href="/">Home</a></li>
        <li<? if ($this->router->class == 'article' && $this->router->method == 'support'):?> class="active"<?endif;?>><a  href="/article/support">Support</a></li>
        <li<? if ($this->router->class == 'article' && $this->router->method == 'about'):?> class="active"<?endif;?>><a href="/article/about">About Us</a></li>
        <li<? if ($this->router->class == 'blog' && $this->router->method == 'support'):?> class="active"<?endif;?>><a href="/blog">Blog</a></li>
        <li<? if ($this->router->class == 'article' && $this->router->method == 'contact'):?> class="active"<?endif;?>><a href="/article/contact">Contact Us</a></li>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="hbg">
      <img src="/images/header_images.jpg" width="653" height="271" alt="header images" />
      <div class="text">
        <h3>Creating Futures</h3>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="content_bg">
      <div class="mainbar">
          <? $this->load->view($content_tpl); ?>
      </div>
      <div class="sidebar">
        <div class="gadget">
          <div class="search">
            <form method="get" id="search" action="">
              <span>
              <input type="text" value="Search..." name="s" id="s" />
              <input name="searchsubmit" type="image" src="/images/search.gif" value="Go" id="searchsubmit" class="btn"  />
              </span>
            </form>
            <!--/searchform -->
            <div class="clr"></div>
          </div>
          <div class="clr"></div>
        </div>
        <div class="gadget">
          <h2><span>Sidebar</span> Menu</h2>
          <div class="clr"></div>
          
          <ul class="sb_menu">
            <li<? if ($this->router->class == 'article' && $this->router->method == 'index'):?> class="active"<?endif;?>><a href="/">Home</a></li>
            <? if (!isset($this->session->userdata['login'])):?>
            <li<? if ($this->router->class == 'account' && $this->router->method == 'add'):?> class="active"<?endif;?>><a href="/account/add">Register</a></li>
            <li<? if ($this->router->class == 'account' && $this->router->method == 'forget'):?> class="active"<?endif;?>><a href="/account/forget">Forget</a></li>
            <?else:?>
            <li<? if ($this->router->class == 'account' && $this->router->method == 'edit'):?> class="active"<?endif;?>><a href="/account/edit">Edit</a></li>
            <li<? if ($this->router->class == 'account' && $this->router->method == 'change'):?> class="active"<?endif;?>><a href="/account/change">ChangePassword</a></li>
            <li><a href="#">AddBlog</a></li>
            <?endif;?>
            <li><a href="#">Blog</a></li>
          </ul>
          
        </div>
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
        <div class="gadget">
          <h2 class="grey"><span>Wise Words</span></h2>
          <div class="clr"></div>
          <div class="testi">
            <p><span class="q">ret</span> We can let circumstances rule us, or we can take charge and rule our lives from within. <span class="q">кен</span></p>
            <p class="title"><strong>Earl Nightingale</strong></p>
          </div>
        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="fbg">
    <div class="col c1">
      <h2><span>Image Gallery</span></h2>
      <a href="#"><img src="/images/pic_1.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="/images/pic_2.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="/images/pic_3.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="/images/pic_4.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="/images/pic_5.jpg" width="58" height="58" alt="pix" /></a> <a href="#"><img src="/images/pic_6.jpg" width="58" height="58" alt="pix" /></a> </div>
    <div class="col c2">
      <h2><span>Lorem Ipsum</span></h2>
      <p>Lorem ipsum dolor<br />
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam</a>, lectus turpis varius lorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam.</p>
    </div>
    <div class="col c3">
      <h2><span>About</span></h2>
      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu posuere nunc justo tempus leo. llorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum. <a href="#">Learn more...</a></p>
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
</div>
    <script type="text/javascript">
        $(function(){  
            $('#singin').click(function() { 
                var login = $('input[name=reglogin]').val();
                var password = $('input[name=regpassword]').val();
                if (login != '' && password != '') {
                    var url = "<?=BASE_URL?>account/signin"
                    $.ajax({ type: "POST", url: url, data: { "login": login, "password": password  },
                    success: function(res) {
                        if (!res) {
                            showErrorLogin();
                        } else {
                            location.href = '<?=BASE_URL?>';
                        }
                    }
                    });
                } else {
                    showErrorLogin();
                } 
  
            });
            
            function showErrorLogin() {
                $('input[name=reglogin]').val('');
                $('input[name=regpassword]').val('');
                $('.loginerror span').show();
            }
        });
    </script>
</body>
</html>