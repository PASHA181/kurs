<div class="wrap">
  <div class="over_bg" >
    <div class="m-panel grid_5">
      <div class="panel-header" >
        <span class="m-page-24">Страницы</span>
      </div>
      <div class="panel-body">

        <div class="panel-content">
          <div style="width:100%;">
            <div class="toolbar">
              <a href="#" rel="create_page" id="0" class="add_good" style="float:left;"><span>Добавть страницу</span></a>
            </div>

            <?=$tablePage ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="creat_page" >
  <div class="popwindow" >
    <div class="title_popwindow" style="width:1024px;">
      <span class="m-page-24">Новая страница</span>
      <div class="close_popwindow">
        <a href="#" rel="cancel_creat_new_page" >
        </a>
      </div>
    </div>

    <div id="page_editor">
      <input id="page_id" type='hidden' name='id' value=''/>
      <div style="padding-top:50px;">
        <b>Заголовок страницы:</b> <input type='text' name='title_page' value=''/>
      </div>
      <div style="padding-top:10px;">
        <b>URL:</b> <input type='text' name='filename_page' value=''/>.html
      </div>
      <div class="page_editor_textarea" style="margin-top:10px;">

      </div>

      <div style="margin-top:10px; ">
        <a href="#" rel='save_page' class="button" >Сохранить страницу</a>
      </div>
    </div>

  </div>
</div>
