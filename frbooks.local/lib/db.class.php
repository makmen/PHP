<?php
/**
* @brief Класс для работы с базой данных
* @detailed При любом обращении к функциям класса происходит подключение файла и запуск функции init с параметрами, объявленными в константах DB_HOST,DB_PORT,DB_NAME,DB_USER,DB_PASS.
Перед любым запросом также происходит проверка наличия соединения с базой и в случае его обрыва попытка переподключиться.
*/

define('BD_MODE_BYID', 1);
define('BD_MODE_BYORDER', 2);

class db {
	private static $dbH=Array();
	private static $host=Array();
	private static $port=Array();
	private static $dbName=Array();
	private static $user=Array();
	private static $pass=Array();
	private static $idx='default';
	private static $defIdx;

	/**
	* @brief Количество результатов запроса.
        * @detailed Количество результатов последнего select запроса. В случае ошибки запроса выставляется в 0.
        * @var integer $total 
        */
	public static $total;
	private function __construct($serv, $conn) {

	}
	/**
	* Деструктор закрывает соединение {@link $dbH}
	*/
	function __destruct() {
            foreach (self::$dbH as $k=>$v) mysql_close(self::$dbH[$k]);
	}
	/**
	* @brief Функция инициализации.
	* @detailed Функция запускается автоматически при инклуде файла, т.к. в конце файла, вне класса, стоит её вызов.
				Функция не создает подключение к базе даных, она только выставляет переменные для класса.
				Подключение контролируется автоматически при вызове методов работы с запросами.
	* @param string $host хост подключения
	* @param string $port порт подключения
	* @param string $dbName имя базы данных
	* @param string $user пользователь
	* @param string $pass пароль
	* @return void
	*/
	public static function init($host='localhost',$port='3306',$dbName='',$user='',$pass='',$idx=''){
            if (!isSet(self::$defIdx)) {
                self::$defIdx=self::$idx;
            }
            $idx = ($idx=='') ? self::$idx : $idx;
            self::$host[$idx]=$host;
            self::$port[$idx]=$port;
            self::$dbName[$idx]=$dbName;
            self::$user[$idx]=$user;
            self::$pass[$idx]=$pass;
	}
        
	public static function errors(&$idx=''){
            $idx=$idx==''?self::$idx:$idx;
            $return='';
            if( $error = mysql_errno(self::$dbH[$idx]) ){
                $return.='SQL Error '.$error;
                $return.=' : '.mysql_error(self::$dbH[$idx]);
            }
            
            return $return;
	}
	/**
	* @brief Выполнение запроса.
	* @detailed Функция выполняет запрос, переданный во входящем параметре.
	* @param string $query текст запроса
	* @return resource Id - указатель на результат выполнения запроса
	*/
	public static function execute($query='',&$idx=''){
            $idx=$idx==''?self::$idx:$idx;
            $result = false;
            if ($conn=self::getConnection($idx)) {
                $result = mysql_query($query,$conn);
            } 
            
            return $result;
	}
	/**
	* @brief Выбор нескольких записей.
	* @detailed Функция выполняет запрос, переданный во входящем параметре и возвращает массив результатов его выполнения.
	* Общее количество строк в результате устанавливается в переменную db#total.
	* @param string $query текст запроса
	* @return array массив результатов
	*/
	public static function select($query='', $mode=BD_MODE_BYORDER, $idx='', $calcTotal = TRUE){
            $return=array();
            if ($result = self::execute(str_ireplace(Array('-select'),Array('SELECT ' . ($calcTotal ? 'SQL_CALC_FOUND_ROWS' : '') . ' '),'-'.trim($query)),$idx)){
                if (mysql_num_rows($result)>0){
                    while( $row = mysql_fetch_assoc($result)) if ($mode==BD_MODE_BYID) $return[$row['id']]=$row; elseif ($mode==BD_MODE_BYORDER) $return[]=$row;
                } else {
                    $return=false;
                }
                mysql_free_result($result);
                // self::ttl($idx);
            }
            
            return $return;
	}
        
