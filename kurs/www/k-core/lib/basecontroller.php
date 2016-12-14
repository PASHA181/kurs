<?php

class BaseController{


  private $variables;

  function __set($name, $val){
    $this->variables[$name] = $val;
  }

  function __get($name){
    return $this->variables;
  }

}