<?php
	header('Content-Type: text/html; charset=UTF-8');
	define('DOC_ROOT', dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR);
	include('lib/config.php');
	include('lib/compiler.php');
	session_start();
	/*
		Работа с базой здесь не нужно хотя может и понадобится    
	    $lnk = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Умри");    
		include('lib/db.php');  
	*/	
	$compiler = array();
	$load = compilerInst();

	// перекомпиливаем шаблоны
	$compiler['compiledParam'] = true;
	// подключаем дополнительные модули

	include('lib/files.php');
	
	defineTitle();
	defineMetaKeywords();
	defineMetaDescription();
	
	/* 	
		Готовим $readyHtml шаблоны, если $readyHtml = true. Движок переводим в постороение шаблонов HTML  
		// не забудь указать в urle браузера pages/contacts
	*/
	$readyHtml = false;

	if ($readyHtml) {
		if (is_dir(DOC_ROOT. READY_HTML)) {			clearDir(DOC_ROOT. READY_HTML, true, 0, true); 
			@rmdir(DOC_ROOT. READY_HTML . DIRECTORY_SEPARATOR);
		}
		mkNeedDir();
		// сканим папку
		$pages = searchPages();
		// создаем нужные папки
		$search = array(); // Нужные функции в модуле .php 
		for ($i = 0, $count = count($pages); $i < $count; $i++) 
		{
			$path = DOC_ROOT. READY_HTML . DIRECTORY_SEPARATOR . FOLDER_SAIT . DIRECTORY_SEPARATOR . reset(explode(".", $pages[$i])); 
			@mkdir($path);
			$search = searchFunction($pages[$i]);   
			doHtml($search, $path, reset(explode(".", $pages[$i])));
		}
		echo "Done";
	}
	else {		running($load);	} 
	
	//mysqli_close($lnk); 
	
	function running($load)
	{
		global $compiler;		if ($load) {
			$compiler['globaltime'] = time(); 
			// компилинг выполняет компеляцию шаблона в две стадии
			$content = compiling('index.tpl');  
		} else {
			// компиляция любой страницы в случае пустого контента '', компеляция без run и include 
			$content = recompile('404.tpl', $compiler['compiledParam']);  
		}
		print_r($content); 
	}

