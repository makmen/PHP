<!DOCTYPE html>
<html>
<head>
    <title><? echo $this->out["title"]; ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link href="<?= SERVER_ROOT?>css/reset.css" rel="stylesheet">
    <link href="<?= SERVER_ROOT?>css/main.css" rel="stylesheet">
    <link href="<?= SERVER_ROOT?>css/superfish.css" rel="stylesheet">
    <!--[if IE]><link rel="stylesheet" type="text/css" media="screen,projection" href="css/ie6.css" /><![endif]-->
    <script type="text/javascript" src="<?= SERVER_ROOT?>js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="<?= SERVER_ROOT?>js/calend.js"></script> 
</head>
<body>
  <!-- Header -->
  <div class="ambitios_header_tile_left"></div>
  <div class="ambitios_header_tile_right"></div>
  <div class="ambitios_header">
    <div class="ambitios_head"> 
      <!-- logo --> 
      <a href="<?= SERVER_ROOT?>" class="ambitios_logo"><img src="<?= SERVER_ROOT?>images/logo.png" alt="" /></a> 
      <!-- EOF logo --> 
      <!-- menu -->
        <?php
            include 'menu.tpl';
        ?>
      <!-- EOF menu --> 
    </div>
  </div>
  <!-- EOF Header --> 
    <div class="ambitios_row_head">
      <div class="ambitios_container_16" id="toc"> &nbsp; </div>
    </div>
  <!-- Content -->
  <div class="ambitios_content">
    <div class="ambitios_container_16">
      <div class="ambitios_wrapper">
        <div class="ambitios_grid_11 ambitios_alpha">
            <!-- main part --> 
            <?php 
                if ($this->out["module"] == '') {
            ?>
                <h1 class="ambitios_uppercase">Направление деятельности ООО &laquo;ВТТ&raquo; </h1>
                <p>Основное направление деятельности предприятия ООО &laquo;ВТТ&raquo; - весь спектр работ в области вакуумной техники и технологий. Цель создания фирмы – стремление к более полному и качественному подходу к разработке и изготовление вакуумной техники с новыми технологическими возможностями.
                </p>
                 <div class="ambitios_indent_left ambitios_picture"><img src="<?= SERVER_ROOT?>images/main1.jpg" alt="" /></div>
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
                <div class="ambitios_indent_right ambitios_picture"><img src="<?= SERVER_ROOT?>images/main2.jpg" alt="" /></div>
                <p class="ambitios_p3">Мы предлагаем вакуумные установки как в базовой комплектации, так и установки специально изготовленные под требуемые покрытия и напыляемое изделие. Наша задача – максимально удовлетворить требования заказчика по оптимальной стоимости. Специалисты ООО &laquo;ВТТ&raquo; всегда готовы к взаимовыгодному  сотрудничеству и удовлетворению любых пожеланий заказчика. </p>
            <?php 
                } else {
                    include '_' . $this->out["module"] . '.tpl';
                }
            ?>
            <!-- EOF main part --> 
        </div>
        <div class="ambitios_grid_5 ambitios_omega">
          <div class="ambitios_indent">
            <h3 class="ambitios_uppercase">Наши преимущества</h3>
          </div>
          <ul class="ambitios_link_list ambitios_p2">
            <li><a href="#">Актуальные  цены</a></li>
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
	            	<span class="ambitios_picture ambitios_fleft"><img src="<?= SERVER_ROOT?>images/tech1.jpg" alt="" /></span></div>
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
    <?php
        include 'footer.tpl';
    ?>
</div>
<script type="text/javascript">
    mycalendar();
</script>
</body>
</html>