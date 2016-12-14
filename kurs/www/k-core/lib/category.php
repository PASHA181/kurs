<?php


class Category{

  private $categories;

  public function __construct(){
    $result = DB::query('SELECT * FROM `category` ORDER BY id');

    while($row = DB::fetchArray($result)){
      $this->categories[] = $row;
    }
  }

  public function addCategory($array){
    $array['url'] = K::translitIt($array['title']);

    if(strlen($array['url']) > 60){
      $array['url'] = substr($array['url'], 0, 60);
    }

    if(DB::buildQuery('INSERT INTO category SET ', $array)){
      $id = DB::insertId();
      return $id;
    }

    return false;
  }

  public function editCategory($id, $array){
    $array['url'] = K::translitIt($array['title']);

    if(strlen($array['url']) > 60){
      $array['url'] = substr($array['url'], 0, 60);
    }

    if(DB::query('
      UPDATE category
      SET '.DB::buildPartQuery($array).'
      WHERE id = %d', $id)){
      return true;
    }

    return false;
  }

  public function delCategory($id){
    $categories = $this->getCategoryList($id);
    $categories[] = $id;

    foreach($categories as $categoryID){
      DB::query('
        DELETE FROM category
        WHERE id = %d
      ',
      $categoryID);
    }

    return true;
  }

    public function getCategoryListUl($parent = 0, $type = 'public'){

    foreach($this->categories as $category){

      if($parent == $category['parent']){

        if('admin' == $type){
          $print.= '<li><a href="#" rel="CategoryTree"
            id="'.$category['id'].'"
            parent_id="'.$category["parent"].'">'.$category['title'].'
          </a>';
        }

        if('public' == $type){
          $print.= '<li><a href="/'.$category['url'].'">'.$category['title'].'</a>';
        }

        foreach($this->categories as $sub_category){

          if($category['id'] == $sub_category['parent']){
            $flag = true;
            break;
          }
        }

        if($flag){
          $sub_menu = '
            <ul class="sub_menu">
              [li]
            </ul>';
          $li = $this->getCategoryListUl($category['id'], $type);

          // если вложенных категорий 0, то не создаем для них UL
          $print .= strlen($li)>0 ? str_replace('[li]', $li, $sub_menu) : "";

          $print .= '</li>';
        }else{
          $print .= '</li>';
        }
      }
    }
    return $print;
  }

  public function getChildCategoryIds($parentId = 0){
    $result = array();

    $res = DB::query('
      SELECT id
      FROM `category`
      WHERE parent = %d
      ORDER BY id
    ',
      $parentId);

    while($row = DB::fetchArray($res)){
      $result[] = $row['id'];
    }

    return $result;
  }

  public function getCategoryList($parent = 0){

    foreach($this->categories as $category){

      if($parent == $category['parent']){
        $this->listCategoryId[] = $category['id'];
        $this->getCategoryList($category['id']);
      }
    }
    return $this->listCategoryId;
  }

  public function getCategoryTitleList(){

    foreach($this->categories as $category){
      $titleList[$category['id']] = $category['title'];
    }

    return $titleList;
  }

  public function getHierarchyCategory($parent = 0){
    $catArray = array();
    foreach($this->categories as $category){
      if($parent == $category['parent']){
        $child = $this->getHierarchyCategory($category['id']);

        if(!empty($child)){
          $array = $category;
          $array['child'] = $child;
        }else{
          $array = $category;
        }

        $catArray[] = $array;
      }
    }
    return $catArray;
  }

  public function getTitleCategory($arrayCategories, $selectCaegory = 0){
    global $lvl;

    foreach($arrayCategories as $category){
      $select = '';
      if($selectCaegory == $category['id']){
        $select = 'selected = "selected"';
      }
      $option .= '<option value='.$category['id'].' '.$select.' >';
      $option .= str_repeat('-', $lvl);
      $option .= $category['title'];
      $option .= '</option>';

      if(isset($category['child'])){
        $lvl++;
        $option .= $this->getTitleCategory($category['child']);
        $lvl--;
      }
    }
    return $option;
  }

}