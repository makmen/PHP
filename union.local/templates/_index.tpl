<!DOCTYPE html>
<html>
<head>
    <title><?= $this->out["title"] ?></title>
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
        <?php include 'menu.tpl'; ?>
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
            <?php if ($this->out["module"] == ''): ?>
                <h1 class="ambitios_uppercase"> Система шифрования файлов </h1>
                <p>
                    Система представляет из себя решиние для шифрования с помощью метода с автоключом при использовании 
                    открытого текста файлов любых расширений.
                </p>
                 <div class="ambitios_indent_left ambitios_picture"><img src="<?= SERVER_ROOT?>images/mainleft.jpg" alt="" /></div>
                <p class="ambitios_p3">
                    Чтобы зашифровать файлы необходимо поместить их в директорию files/cript. 
                    Количество файлов не ограничено, но лимит файлов не больше 10 Мб. Если поместить больше будет задержка по времени.
                    Чтобы зашифровать файлы необходим открытый ключ с помощью которого будет происходить шифрование.
                    Ключ содержит ограничение не менее 10 и не более 30 символов.
                </p>
                <p class="ambitios_p3">
                    Сразу после ввода ключа происходит шифрование, все полученные файлы после шифрования находятся в директории files/ready.
                    Не переименовывайте эти файлы, количество этих файлов установлено константой FILE_NUM_READY и равно 12.
                    Файлы содержат криптограмму и по одиночке бессмысленны  в использовании.
                    Полученные файлы можно передавать по разным источником информации (например три файла передать по скайп, еще три по email, по viber и т.д) 
                </p>
                <p> 
                    На обратной стороне система соберет все файлы и расшифрует их при помощи открытого ключа.
                    Если какого-то файла не хватает, то система не расшифрует изначальные файлы. 
                    Если ключ будет не верный, то систем также не расшифрует изначальные файлы. 
                    Расшифрованные файлы будут находится в директории files/decode в zip архиве.
                </p>
                <p> 
                    Необходимое ПО:
                </p>
                <ul>
                    <li>PHP 5.3;</li>
                    <li>Apache Server 2-2;</li>
                </ul>
                <p>&nbsp;</p>
            <?php else: ?>
                <?php include '_' . $this->out["module"] . '.tpl'; ?>
            <?php endif; ?>
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
                            Новые технологии и техники
                        </div>
                    </div>
                </div>
            </div>
                <div class="ambitios_txt_block ambitios_height">
	            <div class="ambitios_wrapper ambitios_p2">
	            	<span class="ambitios_picture ambitios_fleft"><img src="<?= SERVER_ROOT?>images/tech1.jpg" alt="" /></span></div>
                        <p class="center">По вашему техническому заданию мы можем разработать и передать ... </p>
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
    <?php include 'footer.tpl'; ?>
</div>
<script type="text/javascript">
    mycalendar();
</script>
</body>
</html>