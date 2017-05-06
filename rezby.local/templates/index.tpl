<!DOCTYPE html>
<html>
<head>
	<title>{FOLDER_SAIT}</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link href="{uri 'css/reset.css'}" rel="stylesheet">
	<link href="{uri 'css/style.css'}" rel="stylesheet">
	<script type="text/javascript" src="{uri 'js/jquery-latest.min.js'}"></script> 
{if $operation == 'galerea' }
	<link href="{uri 'css/styles.css'}" rel="stylesheet">
	<link href="{uri 'css/touchTouch.css'}" rel="stylesheet">
{/if}	
{if $php == '' } 
	<link href="{uri 'css/slider.css'}" rel="stylesheet">
	<script type="text/javascript" src="{uri 'js/jquery.scrollbox.js'}"></script> 
{/if}	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="{uri 'images/favicon.png'}" type="image/png">   
</head>
<body>
	<div class="main">
		<div class="wrap">
			<div class="head1">
				<div class="slog">
					<h1>Пан Свiдровiч</h1>
					<p class="slog1">Паслугi па свiдраванню</p>
				</div>
				<div class="koronka">
					<div class="kontakttel">
						<div class="number1">
							<table width="70" align="center" valign="bottom" border="1" align="center" cellpadding="4" cellspacing="0"> 
								<tr> 
									<td align="right" valign="bottom"><p class="slog1">8 029</p></td>
								</tr>
								<tr>
									<td align="right" valign="top"><p class="slog1">8 033</p></td>
								</tr>
							</table>
						</div>
						<div class="number2">
							<p class="slog2">366 04 10</p>
						</div>
						<div class="pld"></div>
						<p class="kontakt">happy.diamond@mail.ru</p>
					</div>
					<div class="knopki">
						<ul class="knopka">
							<li><a class="ru" href="javascript:void(0)"> </a></li>
							<li><a class="by" href="javascript:void(0)"> </a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="pld"></div>
			<div>
				<div class="menu">
					<ul class="menuha">
						<li><a href="{if $lang == ''}{SERVER_ROOT}{else}{SERVER_ROOTBY}{/if}">{$language['LANG_menuMain']}</a></li>
						<li><a href="{url pages price}">{$language['LANG_menuPrice']}</a></li>   
						<li><a href="javascript:void(0)">{$language['LANG_menuServices']}</a>
							<ul>
								<li><a class="koronka1" href="{url pages sverlenie}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;сверление&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
								<li><a class="koronka1" href="{url pages rezka}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;резка&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
								<li><a class="koronka1" href="{url pages demontazh}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;демонтаж&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
							</ul>
						</li>
						<li><a href="{url pages galerea}">{$language['LANG_menuGallery']}</a></li>
						<li><a href="javascript:void(0)">{$language['LANG_menuContacts']}</a>
							<ul>
								<li><a class="koronka1" href="{url pages about}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FAQ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="content1">
				{if $php == '' }
				<div class="menu1">
					<div id="rotator">
						<ul>
							<li class="show"><a href="{url pages galerea}"><img src="{uri 'images/fot1_small.png'}" alt="сверление"></a></li>
							<li><a href="{url pages galerea}"><img src="{uri 'images/fot2_small.png'}" alt="сверление"></a></li>
							<li><a href="{url pages galerea}"><img src="{uri 'images/fot3_small.png'}" alt="сверление"></a></li>
							<li><a href="{url pages galerea}"><img src="{uri 'images/fot4_small.png'}" alt="сверление"></a></li>
							<li><a href="{url pages galerea}"><img src="{uri 'images/fot5_small.png'}" alt="сверление"></a></li>
						</ul>
					</div>
				</div>
				<div class="menu2">
					<h2 class="zagolovok2">Алмазные технологии в строительстве</h2>
					<p>Алмазные технологии в строительстве REZ.BY</p>
					<p>Алмазное сверление бетона – это качественный способ получить отверстия идеальной формы и любого диаметра за короткий промежуток времени. При этом такие негативные факторы как пыль, шум и вибрация практически отсутствуют.</p>
					<p>Резка проемов при помощи алмазного инструмента дает возможность не только получить на выходе идеальную поверхность, но и избежать возможных трещин. Таким способом можно обрабатывать практически любой материал.</p>
					<p>Стоит добавить, что алмазные технологии широко используются при демонтаже железобетона и прочих строительных материалови конструкций.</p>
					<p> Новые возможности, которые открывает алмаз.<br>
					<img src="{uri 'images/foto2.jpg'}" alt="сверление" class="rightimg"></p>
					<p>С появлением алмазных технологий сверления и резки строительство перешло на более качественный уровень. И дело не только в том, что благодаря алмазному инструменту отверстия и поверхности получаются идеально ровными и гладкими. На обработку материала таким способом затрачивается вполовину меньше времени, чем раньше.</p>
					<p>Компания REZ.BY рада предложить вам свои услуги в области строительства и демонтажа.</p> 
					<p>Подробнее об алмазном сверлении, алмазной резки, строительном демонтаже, и других услугах нашей компании вы можете узнать в соответствующих разделах сайта, а также связавшись с нами.</p>
					</p>
				</div>
			{else}{run 'current' 'current'}{/if}  
			</div>
			<div class="pld"></div>
			<div class="page-buffer"></div> 
			{if $php == '' } 
			<div class="slider">
			    <div id="sliderpartner" class="scroll-img">
			      <ul>
			        <li><a href="{uri 'images/slider/belgosstrah.png'}" target="_blank"><img src="{uri 'images/slider/belgosstrah.png'}"></a></li>
			        <li><a href="{uri 'images/slider/belita.png'}" target="_blank"><img src="{uri 'images/slider/belita.png'}"></a></li>
			        <li><a href="{uri 'images/slider/belspec.png'}" target="_blank"><img src="{uri 'images/slider/belspec.png'}"></a></li>
			        <li><a href="{uri 'images/slider/donarit.png'}" target="_blank"><img src="{uri 'images/slider/donarit.png'}"></a></li>
			        <li><a href="{uri 'images/slider/gazprogress.png'}" target="_blank"><img src="{uri 'images/slider/gazprogress.png'}"></a></li>
			        <li><a href="{uri 'images/slider/geopark.png'}" target="_blank"><img src="{uri 'images/slider/geopark.png'}"></a></li>
			        <li><a href="{uri 'images/slider/institut.png'}" target="_blank"><img src="{uri 'images/slider/institut.png'}"></a></li>
			        <li><a href="{uri 'images/slider/invalidy.png'}" target="_blank"><img src="{uri 'images/slider/invalidy.png'}"></a></li>       
			        <li><a href="{uri 'images/slider/mzor.jpg'}" target="_blank"><img src="{uri 'images/slider/mzor.jpg'}"></a></li>
			        <li><a href="{uri 'images/slider/onega.png'}" target="_blank"><img src="{uri 'images/slider/onega.png'}"></a></li>      
			        <li><a href="{uri 'images/slider/projectana.png'}" target="_blank"><img src="{uri 'images/slider/projectana.png'}"></a></li>
			        <li><a href="{uri 'images/slider/promteh.png'}" target="_blank"><img src="{uri 'images/slider/promteh.png'}"></a></li>      
			        <li><a href="{uri 'images/slider/scania.png'}" target="_blank"><img src="{uri 'images/slider/scania.png'}"></a></li>
			        <li><a href="{uri 'images/slider/scop.png'}" target="_blank"><img src="{uri 'images/slider/scop.png'}"></a></li>      
			        <li><a href="{uri 'images/slider/st14.png'}" target="_blank"><img src="{uri 'images/slider/st14.png'}"></a></li>
			        <li><a href="{uri 'images/slider/su159.png'}" target="_blank"><img src="{uri 'images/slider/su159.png'}"></a></li>     
			        <li><a href="{uri 'images/slider/uniflex.png'}" target="_blank"><img src="{uri 'images/slider/uniflex.png'}"></a></li>
			        <li><a href="{uri 'images/slider/vitalur.png'}" target="_blank"><img src="{uri 'images/slider/vitalur.png'}"></a></li>     
			        <li><a href="{uri 'images/slider/ziko.png'}" target="_blank"><img src="{uri 'images/slider/ziko.png'}"></a></li>
			        <li><a href="{uri 'images/slider/zrenie.png'}" target="_blank"><img src="{uri 'images/slider/zrenie.png'}"></a></li>
			        <li><a href="{uri 'images/slider/nordin.png'}" target="_blank"><img src="{uri 'images/slider/nordin.png'}"></a></li>
			        <li><a href="{uri 'images/slider/svg.jpg'}" target="_blank"><img src="{uri 'images/slider/svg.jpg'}"></a></li>
			      </ul>
			    </div>
			</div>
			{/if}
			<div class="niz">
				<div class="footer">
					<div class="kontakt11">
						<p class="kontakt1">vel 8 029 366 04 10</p>
						<p class="kontakt1">мтс 8 033 366 04 10</p>
						<p class="kontakt1 email">happy.diamond@mail.ru</p>
					</div>
				</div>
			</div>
		</div>
	</div>
{if $php == '' } 
<script type="text/javascript">
$('#sliderpartner').scrollbox({ 
  direction: 'h',
  distance: 140
});
$('#demo5-backward').click(function () { 
  $('#demo5').trigger('backward');
});
$('#demo5-forward').click(function () { 
  $('#demo5').trigger('forward');
});

function theRotator(){ 
	$('div#rotator ul li').css({ opacity: 0.0});
	$('div#rotator ul li:first').css({ opacity: 1.0});
	setInterval('rotate()', 3000);
}
function rotate(){ 
	var current = ($('div#rotator ul li.show')?  $('div#rotator ul li.show') : $('div#rotator ul li:first'));
	var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('div#rotator ul li:first') :current.next()) : $('div#rotator ul li:first'));	
	next.css({ opacity: 0.0})
	.addClass('show')
	.animate({ opacity: 1.0}, 1000);
	current.animate({ opacity: 0.0}, 1000)
	.removeClass('show');
};
$(document).ready(function(){ 
	theRotator();
});
</script>	
{/if}
</body>
</html>