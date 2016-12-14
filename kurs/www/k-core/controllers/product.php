<?php

class Controllers_Product extends BaseController{

  function __construct(){
    $model = new Models_Product;
    $product = $model->getProduct(URL::getQueryParametr('id'));
    $this->product = $product;
  }

}