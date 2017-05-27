<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link href="<?= SERVER_ROOT?>css/reset.css" rel="stylesheet">
    <link href="<?= SERVER_ROOT?>css/main.css" rel="stylesheet">
    <title><? echo $this->out["title"]; ?></title>
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
  
    <div class="notfound">
        <h2>&nbsp;</h2>
        <div>
            <img src="<?= SERVER_ROOT?>images/404.jpg" alt="">
        </div>
    </div>	
</body>
</html>