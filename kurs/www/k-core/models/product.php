<?php


class Models_Product{


  public function addProduct($array){
    $array['url'] = K::translitIt($array['name']);

    if(strlen($array['url']) > 60){
      $array['url'] = substr($array['url'], 0, 60);
    }
    $dublicatUrl = false;
    $tempArray = $this->getProductByUrl($array['url']);
    if(!empty($tempArray)){
      $dublicatUrl = true;
    }

    if(DB::buildQuery('INSERT INTO product SET ', $array)){
      $id = DB::insertId();
      //если url дублируется, то дописываем к нему id producta
      if($dublicatUrl){
        $this->updateProduct(array('url'=>$array['url'].'_'.$id), $id);
      }
      return $id;
    }

    return false;
  }


  public function updateProduct($array, $id){

    if(DB::query('
      UPDATE product
      SET '.DB::buildPartQuery($array).'
      WHERE id = %d', $id)){
      return true;
    }

    return false;
  }


  public function deleteProduct($id){

    if(DB::query('
      DELETE
      FROM product
      WHERE id = %d', $id)){
      return true;
    }
    return false;
  }


  public function getProduct($id){

    $result = DB::query('
      SELECT *
      FROM `product`
      WHERE id = %d', $id);

    if(!empty($result)){

      if($product = DB::fetchArray($result)){
        return $product;
      }else{
        return array();
      }
    }
  }


  public function getProductByUrl($url){

    $result = DB::query('
      SELECT *
      FROM `product`
      WHERE url = "%s"', $url);

    if(!empty($result)){
      if($product = DB::fetchArray($result)){
        return $product;
      }
    }
    return array();
  }

  public function getProductPrice($id){
    $result = DB::query('
      SELECT price
      FROM product
      WHERE id = %d', $id);

    if($row = DB::fetchObject($result)){
      return $row->price;
    }

    return false;
  }

}