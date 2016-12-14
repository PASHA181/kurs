<?php
class Controllers_Catalog extends BaseController{


  function __construct(){

    $_REQUEST['category_id']=URL::getQueryParametr('category_id');
    if($_REQUEST['inCartProductId']){
      $cart = new Models_Cart;
      $cart->addToCart($_REQUEST['inCartProductId']);
      SmalCart::setCartData();
      header('Location: /cart');
      exit;
    }

    if(isset($_POST['resetFilter'])){
      $_POST['filter'] = '';
      unset($_POST['resetFilter']);
    }
    $page = 1;
    $step = K::get('settings')->countСatalogProduct;

    if(!is_numeric($step) || 1 > $step){
      $step = 1;
    }

    if(isset($_REQUEST['p'])){
      $page = $_REQUEST['p'];
    }
    $model = new Models_Catalog;
    $model->categoryId = K::get('category')->getCategoryList($_REQUEST['category_id']);
    $model->categoryId[] = $_REQUEST['category_id'];

    if(isset($_POST['filter'])){
      unset($_POST['filter']);
      $model->userFilter = $_POST;
      $_SESSION['user_filter'] = $_POST;
    }else{
      $model->userFilter = $_SESSION['user_filter'];
    }

    $items = $model->getPageList($page, $step);
    $this->pager = $items['pagination'];
    unset($items['pagination']);
    $this->titeCategory = $model->currentCategory['title'];
    $this->items = $items;
  }

}