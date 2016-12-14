
$('a[rel=save_page]').live('click', function(){

    var title=$('input[name=title_page]').val();
    var filename_page=$('input[name=filename_page]').val()+".html";
    var content_page=$('.page_editor_textarea textarea').val();
    var id=$('#page_id').val();
    var status="create_page";
    if (id)status="update_page";
    $.ajax({
        type:"POST",
        url: "ajax",
        data: {
            url:"action/savePage",
            status:status,
            title:title,
            filename:filename_page,
            content_page:content_page,
            id:id
        },
        cache: false,
        success: function(data){
            //alert(data);
            var response = eval("(" + data + ")");
            indication(response.msg, response.status);
            if(id)
            {
                $("#table_page tr[id=page_"+id+"] td[class=title]").text(title);
                $("#table_page tr[id=page_"+id+"] td[class=url]").text(filename_page);
            }
            else{
                $("#table_page").append("<tr  id='page_"+response.data.id+"'><td>"+title+"</td><td>"+filename_page+"</td><td><a href='#' rel='page_edit' id='"+response.data.id+"'>Редактировать</a></td><td><a href='#' rel='page_del' id='"+response.data.id+"'>Удалить</a></td><tr/>");
            }


            $(".creat_page").animate({
                opacity: "hide"
            }, 500 );

        }
    });

});


$('a[rel=create_page]').live('click', function(){

    $('.page_editor_textarea').html("<textarea id='elm1' name='elm1' rows='15' cols='80' style='width: 100%' class='tinymce'></textarea>");
    $('input[name=title_page]').val('');
    $('input[name=filename_page]').val('');
    $('#page_id').val('');
    $('#elm1').text('');

    $('textarea.tinymce').tinymce({
        script_url : '../k-core/script/tiny_mce/tiny_mce.js',
        theme : "advanced",
        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
        theme_advanced_buttons1 : "code,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,|,undo,redo,|,bold,italic,underline,strikethrough,|,bullist,numlist,|,forecolor,backcolor,|,link,unlink,image,|,hr,removeformat,|,sub,sup,|,charmap,emotions,",
        theme_advanced_buttons2 : "tablecontrols",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",
        template_replace_values : {
            username : "Some User",
            staffid : "991234"
        }
    });

    $('#page_editor').css('display','block');
    $(".creat_page").hide();//скрываем открытые окна
    centerPosition($(".creat_page"));
    $(".creat_page").animate({
        opacity: "show"
    }, 500 ); // показываем блок для создания нового товара

});

$('a[rel=page_edit]').live('click', function(){
    $('a[rel=create_page]').click();
    //$('input[name=title_page]').val($('tr[id=page_'+$(this).attr("id")+']').find('td[class=title]').text());
    var id = $(this).attr('id');

    $.ajax({
        type:"POST",
        url: "ajax",
        data: {
            url:"action/getPage",
            id:id
        },
        cache: false,
        success: function(data){

            var response = eval("(" + data + ")");
            if(response.status!="succes")
            {
                indication(response.msg, response.status);
                return false;
            }
            else{
                $('#page_id').val(id);
                $('input[name=title_page]').val(response.title);
                $('input[name=filename_page]').val(response.url);
                //alert(response.html_content);
                $('#elm1').text(response.html_content);

            }

        }
    });

});


$('a[rel=page_del]').live('click', function(){

    var id = $(this).attr('id');

    $.ajax({
        type:"POST",
        url: "ajax",
        data: {
            url:"action/deletePage",
            id:id
        },
        cache: false,
        success: function(data){

            var response = eval("(" + data + ")");
            indication(response.msg, response.status);
            if(response.status=="succes"){
                $("#table_page tr[id=page_"+id+"]").remove();
            }
        }
    });

});


$('input[name=title_page]').live('blur keyup',function() {
    var text =$(this).val();
    if(text) {
        text=urlLit(text,1);
        $('input[name=filename_page]').val(text);
    }
});

$('a[rel=cancel_creat_new_page]').live('click', function(){
    $(".creat_page").animate({
        opacity: "hide"
    }, 500 );
});





