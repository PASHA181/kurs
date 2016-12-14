<div class="wrap">
  <div class="over_bg" >
    <div class="m-panel grid_5">
      <div class="panel-header" >
        <span class="m-order-24">Заказы</span>
      </div>
      <?=$tableOrders ?>
    </div>
  </div>
</div>


<div class="edit_order">

  <div class="popwindow">
    <div class="title_popwindow">
      <span class="m-cat-24">Редактирование заказа</span>
      <div class="close_popwindow">
        <a href="#" rel="cancel_edit_order" >

        </a>
      </div>
    </div>

  </div>

  <div  class="creat_category_table" style="width:485px; padding-left:10px;">

    <table style="width:200px;">
      <tr>
        <td>Заказ номер: </td><td id="order_id"></td>
      </tr>
      <tr>
        <td>Оплачен: </td><td id="paid"><input type='checkbox' name='paid'></td>
      </tr>
      <tr>
        <td>Закрыт: </td><td id="close"><input type='checkbox' name='close'></td>
      </tr>

    </table>
    <div class="contact">

    </div>
    <h1 style="margin:0px;">Состав заказа:</h1>
    <div class="content_order">

    </div>
    <div style="margin:10px; float: right;" >
      <a href="#" rel="order_del" class="button">Удалить</a>
    </div>
    <div style="margin:10px;">
      <a href="#" rel="save_edit_order" class="button">Сохранить</a>
    </div>
  </div>



</div>
