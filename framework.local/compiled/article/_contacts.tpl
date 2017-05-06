<!DOCTYPE html>
<html>
<head>
    <title><? echo FOLDER_SAIT; ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link href="http://framework.local/css/reset.css" rel="stylesheet">
    <link href="http://framework.local/css/main.css" rel="stylesheet">
    <link href="http://framework.local/css/superfish.css" rel="stylesheet">
    <!--[if IE]><link rel="stylesheet" type="text/css" media="screen,projection" href="css/ie6.css" /><![endif]-->
    <script type="text/javascript" src="http://framework.local/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="http://framework.local/js/superfish.js"></script> 
    <script type="text/javascript" src="http://framework.local/js/script.js"></script> 
    <script type="text/javascript" src="http://framework.local/js/calend.js"></script> 
</head>
<body>
  <!-- Header -->
  <div class="ambitios_header_tile_left"></div>
  <div class="ambitios_header_tile_right"></div>
  <div class="ambitios_header">
    <div class="ambitios_head"> 
      <!-- logo --> 
      <a href="<? echo SERVER_ROOT; ?>" class="ambitios_logo"><img src="http://framework.local/images/logo.png" alt="" /></a> 
      <!-- EOF logo --> 
      <!-- menu -->
          <ul class="ambitios_menu">
  <li><a href="<? echo SERVER_ROOT; ?>" <? if ( compiler::getInstance()->vars["module"] =='') { ?>class="ambitios_active"<?  }  ?>><span><span>Главная</span></span></a></li>
  <li><a href="http://framework.local/article/technology" <? if ( compiler::getInstance()->vars["template"] =='technology') { ?>class="ambitios_active"<?  }  ?>><span><span>Технологии</span></span></a></li>
  <li><a href="#"><span><span>Оборудование</span></span></a>
      <ul>
          <li><a href="http://framework.local/vequipment">Вакуумное оборудование</a>
              <? if ( compiler::getInstance()->vars["_SESSION"]['group'] == 1) { ?>
                  <ul>
                      <li><a href="http://framework.local/vequipment/add">Добавить оборудование</a></li>
                  </ul>
              <?  }  ?>
          </li>
          <li><a href="http://framework.local/power">Технологические источники</a>
              <? if ( compiler::getInstance()->vars["_SESSION"]['group'] == 1) { ?>
                  <ul>
                      <li><a href="http://framework.local/power/add">Добавить источник</a></li>
                  </ul>
              <?  }  ?>
          </li>
      </ul>
  </li>
  <li><a href="http://framework.local/news" <? if ( compiler::getInstance()->vars["module"] =='news') { ?>class="ambitios_active"<?  }  ?>><span><span>Новости</span></span></a>
  <? if ( compiler::getInstance()->vars["_SESSION"]['group'] == 2) { ?>
      <ul>
          <li><a href="http://framework.local/news/add">Добавить новость</a></li>
      </ul>
  <?  }  ?>
  </li>
  <li><a href="http://framework.local/article/contacts" <? if ( compiler::getInstance()->vars["template"] =='contacts') { ?>class="ambitios_active"<?  }  ?>><span><span>Контакты</span></span></a></li>
  <? if ( compiler::getInstance()->vars["_SESSION"]['group'] == 1) { ?>
          <li><a href="http://framework.local/account/register" <? if ( compiler::getInstance()->vars["operation"] =='register') { ?>class="ambitios_active"<?  }  ?>><span><span>Добавить админа</span></span></a></li>
  <?  }  ?>
  <? if ( isset(compiler::getInstance()->vars["_SESSION"]['login'])) { ?>
      <li><a href="#" <? if ( compiler::getInstance()->vars["operation"] =='edit' || compiler::getInstance()->vars["operation"] =='changepassword') { ?>class="ambitios_active"<?  }  ?>><span><span>Мой профиль</span></span></a>
          <ul>
              <li><a href="http://framework.local/account/edit">Изменить данные</a></li>
              <li><a href="http://framework.local/account/changepassword">Изменить пароль</a></li>
          </ul>
      </li>
      <li><a href="http://framework.local/account/logout"><span><span>Выход</span></span></a></li>
  <?  }  ?>
