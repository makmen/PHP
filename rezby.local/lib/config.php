<?
	error_reporting(E_ERROR | E_WARNING | E_PARSE);  
	// error_reporting(0);

	// база данных
	define('DB_HOST','localhost');
	define('DB_PORT','3306');
	define('DB_NAME','katalog_db');
	define('DB_USER','root');
	define('DB_PASS','');
/*
	'SERVER_NAME' => 'www.rez.by',
	'SITE_NAME' => 'www.rez.by',
	'SERVER_ROOT' => 'http://www.rez.by/',
	

*/
	// пути

	define("SERVER_NAME",'http://rezby.local');
	define("SERVER_ROOT","http://rezby.local/");
	define("SERVER_ROOTBY",'http://rezby.local/by');

	/*
	define("SERVER_NAME",'rez.by');
	define("SERVER_ROOT","http://rez.by/");
	define("SERVER_ROOTBY",'http://rez.by/by'); 
	*/
	define("SITE_NAME", "rez.by");
	define("SITE_NAMERU", "РезБай");
	define("COMPILERFILE", ".comp");

	// название папок для копирования 
	define('READY_HTML','readyhtml');
	define('FOLDER_SAIT','rezby');
	define('FOLDER_CSS','css'); 
	define('FOLDER_IMAGE','images');
	define('FOLDER_JS','js');
	
