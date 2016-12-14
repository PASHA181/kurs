<?php


class Updata{

  public static function checkUpdata(){
    $updataServer = 'http://moguta.ru/updata/updata.php';
    $ver = VER;
    $post = 'version='.$ver.'&script='.$_SERVER['SERVER_NAME'];
    $res = self::_sendCURL($updataServer, $post);
    $data = explode("+", $res);    
    $lastVersion = $data[0]; 
    $finalVersion = $data[1]; 
    $discription = $data[2]; 
    $author = $data[3]; 

    if($lastVersion){
      $msg = '<b>Последняя версия системы: </b><span id="lVer">'.$finalVersion.'</span>.<br> <b>Описание: </b>'.$discription.'<br> <b>Автор: </b>'.$author;
    }else{
      $msg = 'У Вас последняя версия';
    }
    
    return $msg;
  }


  public static function updataSystem($version){
    $remoteFile = 'http://moguta.ru/updata/history/'.$version.'.zip';
    $file = $version.'-m.zip';
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $remoteFile);
    $fp=fopen($file, "wb+");
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_REFERER, $remoteFile);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    $res = curl_exec($ch);
    curl_close($ch);
    fclose($fp);

    if(file_exists($file)){
      $zip = new ZipArchive;
      $zip->open($file);
      $zip->extractTo(SITE_DIR);
      $zip->close();
      unlink($file);
    }
    
    if($res){
      return true;
    }
  }

  private function _sendCURL($url, $post){
	$ch = curl_init();
	//Устанавливаем URL запроса
	curl_setopt($ch, CURLOPT_URL, $url);
	//При значении true CURL включает в вывод заголовки.
	curl_setopt($ch, CURLOPT_HEADER, false);
	//Куда помещать результат выполнения запроса:
	//  false – в стандартный поток вывода,
	//  true – в виде возвращаемого значения функции curl_exec.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//Нужно явно указать, что будет POST запрос
	curl_setopt($ch, CURLOPT_POST, true);
	//Здесь передаются значения переменных
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	//Максимальное время ожидания в секундах
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	 //Установим значение поля User-agent
	curl_setopt($ch, CURLOPT_USERAGENT, 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:8.0) Gecko/20100101 Firefox/8.0');
	//Выполнение запроса
	$res = curl_exec($ch);
	//Особождение ресурса
	@curl_close($ch);
	return $res;
  }



}