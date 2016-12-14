<?php


class URL{

  static private $_instance = null;

  private function __construct(){
    $_REQUEST['route'] = str_replace('.html','',$_REQUEST['route']);
    // если данные пришли не из админки а от пользователей
    if(strpos($_REQUEST['route'],'k-admin')===false){
      $_REQUEST = K::defenderXss($_REQUEST);
      $_POST = K::defenderXss($_POST);
      $_GET = K::defenderXss($_GET);
    }



    $this->queryParams = $_REQUEST;
  }

  private function __clone(){

  }

  private function __wakeup(){

  }


  public static function createUrl($urlstr){

    if(preg_match('/[^A-Za-z0-9_\-]/', $urlstr)){
      $urlstr = translitIt($urlstr);
      $urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
      return $urlstr;
    }
    return false;
  }

  public static function get($param){
    return self::getQueryParametr($param);
  }

  public static function getClearUri(){
    $data = self::getDataUrl();
    return $data['path'];
  }

  public static function getCountSections(){
    $sections = self::getSections();
    return count($sections) - 1;
  }

  public static function getDataUrl($url = false){
    if(!$url){
      $url = URL::getUrl();
    }
    return parse_url($url);
  }

  static public function getInstance(){
    if(is_null(self::$_instance)){
      self::$_instance = new self;
    }
    return self::$_instance;
  }

  public static function getLastSection(){
    $sections = self::getSections();

    $lastSections = $sections[(count($sections) - 1)];
    // если  главная страница
    if(!$lastSections && count($sections)==2){
      $lastSections='index';
    }
    return str_replace('.html','',$lastSections);
  }

  public static function getQueryParametr($param){
    $params = self::getInstance()->queryParams;
    return $params[$param];
  }

  public static function getQueryString(){
    return $_SERVER['QUERY_STRING'];
  }

  public static function getSections(){
    $uri = self::getClearUri();
    $sections = explode('/', $uri);
    return $sections;
  }

  public static function getUri(){
    return $_SERVER['REQUEST_URI'];
  }

  public static function getUrl(){
    return 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  }

  public static function init(){
    self::getInstance();
  }

  public static function post($param){
    return self::getQueryParametr($param);
  }

  public static function setQueryParametr($param, $value){
    self::getInstance()->queryParams[$param] = $value;
  }

}