//Обработка  нажатия кнопки сохранения редактированной информации категории
$('a[rel=save_orders]').live("click", function(){

    //собираем из таблицы все инпуты с данными, записываим их в виде нативного кода
    var obj ='{"url":"action/saveOrders",';
    $('#table_order td[id=data] input').each(function(){
        obj+='"'+$(this).attr('name')+'":"'+$(this).val()+'",';
    });
    obj+='}';
    //преобразуем полученные данные в JS объект для передачи на сервер
    var data1 = eval("(" + obj + ")");


    $.ajax({
        type:"POST",
        url: "ajax",
        data: data1,
        cache: false,
        success: function(data){
            var response = eval("(" + data + ")");
            indication(response.msg, response.status);



            $('.edit_order').animate({
                opacity: "hide"
            }, "slow" );

        }
    });

});

//Обработка  нажатия кнопки удаления заказа из карточки заказа
$('a[rel=order_del]').live('click', function(){
    var id=$('.edit_order #order_id').text();
    if(orderDelete(id)){
        $('.edit_order').animate({
            opacity: "hide"
        }, "slow" );
    }
});

//Обработка  нажатия кнопки удаления заказа из таблицы заказов
$('a[rel=order_delFromTable]').live('click', function(){
    showEditOrder = false;
    var id = $(this).attr('id');
    orderDelete(id);
    refrashOrderPage();

});

function orderDelete(id){
    
    if(!confirm("Вы подтверждаете удаление заказа "+id+"?")){
        return false;
    }
    
    $.ajax({
        type:"POST",
        url: "ajax",
        data: {
            url:"action/deleteOrder",
            id:id
        },
        cache: false,
        success: function(data){

            var response = eval("(" + data + ")");
            indication(response.msg, response.status);
            if(response.status=="succes"){
                $("#table_order tr[order_id="+id+"]").remove();
            }
            

        }
    });
    return true;
}

function refrashOrderPage(){
    // перезагружает страницу.
    $.ajax({
      type:"POST",
      url: "ajax",
      data: {
        url: "orders.php" 
      },
      cache: false,
      success: function(data){
        $("#content").html(data);
      }
    });
}

var select="#E3E9FF";
var  background;

$("#table_order tr").live("mouseover", function(){
    background=$(this).find("td").css("background");
    $(this).find("td").css('background',select);
});

$("#table_order tr").live("mouseout", function(){
    $(this).find("td").css('background',background);
});


$('#table_order tr').live("click", function(){
    showEditOrder = true;
    editOrder($(this));
});

function editOrder(myThis){
    if(!showEditOrder) return false;
    var order_id = myThis.attr('order_id');
    $('.content_order').html(myThis.find('.order_content').html());
    $('.contact').html(myThis.find('.contactHide').html());
    centerPosition($('.edit_order'));
    $('.edit_order').animate({
        opacity: "show"
    }, "slow" );
    $('.edit_order #order_id').text(order_id);

    if($('#table_order tr[order_id='+order_id+'] td[id=paid]').text()=='Да')
        $('.edit_order #paid input[name=paid]').attr('checked', 'checked');

    if($('#table_order tr[order_id='+order_id+'] td[id=close]').text()=='Да')
        $('.edit_order #close input[name=close]').attr('checked', 'checked');
}

$('a[rel=cancel_edit_order]').live("click", function(){
    $('.edit_order').animate({
        opacity: "hide"
    }, "slow" );
    $('.edit_order #paid input[name=paid]').removeAttr("checked");
    $('.edit_order #close input[name=close]').removeAttr("checked");
});


$('a[rel=save_edit_order]').live("click", function(){

    if($('.edit_order #close input[name=close]').attr('checked')=='checked')
        var close=1;
    else
        var close=0;

    if($('.edit_order #paid input[name=paid]').attr('checked')=='checked')
        var paid=1;
    else
        var paid=0;

    var order_id=$('.edit_order #order_id').text();

    $.ajax({
        type:"POST",
        url: "ajax",
        data: {
            url:"action/saveOrders",
            order_id:order_id,
            close:close,
            paid:paid
        },
        cache: false,
        success: function(data){
            var response = eval("(" + data + ")");
            indication(response.msg, response.status);
            $('.edit_order').animate({
                opacity: "hide"
            }, "slow" );
            $('.edit_order #order_id').text('');
            //$('#table_order tr[order_id=85] td[id=paid]').css('background','red');
            if(paid)str_paid='Да'; else str_paid='Нет';
            $('#table_order tr[order_id='+order_id+'] td[id=paid]').text(str_paid);
            if(close)str_close='Да'; else str_close='Нет';
            $('#table_order tr[order_id='+order_id+'] td[id=close]').text(str_close);
            $('.edit_order #paid input[name=paid]').removeAttr("checked");
            $('.edit_order #close input[name=close]').removeAttr("checked");
        }
    });
});
