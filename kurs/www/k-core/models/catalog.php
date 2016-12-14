<?php

class Models_Catalog{


  //Массив с категориями продуктов
  public $categoryId = array();

  // Массив текущей категории
  public $currentCategory = array();

  // Фильтр пользователя 
  public $userFilter = array();


  public function getList($page = 1, $step = 5){
    
    //Если неудалось получить текущую категорию 
    if(!$this->getCurrentCategory()){
      echo 'Ошибка получения данных!';
      exit;
    }
    //вычисляет общее количество продуктов 
    $page = $page - 1;
    
    //формируем фильтр для продуктов, по имеющимся категориям, внутри выбранной     
    $filter = '';

   
    foreach($this->categoryId as $catId){
      $filter .= ' OR c.id = '.$catId;
    }    

    
    if('catalog' == $this->currentCategory['url']){ 
      // запрос вернет все товары внутри выбраной категории, а также внутри вложеных в нее категорий     
      $sql = '
        SELECT  p.id
        FROM product p
        LEFT JOIN category c
         ON c.id = p.cat_id
      ';
      $result = DB::query($sql);
    }else{

      $sql = 'SELECT  p.id
              FROM product p
              LEFT JOIN category c
              ON c.id = p.cat_id
              WHERE c.id = %d '.$filter;
      $result = DB::query($sql, end($this->categoryId));
    }

    $count = ceil(DB::numRows($result) / $step);

    if(0 >= $page){
      $page = 0;
    }

    if($page >= $count){
      $page = $count - 1;
    }

    $lowerBound = $page * $step;

    if(0 > $lowerBound){
      $lowerBound = 0;
    }

    if(empty($this->categoryId)){
      $sql = 'SELECT *
              FROM product
              ORDER BY id
              LIMIT %d , %d';
      $result = DB::query($sql, $lowerBound, $step);

    }else{
      $filter = '';

      if(!empty($this->categoryId)){

        foreach($this->categoryId as $catId){
          $filter .= ' OR c.id = '.$catId;
        }
      }

      if('catalog' == $this->currentCategory['url']){
        $sql = 'SELECT  c.url as category_url,
                        p.url as product_url,
                        p.*
                FROM product p
                LEFT JOIN category c
                ON c.id = p.cat_id
                ORDER BY id
                LIMIT %d , %d';
        $result = DB::query($sql, $lowerBound, $step);
      }else{
        $sql = 'SELECT  c.url as category_url,
                        p.url as product_url,
                        p.*
                FROM product p
                LEFT JOIN category c
                ON c.id = p.cat_id
                WHERE c.id = %d '.$filter.'
                ORDER BY id LIMIT %d , %d';
        $result = DB::query($sql, $this->categoryId[0], $lowerBound, $step);
      }
    }

    if(DB::numRows($result)){

      while($row = DB::fetchAssoc($result)){
        $сatalogItems[] = $row;
      }
    }

    $activPage = $page;

    $urlPage = $this->currentCategory['url'];

    if(1 < $count){
      /**
       * перебираем все страницы и формируем ссылки на них
       *
       */
      for($page = 0; $page < $count; $page++){
        ($activPage == $page) ? $class = 'activ' : $class = '';
        $pages .= '<a rel="pagination" page = "'.($page + 1).'" class = "'.$class.'" href = "#">'.($page + 1).'</a>';
      }

      $pages = '<div class = "pagination">Страница '.($activPage + 1).' из '.($count).' '.$pages.'</div>';
    }

    $сatalogItems['pagination'] = $pages;
    return $сatalogItems;
  }


