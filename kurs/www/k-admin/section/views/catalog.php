<script type="text/javascript" src="/k-core/script/jquery.form.js">
</script>


<div class="wrap">
  <div class="over_bg" >
    <div class="m-panel grid_5">
      <div class="panel-header" >
        <span class="m-cat-24">Каталог товаров</span>
      </div>
      <div class="panel-body">
        <div class="panel-content">
          <div style="width:100%;">
            <div class="toolbar">
              <div style="float: left; margin-top: 4px;"><a href="#" rel="creat_new_product" class="add_good"><span>Добавить товар</span></a></div>
              <div class="filter"><b>Категория товаров</b> <?= $categories ?></div>
            </div>
            <table class="catalog_table" >
              <tr>
                <th>ID</th>
                <th>Категория</th>
                <th>Изображение</th>
                <th>Артикул</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Цена</th>
                <th></th>
              </tr>
              <? foreach($catalog as $data){ ?>
                <tr id="<?= $data['id'] ?>">
                  <td class="id"><?= $data['id'] ?></td>
                  <td id="<?= $data['cat_id'] ?>" class="cat_id"><?= $listCategories[$data['cat_id']] ?></td>
                  <td class="image_url"><?
              if(!$data['image_url']){
                $data['image_url'] = "none.png";
              }
              ?><img class="uploads" src="../uploads/<?= $data['image_url'] ?>"/></td>
                  <td class="code"><?= $data['code'] ?></td>
                  <td class="name"><?= $data['name'] ?></td>
                  <td class="desc" id="<?= $data['id'] ?>"><?= $data['desc'] ?></td>
                  <td class="price"><?= $data['price'] ?></td>


                  <td width="16"><a href="#" title="Удалить" class="delBtn" rel="del" id="<?= $data['id'] ?>"></a></td>
<? } ?>
              <tr class="pagination_box"><td colspan="9"><?= $pagination ?></td></tr>
            </table>



            <div class="creat_product">
              <div class="popwindow">
                <div class="title_popwindow">
                  <span class="m-cat-24">Новый товар</span>
                  <div class="close_popwindow">
                    <a href="#" rel="cancel_creat_new_product" >

                    </a>
                  </div>
                </div>

              </div>
              <div class="creat_product_table">
                <table>
                  <tr>
                    <td>Название:</td><td><input type="text" name="name"/></td>
                    <td rowspan="4">Изображение:
                      <div class="btn_load_img">
                        <form id="imageform" method="post" enctype="multipart/form-data" action="ajax/?url=action/addImage">
                          <input type="file" name="photoimg" id="photoimg" />
                        </form>
                      </div>

                      <div class="btn_cansel_load_img">
                        <a href="#" id="form_del_img"  alt="Отменить" title="Отменить"><img  src="design/images/cancal_upload.png"/></a>
                      </div>


                      <div id="preview"></div>
                    </td>
                  </tr>
                  <tr><td>Код товара:</td><td><input type="text" name="code"/></td></tr>
                  <tr><td>Цена:</td><td><input type="text" name="price"/> руб.</td></tr>
                  <tr><td>Категория:</td><td>

                      <select id='new_prod_category' name='category'>
                        <option selected value='0'>Все</option>
<?= K::get('category')->getTitleCategory($arrayCategories); ?>
                      </select>

                    </td></tr>
                  <tr><td>Описание:</td><td colspan="2"><textarea name="description" style="width:100%; height: 150px;"></textarea></td></tr>
                  <tr>
                    <td colspan="3" style="height:40px; text-align:right;">
                      <a href="#" rel="save_new_product" class="button" >Сохранить</a>
                    </td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="edit_product">
              <div class="popwindow">
                <div class="title_popwindow">
                  <span class="m-cat-24">Редактировать товар</span>
                  <div class="close_popwindow">
                    <a href="#" rel="cancel_edit_product" >
                    </a>
                  </div>
                </div>
              </div>
              <div class="edit_product_table">
                <table>
                  <tr><td>Название:</td><td><input type="text" name="edit_name" /></td><td rowspan="4">Изображение:
                      <div class="edit_btn_load_img">
                        <form id="edit_imageform" method="post" enctype="multipart/form-data" action="loadimage.php">
                          <input type="file" name="edit_photoimg" id="edit_photoimg" />
                        </form>
                      </div>

                      <div class="edit_btn_cansel_load_img">
                        <a href="#" id="edit_form_del_img"  alt="Отменить" title="Отменить"><img  src="design/images/cancal_upload.png"/></a>
                      </div>

                      <div id="edit_preview">

                      </div>

                    </td></tr>
                  <tr><td>Артикул:</td><td><input type="text" name="edit_code"/></td></tr>
                  <tr><td>Цена:</td><td><input type="text" name="edit_price"/> руб.</td></tr>


                  <tr><td>Категория:</td><td>

                      <select id='edit_category' name='category'>
                        <option selected value='0'>Все</option>
<?= K::get('category')->getTitleCategory($arrayCategories); ?>
                      </select>

                    </td></tr>

                  <tr><td>Описание:</td><td colspan="2"><textarea name="edit_description" style="width:100%; height: 150px;"></textarea></td></tr>
                  <tr><td colspan="3" style="height:40px; text-align:right;">
                      <a href="#" rel="save_edit_product" class="button" >Сохранить</a>
                    </td></tr>
                </table>
              </div>
              <input type="hidden" name="edit_id"/>
            </div>

          </div>
        </div>
      </div>

    </div>


  </div>
</div>
