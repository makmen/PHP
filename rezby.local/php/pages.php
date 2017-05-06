<?php
	function pages_start() {

	}
	
	function about() {

	}
	
	function language($ln = DEFAULTLANG) {
		global $compiler;
		$referer = injection($_SERVER['HTTP_REFERER']);
		if ($compiler['lang'] == '') {			$compiler['lang'] = 'ru';
			if (strstr($referer, '/ru') == '') {				$referer = addRu($referer, $compiler['lang']);			}
		}
		if ($compiler['lang'] != $ln) {			// меняем язык  /ru/
			$compiler['REQUEST_URI'] = str_replace('/'.$compiler['lang'], '/'.$ln, $referer);		} else {			// ничего не меняем 			$compiler['REQUEST_URI'] = $referer;		}
		header('Location: '.$compiler['REQUEST_URI']."\n\n");
	}
	
	function addRu($url, $ln) {		$url = str_replace(SERVER_ROOT, SERVER_ROOT.$ln.'/', $url);
		
		return $url;	}
	
	function price() {		

	}
	
	function sverlenie() {

	} 

	function rezka() {

	}
	
	function demontazh() {

	}
	
	function galerea() {
		global $compiler;
		$compiler['galerea'] = array();
		for ($i = 1, $count = 12; $i <= $count; $i++) 
		{
			$compiler['galerea'][$i]['urlBigImage'] = SERVER_ROOT . "images/touchtouch/fot" . $i . '_b.jpg';
			$compiler['galerea'][$i]['urlSmallImage'] = SERVER_ROOT . "images/touchtouch/fot" . $i . '_s.jpg';
			$compiler['galerea'][$i]['title'] = 'foto_' . $i;
		}
	}
	
	function contacts() {

	}

	
	function addZero($i) {
		if ($i < 10) { 

			return '0'.$i;
					}	
		return $i;
	}
	
	function delDigit($str) {
		return preg_replace("/[0-9]{1}/", "", $str);	}
	
	function onlyDigit($str) {

		return preg_replace("/[^0-9]{1}/", "", $str);
	}
