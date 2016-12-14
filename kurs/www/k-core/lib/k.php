<?php

class K{

  static private $_instance = null;
  private $_registry = array();

  private function __construct(){
    session_start();/** Старт сессии */
    K::enableTemplate();/** Включение пользовательского шаблона */
    $category = new Category();
    $this->_registry['category'] = $category;
  }

  private function __clone(){

  }

  private function __wakeup(){

  }

  public static function defenderXss($arr){
    $filter = array('<', '>');

    foreach($arr as $num => $xss){
      $arr[$num] = str_replace($filter, '|', trim($xss));
    }

    return $arr;
  }

  public static function disableTemplate(){
    $_SESSION['noTemplate'] = true;
  }

  public static function enableTemplate(){
    $_SESSION['noTemplate'] = false;
  }

  static public function get($key){
    return self::getInstance()->_registry[$key];
  }

  public static function getBuffer($include, $html = false, $variables = false){

    if(!empty($variables)){
      extract($variables);
    }
    ob_start();

    if($html){
      echo $include;
    }else{
      include $include;
    }

    K::templateFooter();
    $buffer = ob_get_contents();
    ob_end_clean();
    K::templateHeader();
    return $buffer;
  }

  public static function getConfigIni(){
    if(file_exists(SITE_DIR.'/config.ini')){
      $config = parse_ini_file(SITE_DIR.'/config.ini', true);
      define('HOST', $config['DB']['HOST']);          /* Сервер */
      define('USER', $config['DB']['USER']);          /* Пользователь */
      define('PASSWORD', $config['DB']['PASSWORD']);  /* Пароль */
      define('NAME_BD', $config['DB']['NAME_BD']);    /* База */
      return true;
    }
    return false;
  }

  public static function getHtmlContent(){
    $result = DB::query('
      SELECT  html_content
      FROM page
      WHERE url="'.URL::getLastSection().'.html"
    ');

    if($html = DB::fetchArray($result)){
      return $html['html_content'];
    }
    return false;
  }

  static public function getInstance(){
    if(is_null(self::$_instance)){
      self::$_instance = new self;
    }
    return self::$_instance;
  }

  public static function getMenu(){
    return Menu::getMenu();
  }

  public static function getPhpContent(){

    if(file_exists(PAGE_DIR.URL::getLastSection().'.php')){
      return PAGE_DIR.URL::getLastSection().'.php';
    }
    return false;
  }

  public static function getSmalCart(){
    return SmalCart::getCartData();
  }

  public static function init(){

    $result = DB::query('
      SELECT  *
      FROM setting
      WHERE active="Y"'
    );
    $settings = new stdClass();
    while($row = DB::fetchArray($result)){
      $settings->$row['option'] = isset($row['value'])?$row['value']:"";
    }

    K::set('settings', $settings);
    K::setDifinePathTemplate(K::get('settings')->templateName);
  }


  public static function loger($text, $mode = 'a+'){
    $date = date('Y_m_d');
    $fileName = 'log_'.$date.'.txt';
    $string = date('d.m.Y H:i:s').' =>'.$text."\r\n";
    $f = fopen($fileName, $mode);
    fwrite($f, $string);
    fclose($f);
  }

  public static function printGui($data){

    switch($data['type']){
      case 'view':{
          return K::getBuffer($data['view'], false, $data['variables']);
        }
      case 'php':{
          return K::getBuffer($data['data'], false);
        }
      case 'html':{
          return K::getBuffer($data['data'], true);
        }
      case '404':{
          header('HTTP/1.0 404 Not Found');
          K::titlePage('Ошибка 404');
          $path404 = SITE_DIR.PATH_TEMPLATE.'/404.php';
    
          if(!file_exists($path404)){
            $path404 = SITE_DIR.'/k-templates/.default/404.php';
          }
          return K::getBuffer($path404);
        }
    }

    return false;
  }

  public static function printHead(){
    $title = !$title ? K::get('settings')->title : K::get('settings')->sitename;
    echo '
        <!--Заголовки определенные движком-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>'.K::get('settings')->sitename.' | '.$title.'</title>
        <link rel="stylesheet" href="'.PATH_TEMPLATE.'/css/style.css" type="text/css" />
        <link rel="stylesheet" href="/k-admin/design/style-adminbar.css" type="text/css" />
        <script type="text/javascript" src="/k-core/script/jquery-1.7.2.min.js"></script>
        <!--/Заголовки определенные движком-->
        ';
  }

  static public function set($key, $object){
    self::getInstance()->_registry[$key] = $object;
  }

  public static function setDifinePathTemplate($template = '.default'){
    $pathTemplate = '/k-templates/'.$template;
    $path = SITE_DIR.$pathTemplate.'/css/style.css';

    if(!file_exists($path)){
      $pathTemplate = '/k-templates/.default';
    }
    define('PATH_TEMPLATE', $pathTemplate);
  }

  public static function templateFooter(){
    $footerPath = SITE_DIR.PATH_TEMPLATE.'/footer.php';
    
    if(!file_exists($footerPath)){
      $footerPath = SITE_DIR.'/k-templates/.default/footer.php';
    }
    
    if(!$_SESSION['noTemplate']){
      require_once $footerPath;
    }
  }

  public static function templateHeader(){
    $headerPath = SITE_DIR.PATH_TEMPLATE.'/header.php';
    
    if(!file_exists($headerPath)){
      $headerPath = SITE_DIR.'/k-templates/.default/header.php';
    }
    
    if(!$_SESSION['noTemplate']){
      $smal_cart = K::getSmalCart();
      $categoryList = K::get('category')->getCategoryListUl();
      /** Подключение файла шапки */
      require_once $headerPath;
      /** Подключение админ панели */
      if(1 == User::getThis()->role){
        require_once ADMIN_DIR.'/adminbar.php';
      }
    }
  }

  public static function titlePage($title){
    K::get('settings')->title = $title;
  }

  public static function translitIt($str){
    $tr = array(
        'А' => 'a', 'Б' => 'b', 'В' => 'v', 'Г' => 'g',
        'Д' => 'd', 'Е' => 'e', 'Ж' => 'j', 'З' => 'z', 'И' => 'i',
        'Й' => 'y', 'К' => 'k', 'Л' => 'l', 'М' => 'm', 'Н' => 'n',
        'О' => 'o', 'П' => 'p', 'Р' => 'r', 'С' => 's', 'Т' => 't',
        'У' => 'u', 'Ф' => 'f', 'Х' => 'h', 'Ц' => 'ts', 'Ч' => 'ch',
        'Ш' => 'sh', 'Щ' => 'sch', 'Ъ' => '', 'Ы' => 'yi', 'Ь' => '',
        'Э' => 'e', 'Ю' => 'yu', 'Я' => 'ya', 'а' => 'a', 'б' => 'b',
        'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ж' => 'j',
        'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
        'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h',
        'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => 'y',
        'ы' => 'yi', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
        ' ' => '_', '.' => '', '/' => '_', '1' => '1', '2' => '2',
        '3' => '3', '4' => '4', '5' => '5',
        '6' => '6', '7' => '7', '8' => '8', '9' => '9', '0' => '0');
    return strtr($str, $tr);
  }


  public static function redirect($location){
      header('Location: '.$location);
  }
}