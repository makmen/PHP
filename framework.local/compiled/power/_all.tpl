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
<form action="http://framework.local/power/all" method="post"  class="cmxform">
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
    <? if ( !empty(compiler::getInstance()->vars["power"])) { ?>
<? if (is_array(compiler::getInstance()->vars["power"]) && count (compiler::getInstance()->vars["power"])>0) {reset(compiler::getInstance()->vars["power"]); while (list(compiler::getInstance()->vars["k"], compiler::getInstance()->vars["v"]) = each(compiler::getInstance()->vars["power"])) {  ?>
    <div class="ambitios_p4">
        <div class="ambitios_wrapper ambitios_p2">
                <h3 class="ambitios_uppercase ambitios_p5"><? echo compiler::getInstance()->vars["v"]['title']; ?></h3>
                <div class="ambitios_date"><? echo compiler::getInstance()->vars["v"]['created']; ?></div>
        </div>
        <p class="price">Цена: <span><? echo compiler::getInstance()->vars["v"]['price']; ?> BYR</span></p>
        <p><? echo compiler::getInstance()->vars["v"]['shortcontent']; ?>&nbsp;...</p>
        <div class="ambitios_wrapper">
            <a href="http://framework.local/power/view/<? echo compiler::getInstance()->vars["v"]['id']; ?>" class="ambitios_button_small_rev ambitios_fleft">Просмотреть</a>
        </div>
    </div>
<?  } }  ?>
    <? if ( compiler::getInstance()->vars["total_stat"] >= compiler::getInstance()->vars["onpage"]) { ?>
        <div class="ambitios_pagination">
    <? if (is_array(compiler::getInstance()->vars["pagging"]) && count (compiler::getInstance()->vars["pagging"])>0) {reset(compiler::getInstance()->vars["pagging"]); while (list(compiler::getInstance()->vars["k"], compiler::getInstance()->vars["v"]) = each(compiler::getInstance()->vars["pagging"])) {  ?>
        <a href="http://framework.local/power/all?p=<? echo compiler::getInstance()->vars["v"]; ?>" <? if ( compiler::getInstance()->vars["page"] == compiler::getInstance()->vars["v"]) { ?>class="currentpagging"<?  }  ?>><? echo compiler::getInstance()->vars["v"]; ?></a>&nbsp;
    <?  } }  ?>
</div> 
    <?  }  ?>
<?  } else {  ?>
<div class="mess-top">
    <div class="fbok">
            <div class="info">Нет данных</div>
    </div>
</div>
<?  }  ?> 
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