  function getPageList($page = 1, $step = 5){

    if(!$this->getCurrentCategory()){
      echo "Ошибка получения данных!";
      exit;
    }

    $page = $page - 1;

    $filter = '';

    foreach($this->categoryId as $catId){
      $filter.= ' OR c.id = '.$catId;
    }

    if(isset($this->userFilter)){

      foreach($this->userFilter as $k => $v){

        if(empty($this->userFilter[$k])){
          unset($this->userFilter[$k]);
        }
      }
    }

    if(isset($this->userFilter['beginPrice']) ||
            isset($this->userFilter['endPrice'])){
      $beginPrice = $this->userFilter['beginPrice'];
      $endPrice = $this->userFilter['endPrice'];

      if(!empty($beginPrice) && !empty($endPrice)){
        $partSql = ' p.`price`>='.$beginPrice.' and p.`price`<='.$endPrice.' ';
      }

      if(!empty($beginPrice) && empty($endPrice)){
        $partSql = ' p.`price`>='.$beginPrice.' ';
      }

      if(empty($beginPrice) && !empty($endPrice)){
        $partSql = ' p.`price`<='.$endPrice.' ';
      }

      if(empty($beginPrice) && empty($endPrice)){
        $partSql = ' ';
      }

      unset($this->userFilter['beginPrice']);
      unset($this->userFilter['endPrice']);
    }

    if('catalog' == $this->currentCategory['url']){
      $filterFields = DB::buildPartQuery($this->userFilter, ' and ', 'p.');

      if($filterFields){
        $filterFields = 'WHERE '.$filterFields;
        if($partSql){
          $filterFields .= ' and '.$partSql;
        }
      }else{

        if($partSql){
          $filterFields .= 'WHERE '.$partSql;
        }
      }

      $sql = 'SELECT  p.id
              FROM product p
              LEFT JOIN category c
              ON c.id = p.cat_id '.$filterFields;
      $result = DB::query($sql);
    }else{

      $sql = 'SELECT  p.id
              FROM product p
              LEFT JOIN category c
              ON c.id = p.cat_id
              WHERE c.id = %d '.$filter;
      $result = DB::query($sql, end($this->categoryId));
    }
 $count = ceil(mysql_numRows($result) / $step);

    if(0 >= $page){
      $page = 0;
    }

    if($page >= $count){
      $page = $count - 1;
    }

    $lowerBound = $page * $step;

    if(0 > $lowerBound){
      $lowerBound = 0;
    }

    if(empty($this->categoryId)){
      $sql = 'SELECT  *
              FROM product
              ORDER BY id
              LIMIT %d , %d';
      $result = DB::query($sql, $lowerBound, $step);

    }else{
      $filter = '';

      if(!empty($this->categoryId)){

        foreach($this->categoryId as $catId){
          $filter .= ' OR c.id='.$catId;
        }
      }

      if('catalog' == $this->currentCategory['url']){
        $filterFields = DB::buildPartQuery($this->userFilter, ' and ', 'p.');

        if($filterFields){
          $filterFields = 'WHERE '.$filterFields;

          if($partSql){
            $filterFields .= ' and '.$partSql;
          }
        }else{
          if($partSql){
            $filterFields .= 'WHERE '.$partSql;
          }
        }
        $sql = 'SELECT  c.url as category_url,
                        p.url as product_url,
                        p.*
                FROM product p
                LEFT JOIN category c
                ON c.id = p.cat_id '.$filterFields.'
                ORDER BY id LIMIT %d , %d';
        $result = DB::query($sql, $lowerBound, $step);
      }else{
        $sql = 'SELECT  c.url as category_url,
                        p.url as product_url,
                        p.*
                FROM product p
                LEFT JOIN category c
                ON c.id = p.cat_id
                WHERE c.id = %d '.$filter.'
                ORDER BY id LIMIT %d , %d';
        $result = DB::query($sql, $this->categoryId[0], $lowerBound, $step);
      }
    }

    if(DB::numRows($result)){

      while($row = DB::fetchAssoc($result)){
        $сatalogItems[] = $row;
      }
    }
    $activPage = $page;

    $urlPage = $this->currentCategory['url'];

    if(1 < $count){

      for($page = 0; $page < $count; $page++){// перебираем все страницы и формируем ссылки на них
        ($activPage == $page) ? $class = 'activ' : $class = '';
        $pages .= '<a class = "'.$class.'" href = "/'.$urlPage.'?p='.($page + 1).'">'.($page + 1).'</a>';
      }

      $pages = '<div class = "pagination">Страница '.($activPage + 1).' из '.($count).' '.$pages.'</div>';
    }

    $сatalogItems['pagination'] = $pages;
    return $сatalogItems;
  }


  protected function getCurrentCategory(){
    $sql = 'SELECT url, title
            FROM category
            WHERE id = %d';

    if(end($this->categoryId)){
      $result = DB::query($sql, end($this->categoryId));

      if($this->currentCategory = DB::fetchAssoc($result)){
        return true;
      }
    }else{
      $this->currentCategory['url'] = 'catalog';
      $this->currentCategory['title'] = 'Каталог';
      return true;
    }
    return false;
  }

}

