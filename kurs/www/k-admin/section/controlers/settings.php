<?php

$result = DB::query('SELECT  *  FROM setting WHERE active="Y"');
$tableSettings = '<table id="table_settings">';

while($setting = DB::fetchAssoc($result)){

  $tableSettings .= '
    <tr>
      <td>'.$setting['name'].'</td>
      <td id="data">
        <input type="text" value="'.$setting['value'].'" name="'.$setting['option'].'"/></td>
      <td>'.$setting['desc'].'</td>
    </tr>';

  print_r($row);
}

$tableSettings .= '
  <tr class="pagination_box" style="height:60px;">
    <td colspan="3">
      <a href="#" rel="save_settings" class="button">Сохранить настройки</a>
    </td>
  <tr>
</table>';



$this->tableSettings = $tableSettings;