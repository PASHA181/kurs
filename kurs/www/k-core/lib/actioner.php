<?php


class Actioner{

  private $messageSucces = 'Операция выполнена успешно!';
  private $messageError = 'Операция не выполнена!';
  private $data = array();
  public function __construct(){

  }

  public function runAction($action){
    $this->jsonResponse($this->$action());
    exit;
  }

  private function addCategory(){

    $id = K::get('category')->addCategory($_POST);
    $this->messageSucces = 'Создана категория "'.$_POST['title'].'"';
    $this->messageError = 'Не удалось создать категорию!'.$id;
    return $id;
  }

  private function addProduct(){
    $model = new Models_Product;
    $id = $model->addProduct($_POST);
    $this->messageSucces = 'Создан товар "'.$_POST['name'].'"';
    $this->messageError = 'Не удалось создать категорию!'.$id;
    return $id;
  }

  private function delImage(){
    $model = new Models_Product;
    $id = $_POST['id'];
    unset($_POST['url']);
    unset($_POST['id']);
    $array['image_url'] = '';
    return $model->updateProduct($array, $id);

  }


  private function addImage(){

    $path = SITE_DIR.'uploads/';

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

                $this->data = array('img' => $actualImageName );
                $this->messageSucces = 'Изображение загружено';
              return true;

            }else{
               $this->messageError =  'Не удалось загрузить изображение';
               return false;
            }
          }else{
             $this->messageError = 'Размер изображения больше 1 МБ';
             return false;
          }
        }else{
          $this->messageError =  'Формат изображения не поддерживается';
          return false;
        }
      }else{
         $this->messageError =  "Пожалуйста выберите файл";
          return false;
      }
    }
    return false;
  }

  private function deleteCategory(){
    $this->messageSucces = 'Удалена категория "'.$_POST['title'].'"';
    $this->messageError = 'Не удалось удалить категорию!';
    return K::get('category')->delCategory($_POST['id']);
  }

  private function deletePage(){
    $this->messageSucces = 'Удалена страница  №'.$_POST['id'];
    $this->messageError = 'Не удалось удалить страницу!';
    if(DB::query('DELETE FROM `page` WHERE `id`= '.$_POST['id'])){
      return true;
    }
    return false;
  }

  private function deleteProduct(){
    $this->messageSucces = 'Удален товар "'.$_POST['title']."'";
    $this->messageError = 'Не удалось удалить товар!';
    $model = new Models_Product;
    return $model->deleteProduct($_POST['id']);
  }

  private function deleteOrder(){
    $this->messageSucces = 'Удален заказ №'.$_POST['id'];
    $this->messageError = 'Не удалось удалить заказ!';
    $model = new Models_Order;
    return $model->deleteOrder($_POST['id']);
  }

  private function editCategory(){
    $this->messageSucces = 'Изменена категория "'.$_POST['title'].'"';
    $this->messageError = 'Не удалось изменить категорию!';

    $id = $_POST['id'];
    unset($_POST['id']);
    // если назначаемая категория, является тойже
    if($_POST['parent'] == $id){
       $this->messageError = 'Нельзя назначить выбраную категорию родительской!';
       return false;
    }

    $childsCaterory = K::get('category')->getCategoryList($id);
    // если есть вложенные, и одна из них назначена родительской
    if(!empty($childsCaterory)){
      foreach($childsCaterory as $cateroryId){
        if($_POST['parent']==$cateroryId){
          $this->messageError = 'Нельзя назначить выбраную категорию родительской!';
          return false;
        }
      }
    }

    if($_POST['parent'] == $id){
       $this->messageError = 'Нельзя назначить выбраную категорию родительской!';
       return false;
    }

    return K::get('category')->editCategory($id, $_POST);
  }

  private function editProduct(){
    $this->messageSucces = 'Товар изменен';
    $this->messageError = 'Не удалось изменить параметры товара!';
    $model = new Models_Product;
    $id = $_POST['id'];
    unset($_POST['url']);
    unset($_POST['id']);
    return $model->updateProduct($_POST, $id);
  }

  private function editSettings(){
    $this->messageSucces = 'Настройки сохранены';
    unset($_POST['url']);
    foreach($_POST as $option => $value){
      if(!DB::query("UPDATE `setting` SET `value`='%s' Where `option`='%s'", $value, $option)){
        return false;
      }
    }
    return true;
  }

  private function getPage(){
    $result = DB::query('SELECT * FROM `page` WHERE `id` = '.$_POST['id']);

    if($page = DB::fetchObject($result)){
      $response = array(
          'title' => $page->title,
          'url' => str_replace('.html', '', $page->url),
          'html_content' => $page->html_content,
          'status' => 'succes'
      );
    }else{
      $response = array('msg' => 'Не удалось считать данные страницы',
          'status' => 'error');
    }

    echo json_encode($response);
    exit;
  }

  private function saveOrders(){
    $this->messageSucces = 'Заказ изменен';
    $this->messageError = 'Не удалось изменить параметры заказа!';
    if('1' == $_POST['paid']){
      $_POST['paid'] = 'Y';
    }
    if('0' == $_POST['paid']){
      $_POST['paid'] = 'N';
    }
    if('1' == $_POST['close']){
      $_POST['close'] = 'Y';
    }
    if('0' == $_POST['close']){
      $_POST['close'] = 'N';
    }

    unset($_POST['url']);

    if(DB::query("
      UPDATE `order` SET `paid`='%s', `close`='%s'
      Where `id`='%s'", $_POST['paid'], $_POST['close'], $_POST['order_id'])){
      return true;
    }
    return false;
  }

  private function savePage(){
    if('create_page' == $_POST['status']){

      $sql = "INSERT INTO `page` (`id` ,`title` ,`url` ,`html_content`)
          VALUES (
          '', '".$_POST['title']."', '".$_POST['filename']."', '".$_POST['content_page']."'
          );";


      $result = DB::query($sql);
      $id = DB::insertId();
      $response = array(
          'data' => array(
              'id' => $id,
          ),
          'msg' => 'Страница '.$_POST['filename'].' создана',
          'status' => 'succes',);

      echo json_encode($response);
      exit;
    }

    if('update_page' == $_POST['status']){
      $sql = "UPDATE `page` SET
                `title` = '".$_POST['title']."',
                `url` = '".$_POST['filename']."',
                `html_content` = '".$_POST['content_page']."'
          WHERE `id` = ".$_POST['id'];

      $result = DB::query($sql);

      $response = array('msg' => 'Страница '.$_POST['filename'].' измененна',
          'status' => 'succes',);

      echo json_encode($response);
      exit;
    }
  }

  public function jsonResponse($flag){
    if($flag===null){return false;}
    if($flag){
      $this->jsonResponseSucces($this->messageSucces);
    }else{
      $this->jsonResponseError($this->messageError);
    }
  }

  public function jsonResponseSucces($message){
    $result = array(
        'data' => $this->data,
        'msg' => $message,
        'status' => 'succes');
    echo json_encode($result);
  }

  public function jsonResponseError($message){
    $result = array(
        'data' => $this->data,
        'msg' => $message,
        'status' => 'error');
    echo json_encode($result);
  }


}