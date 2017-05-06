<?php

	function db_select($query='', $mode=BD_MODE_BYORDER, $idx='' , $noTotal=false){
		global $lnk;
		$return=array(); 
		if (!$result = mysqli_query($lnk, $query)){  
			return false;
		}       
		if (mysqli_num_rows($result)>0)
			while( $row = mysqli_fetch_assoc($result)){				if ($mode==BD_MODE_BYID)
					$return[$row['id']]=$row;
				elseif ($mode==BD_MODE_BYORDER) 
					$return[]=$row;
			}
  		else $return=false;
		mysqli_free_result($result);      
  		return $return;
	}      
	
	function db_selectOne($query='', $mode=BD_MODE_BYORDER){
		global $lnk;
		$row=array();              
		if (!$result = mysqli_query($lnk, $query)){  
			return false;
		}
		$row = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
  		return $row;
	}            
	
	function db_insert($table='', $record=array()){ 
		global $lnk;
		$query='INSERT INTO `'.$table.'` (';
		$fields='`'.implode('`,`',array_keys($record)).'`';
		$values='"'.implode('","',array_values($record)).'"';
		$query.=$fields.') VALUES ('.$values.')';   
		if (!$result = mysqli_query($lnk, $query)){  
			return false;      
		}  
		return mysqli_insert_id($lnk); 
	}    
	
	function db_update($table='', $record=array(),$key=array('id')){ 
		global $lnk;
		$keys=array();
		$query='UPDATE `'.$table.'` SET ';
		$where=' WHERE ';
  		if (count($record)>0)
  			foreach ($record as $k=>$v)
  				if (!in_array($k,$key)) $query.='`'.$k.'`="'.( get_magic_quotes_gpc() ? $v : addslashes($v)) .'", ';
  					else $where.='`'.$k.'`="'.( get_magic_quotes_gpc() ? $v : addslashes($v)).'" AND ';
  		$query=substr($query,0,-2);
  		$where=substr($where,0,-4);
  		$query.=$where;          
		if (!$result = mysqli_query($lnk, $query)){			return false;      
		}  
		return true; 
	}            
	
	// Проверка записи на уникальность
	// $params что ищем
	// $ignore что исключить из поиска     
    // например $params = array('email'=> '51@mail.ru', 'login' => 'коля', ...) 
	function db_unique($table, array $params, array $ignore)
	{
		$sql = 'SELECT count(*) as cnt FROM `'. $table .'`';    
        $sql .= ' where ';     
        // первое условие. Для $params  
        $sql .= db_progonka($params); 
		// второе условие. Для $ignore     
		if (count($ignore) > 0) 
		{
			$sql .= ' AND '; 
			$sql .= db_progonka($ignore,true); 
		}              
		$result = db_selectOne($sql);  
		if (!$result['cnt'])
			return 1; // запись уникальна 	
		else 
			return 0; // запись не уникальна 	
	}   
	
	function db_progonka(array $mass, $ignore=false) 
	{  
		$sql = "";
		foreach ($mass as $k => $v)
		{
			if (!$ignore)
				$sql .= '`'. $k .'` = \''. $v .'\'';	
			else	
				$sql .= '`'. $k .'` <> \''. $v .'\'';	 
			if ($v != end($mass)) $sql .= ' AND ';        
		} 
		return $sql;    
	}    
	