<?php


class DB{

  static private $_instance = null;


  private function __construct(){
    $this->connect = mysql_connect(HOST, USER, PASSWORD) or die('Невозможно установить соединение'.mysql_error());

    mysql_select_db(NAME_BD, $this->connect) or die('Невозможно выбрать указанную базу'.mysql_error());
  }

  private function __clone(){

  }

  private function __wakeup(){

  }

  public static function buildPartQuery($array, $devide = ','){
    $partQuery = '';

    if(is_array($array)){
      $partQuery = '';
      foreach($array as $index => $value){
        $partQuery .= sprintf(' `%s` = "%s"'.$devide, $index, mysql_real_escape_string($value));
      }
      $partQuery = trim($partQuery, $devide);
    }
    return $partQuery;
  }

  public static function buildQuery($query, $array, $devide = ','){

    if(is_array($array)){
      $partQuery = '';

      foreach($array as $index => $value){
        $partQuery .= sprintf(' `%s` = "%s"'.$devide, $index, mysql_real_escape_string($value));
      }

      $partQuery = trim($partQuery, $devide);
      $query .= $partQuery;
      return self::query($query);
    }
    return false;
  }

  public static function fetchArray($object){
    return @mysql_fetch_array($object);
  }

  public static function fetchAssoc($object){
    return @mysql_fetch_assoc($object);
  }

  public static function fetchObject($object){
    return @mysql_fetch_object($object);
  }


  static public function getInstance(){
    if(is_null(self::$_instance)){
      self::$_instance = new self;
    }
    return self::$_instance;
  }

  public static function init(){
    self::getInstance();
    DB::query('SET names utf8');
  }


  public static function insertId(){
    return @mysql_insert_id();
  }


  public static function numRows($object){
    return @mysql_num_rows($object);
  }

  public static function query($sql){

    if(($num_args = func_num_args()) > 1){
      $arg = func_get_args();
      unset($arg[0]);
      foreach($arg as $argument => $value){
        $arg[$argument] = mysql_real_escape_string($value);
      }

      $sql = vsprintf($sql, $arg);
    }
    $obj = self::$_instance;

    if(isset($obj->connect)){
      $obj->count_sql++;
      $startTimeSql = microtime(true);
      $result = mysql_query($sql) or die('<br/><span style="color:red">Ошибка в SQL запросе:</span> '.mysql_error());
      $timeSql = microtime(true) - $startTimeSql;
      return $result;
    }
    return false;
  }

}