<?php
	function compilerInst() {
		global $compiler;
		$compiler['module'] = DOC_ROOT.'php/';
		$compiler['templates'] = DOC_ROOT.'templates/';
		$compiler['compiled'] = DOC_ROOT.'compiled/';
		include('opts.php');
		$arr = explode('/', $_SERVER['REQUEST_URI']);
		if (!empty($arr)) {			// первый параметр должна быть langs
			$compiler['lang'] = strtoupper(compiler_stripUri(injection($arr[1])));
$compiler['lang'] = "";
			if (array_key_exists($compiler['lang'], $langs)) {				$compiler['php'] = compiler_stripUri(injection($arr[2]));
				$compiler['operation'] = compiler_stripUri(injection($arr[3]));
				$compiler['id'] = (int)$arr[4]; // в инт и не волнует
			} else {				$compiler['php'] = compiler_stripUri(injection($arr[1]));
				$compiler['operation'] = compiler_stripUri(injection($arr[2]));
				$compiler['id'] = (int)$arr[3]; // в инт и не волнует
				$compiler['lang'] = DEFAULTLANG;			}
			unset($arr[0]);
			$arr = implode('/', $arr);
			$compiler['REQUEST_URI'] = compiler_stripUri(injection(SERVER_ROOT.$arr));
		} else {			$compiler['lang'] = DEFAULTLANG;		}
		$load = true;
		$str = "lang_".$compiler['lang'];
		$compiler['language'] = $$str;
		if (!empty($compiler['php']))
		{
			$name = strtolower($compiler['php']);
			$compiler['php_path'] = $compiler['module'].$name.'.php';
			$compiler['templates_path'] = $compiler['templates'].$name.'/';
			$load = compilerLoad();
		}
		if ($compiler['lang'] == DEFAULTLANG) {			$compiler['lang'] = '';		} else {			$compiler['lang'] = strtolower($compiler['lang']);		}

		return $load;
	}
	
	function compiler_stripUri($uri){
		return str_replace(Array('$','{','}','(',')',';'),'',$uri);
	} 
	
	function compilerLoad() 
	{
		global $compiler;
		// если модуля нет возвращаем false
		if (file_exists($compiler['php_path']) !== false)
		{
			// если модуль есть подключаем его и проверяем функцию
			include_once($compiler['php_path']);
			include_once($compiler['module'].'opts.php');
			$str = "lang_".$compiler['lang'];
			$compiler['language'] = array_merge($compiler['language'], $$str);
			// если нет возвращаем true, если есть проверяем подключена ли она если нет то false
			if (empty($compiler['language'])) {				return false;			}
			if ($compiler['operation'] != '') { 
				if (!function_exists($compiler['operation'])){
					return false; 
				}
			}
			
			return true;
		}
		
		return false;
	}

	function compilingshow($content, $fileParseName='', $save)
	{
		$temp = tempnam(DOC_ROOT."compiled/", "com");
		$handle = fopen($temp, "w");
		fwrite($handle, $content);
		if ($save) {
			file_put_contents(DOC_ROOT."compiled/".$fileParseName.COMPILERFILE, $content);	
		}
		$content = get_include_contents($temp);
		fclose($handle);
		unlink($temp);
		return $content;
	}

	function get_include_contents($filename) 
	{
		global $compiler; 
		if (is_file($filename)) 
		{
			ob_start(); 
			include $filename;
			$content=ob_get_contents();
			ob_end_clean();
			return $content; 
		}
		return false;
	}

	function frame_run($frame, $operation='') 
	{ 
		global $compiler;      
		// раздаем если нужен текущий url помечаем как current       
		// в противном случае оставляем без изменений    
		if ($frame == 'current') {			$frame = $compiler['php']; // уже подключен
		} 
		else // подключение 	
			include_once($compiler['module'].$frame.'.php');
		if ($operation == 'current') 
			$operation = $compiler['operation'];
		// если функция пустая запускаем стартовую
		if ($operation == '') 
			$operation = $frame."_start";
		// далее смотрим функцию. Если функция существует выполняем её
		// в случае если функция вернул noAccess подгружаем соответствующий шаблон   
		// если все норм берем нужный шаблон    
		if (function_exists($operation)) {			call_user_func($operation);   
			if (isset($compiler['noAccess'])) {   
				$content = get_include_contents($compiler['compiled'].'noAccess.tpl'.COMPILERFILE); 	 
			} else {
			    // смотрим есть ли скомпиленный шаблон 
				if (is_file($compiler['compiled'].$frame.DIRECTORY_SEPARATOR.$operation.COMPILERFILE)) {
					$content = get_include_contents($compiler['compiled'].$frame.DIRECTORY_SEPARATOR.$operation.COMPILERFILE); 
				} else { // компилим, создаем каталог
					if (!is_dir($compiler['compiled'].$frame))
						mkdir($compiler['compiled'].$frame, 0700); 
					if (is_file($compiler['templates'].$frame.'/'.$operation.'.tpl')) {
						$content = recompile($frame.DIRECTORY_SEPARATOR.$operation.'.tpl', $compiler['compiledParam']);
					} else { // если шаблона нету
						header('Location: '.SERVER_ROOT."\n\n");   	
					}
				}
            }
		} else {			// функция существует в любом случае       
		}
		return $content;  
	}   
	 
	// ошибочка была связана с тем что сначала выпаршивается только run и include что не верно!
	// сперва парсим на обычные символы и  конструкции   
	// парсинг происходит в два этапа и парсится только файлы лежащие в template  
	// пока предпологаем что парсится только index.tpl
	function compiling($tmpl) 
	{		global $compiler;
		$compiler["_SESSION"] = $_SESSION;  
 		// Первый шаг компилинга    
		$content = recompile($tmpl,$compiler['compiledParam']);   
		// создаем noAccess   
		$noAccess = recompile('noAccess.tpl', $compiler['compiledParam']);        
		// после подключаем run и include. Второй шаг компилинга               
		$content = prepare_compiling($content);  
		$content = go_compiling($content);      
		//$content = compilingshow($content, '2', true);  

		return $content;	}
	
	// название файла, контент, и перекомпиливать или нет
	function recompile ($tmpl, $param=false) {		global $compiler;
		if (is_file($compiler['compiled'].$tmpl.COMPILERFILE) && !$param) {
			$content = get_include_contents($compiler['compiled'].$tmpl.COMPILERFILE); 	
		} else {
			$content = file_get_contents($compiler['templates'].$tmpl);     
			$content = go_compiling($content); 
			$content = compilingshow($content, $tmpl, true); 		}
		return $content;	}  

	function prepare_compiling($content) 
	{		global $compiler; 
		$tplTagBegin ='{';
		$tplTagEnd ='}';   
		preg_match_all('/'.$tplTagBegin.'(include|run)( ([^'.$tplTagEnd.']+))?'.$tplTagEnd.'/im',$content,$tmpl_tags,PREG_SET_ORDER);    
		if (count($tmpl_tags)>0) 
		{			foreach($tmpl_tags as $key=>$val) {
				switch($val[1]) {
					case 'include':  
						$args = prepare_vars($val[2]);
						$frame = reset(explode("/", $args));
						if (!file_exists($compiler['templates'].$args))
							$cpld_tpl ="Parce Error. File not exists ".$compiler['templates'].$args;  
						else {
							if (!is_dir($compiler['compiled'].$frame))
								mkdir($compiler['compiled'].$frame, 0700);
							$cpld_tpl = recompile($args, $compiler['compiledParam']);						}
						$content = str_replace($val[0],$cpld_tpl,$content);
					break;
					case 'run':   
						preg_match_all('/\'([\w\d\_]+)\'/i',$val[3],$run, PREG_PATTERN_ORDER);
						$cpld_tpl = frame_run($run[1][0], $run[1][1]);   
						$content = str_replace($val[0],$cpld_tpl,$content);
					break;
				}  
			}   
			$content = prepare_compiling($content);
		} 
		return  $content;	}         
	
	function go_compiling($content)
	{		global $compiler;    
		
		$tplTagBegin ='{';
		$tplTagEnd ='}';       
		$conditionQueue = array();    
		preg_match_all('/'.$tplTagBegin.'([^ ^'.$tplTagEnd.']+)( ([^'.$tplTagEnd.']+))?'.$tplTagEnd.'/im',$content,$tmpl_tags,PREG_SET_ORDER);   
		// удаляем все include и run  
		foreach($tmpl_tags as $key=>$val) {       
			if (preg_match('/(include|run)/im',$val[0]))  
			{				unset($tmpl_tags[$key]);				}		}         
		// заменяем    
		foreach($tmpl_tags as $key=>$val)
		{
			$rplcmnt='';
			switch($val[1]) {
				case 'if':
					$rplcmnt = parce_vars($val[2]);  
					$conditionQueue[0][]='('.$rplcmnt.')';
					$conditionQueue[1][]='if';  
					$rplcmnt="if ($rplcmnt) {"; 
					break;
				case 'elseif':
					$rplcmnt = parce_vars($val[2]);
					$conditionQueue[0][count($conditionQueue[0])-1]='!('.$conditionQueue[0][count($conditionQueue[0])-1].')';
					$conditionQueue[0][]='('.$rplcmnt.')';
					$conditionQueue[1][]='elseif';
					$rplcmnt="} elseif ($rplcmnt) {";
					break;
				case 'else':
					$conditionQueue[0][count($conditionQueue[0])-1]='!('.$conditionQueue[0][count($conditionQueue[0])-1].')';
					$rplcmnt=" } else { ";
					break;
				case '/if':
					do {
						$cnd=@array_pop($conditionQueue[1]);
						@array_pop($conditionQueue[0]);
					} while ($cnd=='elseif');
					$rplcmnt=" } ";
					break;   
				case 'uri':
					$params=trim(parce_vars($val[2]));      
					preg_match_all('/\'(.+)\'/i',$params, $run, PREG_PATTERN_ORDER);  
                    $content = str_replace($val[0],SERVER_ROOT.$run[1][0],$content);  
				break; 
				case 'url':
					$url=parce_url($val[2]);
					$content = str_replace($val[0],$url,$content);
				break; 
				case 'foreach':
					preg_match('/foreach (\$.+) as \$([\w\d\_]+)=>\$([\w\d\_]+)/',$val[0],$from);
					$cml_from = parce_vars($from[1]);
					$rplcmnt='if (is_array('.$cml_from.') && count ('.$cml_from.')>0) {reset('.$cml_from.'); while (list('.parce_vars("$".$from[2]).', '.parce_vars("$".$from[3]).') = each('.$cml_from.')) { '; 
					break;
				case 'foreachelse':
					$rplcmnt='} } else { {';
					break;
				case '/foreach':
					$rplcmnt=" } } ";
					break;           
 				default:
					$rplcmnt=(preg_match('/\$[\w\d\_]+=/',$val[1])?'':'echo '). parce_vars($val[1].';');  
					break;
			}
			$content=preg_replace('/'.preg_quote($val[0],"/").'/im','<? '.$rplcmnt.' ?>',$content);
		} 
		return $content;		}  
	
	function prepare_vars($vars) 
	{
		$args = preg_replace('/(([\w\d\_]+)=)|(\')|(\s)+/i','',$vars); 
		$args = explode ('/', $args);    
		$str = "";
		for ($i=0,$count = count($args); $i<$count; $i++) 
		{
			$str .= ($i != ($count - 1))? $args[$i].'/':$args[$i];
		}
		return $str;
	}
	
	function parce_url($vars)
	{
		global $compiler;
		$args = preg_split('/\s+/', trim($vars));  
		$url = SERVER_ROOT;
		if ($compiler['lang'] != '') {			$url .= $compiler['lang'] . '/';		}
		foreach ($args as $k => $v) 
		{			preg_match_all('/\$([\w\d\_]+)/', $v, $run, PREG_PATTERN_ORDER);
			$run = $run[1][0];  
			if (isset($compiler[$run])) {
				if ($compiler[$run]!='')					$url.= $compiler[$run].'/';	
			} else {				$url.= $v.'/';				}
		}
		
		return $url;
	}
	
	function parce_vars($vars) 
	{
		$name = "compiler";
		if(!is_array($vars)) {
			$vars=preg_replace('/\'?\"?(\$([\w\d\_]+))\'?\"?/','$'.$name.'["\\2"]',$vars);
		} else {
			if(count($vars)>0) {
				foreach($vars as $key=>$val) {
					$vars[$key]=preg_replace('/\'?\"?(\$([\w\d\_]+))\'?\"?/','$'.$name.'["\\2"]',$val);
				}
				$vars=implode(' ',$vars);
			}
		}
		return $vars;
	} 
	
	function injection($date)
	{
		$return = (get_magic_quotes_gpc()? stripslashes($date) : $date) ;
		return htmlspecialchars(strip_tags($return), ENT_QUOTES, "UTF-8");
	}
	
	function mkNeedDir() 
	{		@mkdir(DOC_ROOT. READY_HTML);
		@mkdir(DOC_ROOT. READY_HTML . DIRECTORY_SEPARATOR . FOLDER_SAIT);
	    @mkdir(DOC_ROOT. READY_HTML . DIRECTORY_SEPARATOR . FOLDER_SAIT . DIRECTORY_SEPARATOR . FOLDER_CSS);
	    @mkdir(DOC_ROOT. READY_HTML . DIRECTORY_SEPARATOR . FOLDER_SAIT . DIRECTORY_SEPARATOR . FOLDER_IMAGE);  
	    @mkdir(DOC_ROOT. READY_HTML . DIRECTORY_SEPARATOR . FOLDER_SAIT . DIRECTORY_SEPARATOR . FOLDER_JS);  
	    // копируем css     
	    copyDir(DOC_ROOT.FOLDER_CSS, DOC_ROOT. READY_HTML . DIRECTORY_SEPARATOR . FOLDER_SAIT . DIRECTORY_SEPARATOR . FOLDER_CSS);      
	    // копируем images     
	    copyDir(DOC_ROOT.FOLDER_IMAGE, DOC_ROOT. READY_HTML . DIRECTORY_SEPARATOR . FOLDER_SAIT . DIRECTORY_SEPARATOR . FOLDER_IMAGE);      
	    // копируем JS     
	    copyDir(DOC_ROOT.FOLDER_JS, DOC_ROOT. READY_HTML . DIRECTORY_SEPARATOR . FOLDER_SAIT . DIRECTORY_SEPARATOR . FOLDER_JS);
   
	}     
	
	function searchPages()
	{     
		global $compiler; 
		if ($handle = opendir($compiler['module']))
		{			$dir = array();
		    while (false !== ($file = readdir($handle))) 
		    {
				$dir[] = $file;   
		    }    
		    closedir($handle);
		}  
		$return = array();
		for ($i = 2, $count = count($dir); $i<$count; $i++) 
	    {         
	    	if (end(explode(".", $dir[$i])) == 'php') {    
	    		$return[] = $dir[$i]; 	    	}
	    } 
	    
		return $return; 
	}  
	
	function searchFunction($pages) {     
		global $compiler;  
		$file = file_get_contents($compiler['module'] . $pages);      
		preg_match_all('/function (.*)\(\)/i', $file, $run, PREG_PATTERN_ORDER);     
		$need = array(); 
		for ($i = 0, $count = count($run[1]); $i < $count; $i++) 
		{    
			if ($run[1][$i] == reset(explode(".", $pages)). "_start") {   
				continue;			}  
			$need[] = $run[1][$i]; 
		}   
		
		return $need;
	}     
	
	function doHtml($pages, $path, $module) {   
		global $compiler;    
		$compiler['globaltime'] = time(); 
		if ($compiler['php'] == "") {       
			include_once($compiler['module'] . $module .'.php'); 
			$compiler['php_path'] = $compiler['module'] . $module .'.php';
			$compiler['templates_path'] = $compiler['templates'] . $module .DIRECTORY_SEPARATOR ;
		} else {			$compiler['php'] = ""; 
			$compiler['operation'] = "";  		}  
		// сперва нужен индекс конечно     
		$content = recompile('index.tpl', true); 
		// заменяем пути на относительные
		$content = replceHref($content, "href");   
		$content = replceHref($content, "src"); 

		saveHtmlToFile(DOC_ROOT. DIRECTORY_SEPARATOR . READY_HTML . DIRECTORY_SEPARATOR . FOLDER_SAIT, 'index.html', $content);  
		// дальше лазим по всем страницам и записываем их
		$content = "";  
		for ($i = 0, $count = count($pages); $i < $count; $i++) 
		{      
			$compiler['php'] = $module; 
			$compiler['operation'] = $pages[$i];   
			if (file_exists($compiler['templates_path'].$pages[$i].'.tpl')) {    
				$content = recompile('index.tpl', true);   
				$content = prepare_compiling($content);   
				$content = go_compiling($content);     

				$content = replceHref($content, "href", false);   
				$content = replceHref($content, "src", false);       

				saveHtmlToFile($path, $pages[$i].'.html', $content);   			}  
		}  
	}
	
	function saveHtmlToFile($path, $file, $content) { 
		$fp = fopen($path. DIRECTORY_SEPARATOR . $file, "w+");     
		fwrite($fp, $content);
		fclose($fp);	}
	
	function replceHref($content, $href, $index = true) { 
		$file = ($index) ? $href.'="index.html"' : $href.'="../index.html"';
		$pattern = '/'.$href.'="(.*?)"/i'; 		preg_match_all($pattern, $content, $run, PREG_PATTERN_ORDER);  
		for ($i = 0, $count = count($run[1]); $i < $count; $i++) 
		{
			if ($run[1][$i] != '#') {     
				if ($run[1][$i] == SERVER_ROOT) { 
					$content = str_replace($run[0][$i], $file, $content);				} 
				else if(!preg_match('/'.SITE_NAME.'/i', $run[1][$i])) { // не мои ссылки  
				}
				else {   
				    $replace = str_replace(SERVER_ROOT, "", $run[1][$i]);     
				    $buffer = explode(".", $replace);  
				    if (count($buffer) < 2) { 
				    	$buffer = explode("/", $replace);      
				    	$replace = $buffer[0]. "/" . $buffer[1]. ".html";   
				    }
				    $replace = ($index) ? $href.'="' . $replace . '"' : $href.'="../' . $replace . '"';
					$content = str_replace($run[0][$i], $replace, $content);				}
			}
		}

		return $content; 
	}
	
	function defineTitle() {
		global $compiler, $menuSait;
		$str = "Швейное производство от ".SITE_NAMERU."-";
		switch($compiler['operation']) {
			case '': case 'line': case 'contacts': case 'feedback':
				$compiler['menuTitle'] = $str.$menuSait['LANG_menu'.$compiler['operation']];
			break;
			default:
				$compiler['menuTitle'] = $str.$menuSait['LANG_menukatalog'];
				break;
			
		}
	}
	
	function defineMetaKeywords() {
		global $compiler;
		switch($compiler['operation']) {
			case '': case 'line': case 'contacts': case 'feedback':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, фиттердизайн, fitterdizain";
			break;
			case 'katalog':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, брюки, жилеты, костюмы, халаты, хозяйственные товары, фиттердизайн, fitterdizain";
			break;
			case 'model1':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, брюки, брюки утепленные, полукомбинезон, фиттердизайн, fitterdizain";
			break;
			case 'model2':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, жилеты, фиттердизайн, fitterdizain";
			break;
			case 'model31':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, костюмы, халаты, фартук, фиттердизайн, fitterdizain";
			break;
			case 'model32':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, костюмы, халаты, фиттердизайн, fitterdizain";
			break;
			case 'model33':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, костюмы, халаты, фартук, фиттердизайн, fitterdizain";
			break;
			case 'model41':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, ботинки, фиттердизайн, fitterdizain";
			break;
			case 'model42':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, полукомбинезон, сапоги, фиттердизайн, fitterdizain";
			break;
			case 'model43':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, ботинки, берцы, фиттердизайн, fitterdizain";
			break;
			case 'model44':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, ботинки, берцы, полуботинки кожанные, фиттердизайн, fitterdizain";
			break;
			case 'model5':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, жилет, костюм-ксенон, фиттердизайн, fitterdizain";
			break;
			case 'model6':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, костюм, плащ, плащ нейлоновый, фартук, фиттердизайн, fitterdizain";
			break;
			case 'model7':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство,  футболки, фиттердизайн, fitterdizain";
			break;
			case 'model8':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, костюм, фиттердизайн, fitterdizain";
			break;
			case 'model9':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, подшлемник, фиттердизайн, fitterdizain";
			break;
			case 'model10':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, беруши, каска, наушники, очки защитные, щиток сварщика, фиттердизайн, fitterdizain";
			break;
			case 'model11':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, противогаз, респиратор, фиттердизайн, fitterdizain";
			break;
			case 'model12':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, краги, перчатки виниловые, перчатки нитриловые, рукавицы брезентовые, фиттердизайн, fitterdizain";
			break;
			case 'model13':
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, вафельное полотно, ведро, лопата, грабли, полотенце вафельное, фиттердизайн, fitterdizain";
			break;
			default:
				$compiler['metaKeywords'] = "рабочая одежда, спецодежда, обувь, швейное производство, фиттердизайн, fitterdizain";
				break;
		}
	}
	
	function defineMetaDescription() {
		global $compiler;
		$compiler['metaDescription'] = "Компания ФиттерДизайн предлагает вам пошив специальной одежды по индивидуальным заказам любой сложности. К вашим услугам пошив швейных изделий широкого профиля.";
	}