</ul>
      <!-- EOF menu --> 
    </div>
  </div>

  <div class="ambitios_rows_sub_t">
    <div class="ambitios_rows_sub_all">
      <div class="ambitios_container_16">
        <div class="ambitios_wrapper">
            <? $this->vars["parentmodule"] = account; $this->vars["parenttemplate"] = check; $this->loadModule(); ?><? if ( isset(compiler::getInstance()->vars["_SESSION"]['login'])) { ?>
    <div class="ambitios_grid_7 ambitios_alpha">
        <h1 class="ambitios_uppercase user">Добрый день, <? echo compiler::getInstance()->vars["_SESSION"]['name']; ?> <? echo compiler::getInstance()->vars["_SESSION"]['middlename']; ?> <? echo compiler::getInstance()->vars["_SESSION"]['lastname']; ?></h1>
    </div>
    <div class="cb"></div>
    <div>Вы вошли, как <? if ( compiler::getInstance()->vars["_SESSION"]['group'] == 1) { ?>Администратор<?  } else {  ?>Пользователь<?  }  ?></div>
<?  } else {  ?>
<form action="http://framework.local/article/contacts" method="post"  class="cmxform">
<div class="account">
   <div class="ambitios_login">
       <label for="formlogin">Логин:</label>
       <input name="formlogin" class="ambitios_input" type="text" />
   </div>
   <div class="ambitios_password">
       <label for="formpassword">Пароль:</label>
       <input name="formpassword" class="ambitios_input" type="password" />
   </div>
   <div class="ambitios_submit">
       <input name="logIn" value="1" type="hidden">
       <input type="submit" class="submit_button" value="Войти" name="lk" />
   </div>
   <div class="cb"></div>
   <div class="errorlogin">&nbsp;<span <? if ( compiler::getInstance()->vars["checkfalse"] == false) { ?>style="display:none;"<?  }  ?>>Не верный логин или пароль</span></div>
    <div class="register">
        <a href="http://framework.local/account">Регистрация</a>
    </div>
    <div class="forget">
        <a href="http://framework.local/account/forget">Забыли пароль</a>
    </div>
    <div class="cb"></div>
</div>
</form>
<?  }  ?> 
        </div>
      </div>
    </div>
  </div>
  <!-- EOF Header --> 

  <!-- Content -->
  <div class="ambitios_content">
    <div class="ambitios_container_16">
      <div class="ambitios_wrapper">
        <div class="ambitios_grid_11 ambitios_alpha">
            <!-- main part --> 
            <? if ( compiler::getInstance()->vars["module"]=='') { ?>
    <h3 class="ambitios_uppercase">Направление деятельности ООО &laquo;ВТТ&raquo; </h3>
    <p>Основное направление деятельности предприятия ООО &laquo;ВТТ&raquo; - весь спектр работ в области вакуумной техники и технологий. Цель создания фирмы – стремление к более полному и качественному подходу к разработке и изготовление вакуумной техники с новыми технологическими возможностями.
    </p>
     <div class="ambitios_indent_left ambitios_picture"><img src="http://framework.local/images/main1.jpg" alt="" /></div>
    <p class="ambitios_p3">Специалисты нашего предприятия имеют огромный опыт разработки и изготовления вакуумной техники различного функционального назначения. Нами изготовлены и поставлены вакуумные установки в такие страны как Россия, Украина, Литва, США, Сирия, Тайвань, Китай, Эстония, Канада, Польша и др.</p>
    <p class="ambitios_p3">Накопленный опыт работ в области вакуумной техники позволил систематизировать полученные знания и наметить направления деятельности предприятия в области новых технологий.</p>
    <p>В настоящее время основными направлениями деятельности ООО &laquo;ВТТ&raquo; являются:</p>
    <ul>
        <li>разработка и изготовление вакуумной техники;</li>
        <li>вакуумных установок для нанесения защитно-декоративных покрытий;</li>
        <li>вакуумных установок для нанесения упрочняющих покрытий;</li>
        <li>вакуумных установок для нанесения оптических покрытий;</li>
        <li>вакуумных установок для нанесения нанокомпозитных покрытий;</li>
        <li>вакуумных установок для нанесения покрытий на полупроводниковые пластины;</li>
        <li>вакуумных установок для замены гальванических покрытий;</li>
        <li>разработка конструкторской документации для изготовления оборудования по ТЗ заказчика;</li>
        <li>модернизация вакуумных установок старого образца;</li>
        <li>разработка и изготовление вакуумных откачных систем;</li>
        <li>разработка и изготовление технологических источников для нанесения покрытий в вакууме;</li>
        <li>разработка и изготовление технологических источников для очистки, распыления и ассистирования;</li>
        <li>разработка и изготовление вакуумной арматуры;</li>
        <li>разработка и изготовление блоков питания к технологическим источникам нанесения покрытий;</li>
        <li>разработка и изготовление систем управления вакуумными установками;</li>
        <li>изготовление вакуумных печей;</li>
        <li>ремонт и модернизация вакуумных печей; </li>
        <li>разработка и внедрение новых технологий;</li>
        <li>изготовление установок электролитно-плазменной полировки. </li>
    </ul>
    <p>&nbsp;</p>
    <div class="ambitios_indent_right ambitios_picture"><img src="http://framework.local/images/main2.jpg" alt="" /></div>
    <p class="ambitios_p3">Мы предлагаем вакуумные установки как в базовой комплектации, так и установки специально изготовленные под требуемые покрытия и напыляемое изделие. Наша задача – максимально удовлетворить требования заказчика по оптимальной стоимости. Специалисты ООО &laquo;ВТТ&raquo; всегда готовы к взаимовыгодному  сотрудничеству и удовлетворению любых пожеланий заказчика. </p>
<?  } else {  ?>
    <h3 class="ambitios_uppercase">Контактная информация </h3>
<div id="contact_form">
    <div id="Note"></div>
    <? if ( compiler::getInstance()->vars["errs"]['sendError']) { ?> 
        <div class="mess-top">
            <div class="error">
                <div class="msg"><? echo compiler::getInstance()->vars["errs"]['sendError']; ?></div>
            </div>
        </div>
    <? } elseif ( compiler::getInstance()->vars["sendSuccess"]) { ?>
        <div class="mess-top">
            <div class="fbok">
                <div class="success">Письмо отправлено</div>
            </div>
        </div>
    <?  }  ?>
    <form class="cmxform" id="contactform" method="post" action="http://framework.local/article/contacts">
        <div class="field ambitios_input_standat_height ambitios_p2">
                <label for="name">Имя</label>
                <input id="name" name="name" class="required<? if ( isset(compiler::getInstance()->vars["errs"]['name'])) { ?> err<?  }  ?>" type="text" value="<? echo compiler::getInstance()->vars["name"]; ?>" />
        </div>
        <div class="field ambitios_input_standat_height ambitios_p2">
                <label for="email">Email</label>
                <input id="email" name="email" class="required email<? if ( isset(compiler::getInstance()->vars["errs"]['email'])) { ?> err<?  }  ?>" type="text" value="<? echo compiler::getInstance()->vars["email"]; ?>" />
        </div>
        <div class="ambitios_textarea ambitios_p2 field">
                <label for="message">Сообщение</label>
                <textarea id="message" name="message" class="required<? if ( isset(compiler::getInstance()->vars["errs"]['message'])) { ?> err<?  }  ?>" rows="5" cols="10"><? echo compiler::getInstance()->vars["message"]; ?></textarea>
        </div>
        <div>
            <div class="buttons-wrapper">
                <div class="ambitios_wrapper ambitios_p2">
                    <div class="ambitios_button_contact">
                        <input type="submit" value="Send" name="contactus" id="contactus" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="ambitios_wrapper">
    <div class="ambitios_fleft">
        <h3 class="ambitios_uppercase">Директор: Высоцкий Василий Семенович </h3>
        Phone: +375 29 615 14 12<br />
        Fax: 8017 125 32 64<br />
        Email: <a href="mailto:mail@vactt@mail.ru">vactt@mail.ru</a><br /> 
        Email: <a href="mailto:mail@vvs200362@list.ru">vvs200362@list.ru</a> 
    </div>
</div>
<br />
<div class="ambitios_picture ambitios_p2">
    <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=eG5OG_eatgnABSizBk2fviWWJi38Kdu4&width=100%&height=400&lang=ru_RU&sourceType=constructor"></script>
</div>
 
<?  }  ?>
            <!-- EOF main part --> 
        </div>
        <div class="ambitios_grid_5 ambitios_omega">
          <div class="ambitios_indent">
            <h3 class="ambitios_uppercase">Наши преимущества</h3>
          </div>
          <ul class="ambitios_link_list ambitios_p2">
            <li><a href="#">Актуальные цены</a></li>
            <li><a href="#">Современное оборудование</a></li>
            <li><a href="#">Производительность и надежность</a></li>
            <li><a href="#">Высокий показатель качества</a></li>
            <li><a href="#">Оперативное обслуживание</a></li>
            <li><a href="#">Широкий выбор</a></li>
            <li><a href="#">Гибкий подход</a></li>
          </ul>
            <div class="ambitios_title">
                <div class="ambitios_title_left">
                    <div class="ambitios_title_right">
                        <div class="ambitios_title_shape ambitios_2rows">
                            Новые технологии вакуумной техники
                        </div>
                    </div>
                </div>
            </div>
                <div class="ambitios_txt_block ambitios_height">
	            <div class="ambitios_wrapper ambitios_p2">
	            	<span class="ambitios_picture ambitios_fleft"><img src="http://framework.local/images/tech1.jpg" alt="" /></span></div>
                        <p class="center">По вашему техническому заданию мы можем разработать и передать технологию нанесения покрытий с изготовлением оборудования. </p>
                    </div>
          <div class="ambitios_indent">
            <div class="ambitios_comments">
                <p id="calendp"></p>
                <table id="calend"></table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- EOF Content --> 

    <div class="ambitios_row_top">
  <div class="ambitios_container_16" id="toc"> &nbsp; </div>
</div>

    <div class="ambitios_row2_bg_g">
  <div class="ambitios_row2_bg_g_left"></div>
  <div class="ambitios_row2_bg_g_right"></div>
  <div class="ambitios_row2_bg">
    <div class="ambitios_container_16">
      <div class="ambitios_wrapper">
        <div class="ambitios_left"> 
          <!-- footer_widget -->
          <div class="ambitios_footer_widget">OOO &laquo;ВТТ&raquo;</div>
          <!-- EOF footer_widget --> 
        </div>
        <div class="ambitios_right"> 
          <!-- footer_widge text -->
          <div class="ambitios_text"> Вакуумная техника и технологии <br />
                  e-mail: <span class="email">vactt@mail.ru</span> <br />
                  e-mail: <span class="email">vvs200362@list.ru</span> <br />
                  Тел/факс: +3751592-4-12-90 <br />
          </div>
          <!-- EOF footer_widget text --> 
        </div>
      </div>
    </div>
  </div>
</div>

    <div class="ambitios_footer">
  <div class="ambitios_container_16">
    <div class="ambitios_copy"> &copy; 2016 Андрей Макась. All rights reserved. </div>
  </div>
</div>

</div>
<script type="text/javascript">
    mycalendar();
</script>
</body>
</html>