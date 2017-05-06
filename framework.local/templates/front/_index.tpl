<!DOCTYPE html>
<html>
<head>
    <title>{FOLDER_SAIT}</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link href="{uri 'css/reset.css'}" rel="stylesheet">
    <link href="{uri 'css/main.css'}" rel="stylesheet">
    <link href="{uri 'css/superfish.css'}" rel="stylesheet">
    <!--[if IE]><link rel="stylesheet" type="text/css" media="screen,projection" href="css/ie6.css" /><![endif]-->
    <script type="text/javascript" src="{uri 'js/jquery-1.4.2.min.js'}"></script>
    <script type="text/javascript" src="{uri 'js/superfish.js'}"></script> 
    <script type="text/javascript" src="{uri 'js/script.js'}"></script> 
    <script type="text/javascript" src="{uri 'js/calend.js'}"></script> 
</head>
<body>
  <!-- Header -->
  <div class="ambitios_header_tile_left"></div>
  <div class="ambitios_header_tile_right"></div>
  <div class="ambitios_header">
    <div class="ambitios_head"> 
      <!-- logo --> 
      <a href="{SERVER_ROOT}" class="ambitios_logo"><img src="{uri 'images/logo.png'}" alt="" /></a> 
      <!-- EOF logo --> 
      <!-- menu -->
          {include 'menu.tpl'}
      <!-- EOF menu --> 
    </div>
  </div>

  <div class="ambitios_rows_sub_t">
    <div class="ambitios_rows_sub_all">
      <div class="ambitios_container_16">
        <div class="ambitios_wrapper">
            {run account check} 
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
            {include 'main.tpl'}
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
	            	<span class="ambitios_picture ambitios_fleft"><img src="{uri 'images/tech1.jpg'}" alt="" /></span></div>
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

    {include 'rowtop.tpl'}

    {include 'rowbottom.tpl'}

    {include 'footer.tpl'}

</div>
<script type="text/javascript">
    mycalendar();
</script>
</body>
</html>