<?php


class Application{

  //Конструктор запускает маршрутизатор и получает запрашиваемый путь
  public function __construct(){

      $this->getRoute();

  }


   //* Запуск движка системы

  public function Run(){
    /** Если найден контролер */
    if($controller = $this->getController()){
      $contr = new $controller;
      $type = 'view';
      $variables = $contr->variables;
      $view = $this->getView();
    }elseif($data = K::getPhpContent()){
      /** Если найден пользовательский php файл */
      $type = 'php';
    }elseif($data = K::getHtmlContent()){
      /** Если найден статический контент в БД */
      $type = 'html';
    }
    /** Если не существует запрашиваемых данных */
    $type = $type ? $type : '404';
    $result = array(
        'type' => $type,
        'data' => $data,
        'view' => $view,
        'variables' => $variables
    );
    return $result;
  }

  public function convertCpuCatalog(){
    $result = DB::query("
          SELECT  url as category_url, id
          FROM category
          WHERE url = '%s'", $this->route);

    if($obj = DB::fetchObject($result)){

      URL::setQueryParametr('category_id', $obj->id);
      return 'catalog';
    }
    return URL::getLastSection();
  }


  public function convertCpuProduct(){
    /** контролером будет последняя часть URI */
    $arraySections = URL::getSections();
    //Получаем id продукта по заданной секции
    $sql = 'SELECT  c.url as category_url, p.url as product_url, p.id
                FROM product p
                LEFT JOIN category c
                ON c.id=p.cat_id
                WHERE p.url like "%s"';
    $result = DB::query($sql, URL::getLastSection());

    if($obj = DB::fetchObject($result)){
      if($arraySections[1] == $obj->category_url){
        URL::setQueryParametr('id', $obj->id);
        return 'product';
      }
    }
    return URL::getLastSection();
  }


  private function getController(){

    /** Конвертируем обращение к контролеру админки в подобающий вид */
    if(URL::get('route') == 'k-admin'){
      $this->route = 'kadmin';
    }

    
    if(file_exists(CORE_DIR.'controllers/'.$this->route.'.php')){
      return 'controllers_'.$this->route;
    }
    return false;
  }

  private function getRoute(){
    $this->route = URL::getLastSection();
    
    if(empty($this->route)){
      $this->route = 'index';
      return $this->route;
    }

    if(URL::getCountSections() === 1){
      $this->route = $this->convertCpuCatalog();
    }else{
      $this->route = $this->convertCpuProduct();
    }
    return $this->route;
  }


  public function getView(){//получить представление для контролера
    $route = $this->route;
    // если работал контролер аякса то переменная должна получить путь до вида из дминки
    $view = URL::get('view');
    // если запрос не аяксовый то получаем из стандартной директории
    if(!$view){
      $pathView = 'views/';
      $view = $pathView.$route.'.php';
    }

    return $view;
  }

}