<?php


class Filter{

  public function __construct(){
    $this->begin_price = '<input style="width:60px;" type="text" name="begin_price" value="'.$_SESSION['user_filter']['begin_price'].'"/>';
    $this->end_price = '<input style="width:60px;" type="text" name="end_price" value="'.$_SESSION['user_filter']['end_price'].'"/>';
    $result = DB::query('SELECT distinct(`material`) FROM  `product` WHERE `material` NOT LIKE "" ');

    while($row = DB::fetchArray($result)){
      $this->materials[] = $row['material'];
    }

    if(isset($this->materials))
      sort($this->materials);
    $this->select_materials = '<select name="material">';
    $this->select_materials .= $this->generate_list($this->materials, $_SESSION['user_filter']['material']);
    $this->select_materials .= '</select>';
    $result = DB::query('SELECT distinct(`factory`) FROM  `product` WHERE `factory` NOT LIKE "" ');

    while($row = DB::fetchArray($result)){
      $this->factory[] = $row['factory'];
    }

    if(isset($this->factory)){
      sort($this->factory);
    }

    $this->select_factory = '<select name="factory">';
    $this->select_factory .= $this->generate_list($this->factory, $_SESSION['user_filter']['factory']);
    $this->select_factory .= '</select>';
    $result = DB::query('SELECT distinct(`color`) FROM  `product` WHERE `color` NOT LIKE "" ');

    while($row = DB::fetchArray($result)){
      $this->color[] = $row['color'];
    }

    if(isset($this->color)){
      sort($this->color);
    }

    $this->select_color = '<select name="color">';
    $this->select_color .= $this->generate_list($this->color, $_SESSION['user_filter']['color']);
    $this->select_color .= '</select>';
    $result = DB::query('SELECT distinct(`destination`) FROM  `product` WHERE `destination` NOT LIKE "" ');

    while($row = DB::fetchArray($result)){
      $this->destination[] = $row['destination'];
    }

    if(isset($this->destination)){
      sort($this->destination);
    }

    $this->select_destination = '<select name="destination">';
    $this->select_destination .= $this->generate_list($this->destination, $_SESSION['user_filter']['destination']);
    $this->select_destination .= '</select>';
    $result = DB::query('SELECT distinct(`size`) FROM  `product` WHERE `size` NOT LIKE "" ');

    while($row = DB::fetchArray($result)){
      $this->size[] = $row['size'];
    }

    if(isset($this->size)){
      sort($this->size);
    }

    $this->select_size = '<select name="size">';
    $this->select_size .= $this->generate_list($this->size, $_SESSION['user_filter']['size']);
    $this->select_size .= '</select>';
    $result = DB::query('SELECT distinct(`type`) FROM  `product` WHERE `type` NOT LIKE "" ');

    while($row = DB::fetchArray($result)){
      $this->type[] = $row['type'];
    }

    if(isset($this->type)){
      sort($this->type);
    }

    $this->select_type = '<select name="type">';
    $this->select_type .= $this->generate_list($this->type, $_SESSION['user_filter']['type']);
    $this->select_type .= '</select>';
    $result = DB::query('SELECT distinct(`country`) FROM  `product` WHERE `country` NOT LIKE "" ');

    while($row = DB::fetchArray($result)){
      $this->country[] = $row['country'];
    }

    if(isset($this->country)){
      sort($this->country);
    }

    $this->select_country = '<select name="country">';
    $this->select_country .= $this->generate_list($this->country, $_SESSION['user_filter']['country']);
    $this->select_country .= '</select>';
    $result = DB::query('SELECT distinct(`surface`) FROM  `product` WHERE `surface` NOT LIKE "" ');

    while($row = DB::fetchArray($result)){
      $this->surface[] = $row['surface'];
    }

    if(isset($this->surface)){
      sort($this->surface);
    }

    $this->select_surface = '<select name="surface">';
    $this->select_surface .= $this->generate_list($this->surface, $_SESSION['user_filter']['surface']);
    $this->select_surface .= '</select>';
    $result = DB::query('SELECT distinct(`picture`) FROM  `product` WHERE `picture` NOT LIKE "" ');

    while($row = DB::fetchArray($result)){
      $this->picture[] = $row['picture'];
    }

    if(isset($this->picture)){
      sort($this->picture);
    }

    $this->select_picture = '<select name="picture">';
    $this->select_picture .= $this->generate_list($this->picture, $_SESSION['user_filter']['picture']);
    $this->select_picture .= '</select>';
    $result = DB::query('SELECT distinct(`style`) FROM  `product` WHERE `style` NOT LIKE "" ');

    while($row = DB::fetchArray($result)){
      $this->style[] = $row['style'];
    }

    if(isset($this->style)){
      sort($this->style);
    }

    $this->select_style = '<select name="style">';
    $this->select_style .= $this->generate_list($this->style, $_SESSION['user_filter']['style']);
    $this->select_style .= '</select>';
  }

  public function generate_list($array, $checked){

    if(!$checked){
      $check = 'selected';
    }

    $html .= '<option'.$check.' value=""></option>';
    $check = '';

    if(isset($array)){

      foreach($array as $option){

        if($option == $checked){
          $check = 'selected';
        }

        $html .= '<option'.$check.'value="'.$option.'">'.$option.'</option>';
        $check = '';
      }
    }
    return $html;
  }

}