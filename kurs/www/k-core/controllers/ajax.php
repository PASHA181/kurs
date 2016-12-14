<?php
class Controllers_Ajax extends BaseController{

  function __construct(){
    //Защита контролера от несанкционированного доступа вне админки
    if(!$this->checkAccess(User::getThis()->role)){
      return false;
    };

    K::disableTemplate();

    $url = URL::getQueryParametr('url');
    $type = URL::getQueryParametr('type');
    if(!$this->routeAction($url)){

      if('plugin' == $type){
        require_once SITE_DIR.'k-plugins/'.substr($url, 0, -4).'/'.$url;
      }
      require_once ADMIN_DIR.'section/controlers/'.$url;
      URL::setQueryParametr('view', ADMIN_DIR.'section/views/'.$url);
    }
  }

  public function routeAction($url){
    $parts = explode('/', $url);
    if($parts[0] == 'action'){
      $act = new Actioner();
      $act->runAction($parts[1]);
      return true;
    }
    return false;
  }

  public function checkAccess($role){
    if(!$role){
      header('HTTP/1.0 404 Not Found');
      URL::setQueryParametr('view', SITE_DIR.PATH_TEMPLATE.'/404.php');
      return false;
    }
    return true;
  }
}