	private static function ttl($idx=''){
            if ($result=self::execute('SELECT FOUND_ROWS() as cnt',$idx)){
                $row = mysql_fetch_assoc($result);
                mysql_free_result($result);
                self::$total[$idx] = $row['cnt'];
            } else self::$total[$idx]=0;
	}
	/**
	* @brief Выбор одной записи.
	* @detailed Функция выполняет запрос, переданный во входящем параметре и возвращает ассоциативный массив, содержащий выбранную строку.
	* @param string $query текст запроса
	* @return array аcсоциативный массив
	*/
	public static function selectOne($query='',$idx=''){
            $row=array();
            if ($result=self::execute($query,$idx)){
                $row = mysql_fetch_assoc($result);
                mysql_free_result($result);
            } else {
                $return=false;
            }
            
            return $row;
	}
	/**
	* @brief Выбор одного значения.
	* @detailed Функция выполняет запрос, переданный во входящем параметре и значение, полученное из базы. ВНИМАНИЕ! Если в результате выполнения ничего не нашло, функция вернет NULL. Нельзя сравнивать результат функции с False при проверке наличия результата запроса, т.к. False может быть непосредственно самим возвращаемым значением.
	* @param string $query текст запроса
	* @return array аcсоциативный массив
	*/
	public static function selectOneValue($query='',$idx=''){
            $row=array();
            if ($result=self::execute($query,$idx)){
                $row = mysql_fetch_row($result);
                mysql_free_result($result);
            } else return NULL; /* !ВНИМАТЕЛЬНО */
            return $row[0];
	}
	/**
	* @brief Выбор данных в строку.
	* @detailed Функция предназначена для выбора одного поля из множества данных в виде одноразмерного массива.
	* @param string $query текст запроса
	* @return array массив результатов
	*/
	public static function selectLine($query='',$idx=''){
            $return=array();
            if ($result=self::execute($query,$idx)){
                while( $row = mysql_fetch_assoc($result))
                    if (count($row)>0) foreach ($row as $v) $return[]=$v;
                mysql_free_result($result);
            }
            
            return $return;
	}
	/**
	* @brief Обновление данных.
	* @detailed Функция предназначена для обновления записи в таблице по одному/нескольким ключам.
				По-умолчанию обновляет данные по ключу id.
				Переданные для обновления данные должны содержать непустые ключевые поля.
	* @param string $table таблица
	* @param array $record ассоциативный массив данных для записи
	* @param array $key линейный массив, содержащий имена ключевых полей
	* @return boolean логический результат выполнения операции
	*/
	public static function update($table='',$record=array(),$key=array('id'),$idx=''){
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
            if (!$result=self::execute($query,$idx)) {
                return false;
            }
            
            return true;
	}
	/**
	* @brief Вставка данных.
	* @detailed Функция предназначена для вставки записи в таблицу. 
				В случае если в переданном массиве данных для вставки ключевое поле будет не пустым, оно уничтожится, и данные все равно будут вставлены как новые.
				Данные в функцию передаются по ссылке, в случае успешного выполнения в данные дописывается новое полученное значение ключевого поля.
	* @param string $table таблица
	* @param array $record ассоциативный массив данных для записи
	* @param string $key наименование ключевого поля
	* @return boolean логический результат выполнения операции
	*/
	public static function insert($table='',&$record=array(),$key='id',$idx=''){
            $query='INSERT INTO `'.$table.'` (';
            $fields='`'.implode('`,`',array_keys($record)).'`';
            $values='"'.implode('","',array_values($record)).'"';
            $query.=$fields.') VALUES ('.$values.')';

            if ($conn=self::getConnection($idx)) {
                if ($result = self::execute($query, $idx)){
                    $record[$key] = mysql_insert_id(self::$dbH[$idx]);
                    return true;
                } else {
                    return false;
                }
            }
            
            return false;
	}

	public static function change($idx=''){
		self::$idx=$idx==''?self::$defIdx:$idx;
	}
	public static function total($idx=''){
		$idx=$idx==''?self::$idx:$idx;
		return self::$total[$idx];
	}
	public static function getConnection(&$idx=''){
            $idx=$idx==''?self::$idx:$idx;
            if (
                self::$dbH[$idx] === null ||
                self::$dbH[$idx] === false ||
                (
                    !is_null(self::$dbH[$idx]) &&
                    self::$dbH[$idx] != false &&
                    !mysql_ping(self::$dbH[$idx])
                )
            ) {
                if (!self::$dbH[$idx]=mysql_connect(self::$host[$idx].":".self::$port[$idx], self::$user[$idx], self::$pass[$idx], true)){

                } elseif (!mysql_select_db(self::$dbName[$idx], self::$dbH[$idx])) {

                } else {
                    mysql_query("set character_set_client='utf8'", self::$dbH[$idx]);
                    mysql_query("set character_set_results='utf8'", self::$dbH[$idx]);
                    mysql_query("set collation_connection='utf8_general_ci'", self::$dbH[$idx]);
                }
            }
            
            return self::$dbH[$idx];
	}

}