<?php
	function pages_start() {

	}
	
	function about() {

	}
	
	function language($ln = DEFAULTLANG) {
		global $compiler;
		$referer = injection($_SERVER['HTTP_REFERER']);
		if ($compiler['lang'] == '') {
			if (strstr($referer, '/ru') == '') {
		}
		if ($compiler['lang'] != $ln) {
			$compiler['REQUEST_URI'] = str_replace('/'.$compiler['lang'], '/'.$ln, $referer);
		header('Location: '.$compiler['REQUEST_URI']."\n\n");
	}
	
	function addRu($url, $ln) {
		
		return $url;
	
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
			
		return $i;
	}
	
	function delDigit($str) {
		return preg_replace("/[0-9]{1}/", "", $str);
	
	function onlyDigit($str) {

		return preg_replace("/[^0-9]{1}/", "", $str);
	}