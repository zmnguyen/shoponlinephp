/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    $('#btn_submit').click(function(){
        if($("#txt_id").val() == ""){
            $('#txt_action').val("add");
        }else{
            $('#txt_action').val("update");
        }
        
        var data = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: "control/EventManagement.php",
            data: data,
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Failure: "+textStatus+" error: "+errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                alertSuccess("Thao Tác Thành Công!");
            }
        });
    });
    
    $('.btn-info').click(function(){
        var id = $(this).val();
        
        $.ajax({
            type: 'POST',
            url: "../control/EventManagement.php",
            data: "action=select&id="+id,
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Failure: "+textStatus+" Error: "+errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                var result = JSON.parse(data);
                
                $('#txt_id').val(data.id);
                $('#txt_name').val(data.name);
                $('#txt_discount').val(data.discount);
                $('#txt_editor').val(data.content);
                
                $('#tab2').tab('show');
            }
        });
    });
    
    $('.btn-danger').click(function(){
        if(confirm("Xác Nhận? Xóa Sự Kiện Sẽ Xóa Luôn Tất Cả Thông Tin Của Sự Kiện!")){
            var id = $(this).val();
            
            $.ajax({
                type: 'POST',
                url: "../control/EventManagement.php",
                data: "action=delete&id="+id,
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("Failure: "+textStatus+" Error: "+errorThrown);
                },
                success: function (data, textStatus, jqXHR) {
                    alertSuccess("Đã Xóa");
                }
            });
        }
    });
});

