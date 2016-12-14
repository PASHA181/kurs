$(document).ready(function(){
  //обработчики нажатий на ссылки в панеле
  $('a[id=product]').click(function(){
    show("catalog.php","adminpage");

  });
  $('a[id=category]').click(function(){
    show("category.php","adminpage");

  });
  $('a[id=page]').click(function(){
    show("page.php","adminpage");

  });
  $('a[id=menu]').click(function(){
    show("menu.php","adminpage");
  });
  $('a[id=settings]').click(function(){
    show("settings.php","adminpage");

  });
  $('a[id=orders]').click(function(){
    show("orders.php","adminpage");

  });


});


//запрашивает страницу для вывода
function show(url,type)
{
  $.ajax({
    type: "POST",
    url: "ajax",
    data: {
      url: url,
      type:type
    },
    cache: false,
    success: function(data){
      $("#content").html(data);
    }
  });
}

function indication(text,status)
{
  var background = "#9abb8b";
  var bordercolor = "#588a41";
  var object = "";

  if(status == "error"){
    object = $('#msg_error');
  }

  if(status == "succes"){
    object = $('#msg_succes');
  }

  if(status == "alert"){
    object = $('#msg_alert');
  }



  object.animate({ opacity: "show" }, "slow" );
  object.html(text);
  object.animate({ opacity: "hide" }, 3000 );
}


// Позиционированирует элемент по центру окна браузера

function centerPosition(object)
{
  object.css('position', 'absolute');
  object.css('left', ($(window).width()-object.width())/2+ 'px');
  object.css('top', ($(window).height()-object.height())/2+ 'px');
}

// Транслитирирует строку

function urlLit(w,v) {
  var tr='a b v g d e ["zh","j"] z i y k l m n o p r s t u f h c ch sh ["shh","shch"] ~ y ~ e yu ya ~ ["jo","e"]'.split(' ');
  var ww='';
  w=w.toLowerCase();
  for(i=0; i<w.length; ++i) {
    cc=w.charCodeAt(i);
    ch=(cc>=1072?tr[cc-1072]:w[i]);
    if(ch.length<3) ww+=ch; else ww+=eval(ch)[v];
  }
  return(ww.replace(/[^a-zA-Z0-9\-]/g,'-').replace(/[-]{2,}/gim, '-').replace( /^\-+/g, '').replace( /\-+$/g, ''));
}


$.getScript('/k-core/script/admin/catalog.js');
$.getScript('/k-core/script/admin/category.js');
$.getScript('/k-core/script/admin/settings.js');
$.getScript('/k-core/script/admin/orders.js');
$.getScript('/k-core/script/admin/pages.js');
$.getScript('/k-core/script/tiny_mce/jquery.tinymce.js');
