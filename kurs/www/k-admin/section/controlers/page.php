<?php

$result = DB::query('SELECT  *  FROM `page`');

if(! empty($result)){

  $tablePage = '
    <table id="table_page" >
    <tr>
    <th>Заголовок</th>
    <th>URL</th>
    <th></th>
    <th></th>
    </tr>';

  while($page = DB::fetchAssoc($result)){
    $tablePage .= '
       <tr id="page_'.$page['id'].'">
        <td class="title">'.$page['title'].'</td>
        <td class="url">'.$page['url'].'</td>
        <td width="16"><a href="#" title="Редактировать" class="editBtn" rel="page_edit" id="'.$page['id'].'"></a></td>
        <td width="16"><a href="#" title="Удалить" class="delBtn" rel="page_del" id="'.$page['id'].'"></a></td>
       </tr>';
  }

  $tablePage .= '</table>';
}else{
  echo 'Пока не создано ни одной страницы.';
}

$this->tablePage = $tablePage;