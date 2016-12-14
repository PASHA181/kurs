<?php

$path =     $path = SITE_DIR.'uploads/';

$validFormats = array('jpg', 'png', 'gif', 'bmp');
if(isset($_POST) && 'POST' == $_SERVER['REQUEST_METHOD']){

  if(!empty($_FILES['photoimg'])){
    $file_array = $_FILES['photoimg'];
  }else{
    $file_array = $_FILES['edit_photoimg'];
  }

  $name = $file_array['name'];
  $size = $file_array['size'];

  if(strlen($name)){
    list($txt, $ext) = explode('.', $name);
    if(in_array($ext, $validFormats)){
      if($size < (1024 * 1024)){
        $actualImageName = str_replace(' ', '_', $txt).'.'.$ext;
        $tmp = $file_array['tmp_name'];
        if(move_uploaded_file($tmp, $path.$actualImageName)){
          echo '<img src="'.$path.$actualImageName.'" width="100" height="100" class="preview">';
        }else{
          echo 'Не удалось загрузить изображение';
        }
      }else{
        echo 'Размер изображения больше 1 МБ';
      }
    }
    else{
      echo 'Формат изображения не поддерживается';
    }
  }else{
    echo "Пожалуйста выберите файл";
  }
  exit;
}