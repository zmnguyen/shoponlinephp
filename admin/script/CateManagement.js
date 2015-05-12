/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $("#btn_submit").click(function () {
        var data = $("#form_Cate").serialize();
        if ($('#txt_id').val() == "") {
            data += "&action=add";
        } else {
            data += "&action=update";
        }

        console.log("comming here");
        $.ajax({
            type: 'POST',
            url: "control/CateManagement.php",
            data: data,
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Failure: " + textStatus + " error: " + errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                var result = JSON.parse(data);
                if (result != "denied") {
                    load();
                    alertSuccess();
                } else {
                    alertError();
                    console.log("Fail: " + result);
                }
            }
        });
    });

    $('.btn-primary').click(function () {
        var CateId = $(this).val();
        $.ajax({
            type: 'POST',
            url: "control/CateManagement.php",
            data: "action=select&&CateId="+CateId,
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Failure: " + textStatus + " error: " + errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                var json = JSON.parse(data);
                $("#txt_id").val(json.id);
                $("#txt_name").val(json.name);
            }
        });
    });


    //delete category
    $(".btn-danger").click(function () {
        if (confirm("Xác Nhận? Xóa Danh Mục Sẽ Xóa Kèm Các Sản Phẩm Thuộc Danh Mục này!")) {
            var cateID = $(this).val();
            console.log(cateID);
            $.ajax({
                type: 'POST',
                url: "control/CateManagement.php",
                data: "action=delete&cateID=" + cateID,
                error: function (jqXHR, textStatus, errorThrown) {
                    alertError();
                    console.log("Failure: " + textStatus + " error: " + errorThrown);
                },
                success: function (data, textStatus, jqXHR) {
                    var result = JSON.parse(data);
                    load();
                    if (result != "denied") {
                        alertSuccess();
                    } else {
                        alertError();
                        console.log("Fail: " + data);
                    }
                }
            });
        }
    });

    function load() {
        $.ajax({
            type: 'POST',
            url: "control/CateManagement.php",
            data: "action=load",
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Failure: " + textStatus + " error: " + errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                var result = JSON.parse(data);
                $('#table_cate tbody').empty();

                $('#table_cate tbody').append(result);
            }
        });
    }
});