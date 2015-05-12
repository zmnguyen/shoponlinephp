/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('.btn-info').click(function () {
        var id = $(this).val();

        $.ajax({
            type: 'POST',
            url: "../control/MessageManagement.php",
            data: "action=select&id=" + id,
            error: function (jqXHR, textStatus, errorThrown) {
                consol.log("failure: " + textStatus + " error: " + errorThrown);
                alertError(errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                var result = JSON.parse(data);

                $('#txt_sender').val(data.sender);
                $('#txt_date').val(data.date);
                $('#txt_content').val(data.content);

                $('#div_message').removeClass("hidden");
                $('#div_message').slideDown("slow");
            }
        });
    });

    $('#btn_close').click(function () {
        $('#div_message').slideUp("slow");
        $('#div_message').addClass("hidden");
    });

    $('.btn-danger').click(function () {
        var id = $(this).val();

        $.ajax({
            type: 'POST',
            url: "../control/MessageManagment.php",
            data: "action=delete&id=" + id,
            error: function (jqXHR, textStatus, errorThrown) {
                consol.log("failure: " + textStatus + " error: " + errorThrown);
                alertError(errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                alertSuccess("Đã Thực Hiện Xóa");
            }
        });
    });

    $('.btn-success').click(function () {
        var id = $(this).val();

        $.ajax({
            type: 'POST',
            url: "../control/MessageManagement.php",
            data: "action=update&id=" + id + "&status=true",
            error: function (jqXHR, textStatus, errorThrown) {
                consol.log("failure: " + textStatus + " error: " + errorThrown);
                alertError(errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                reload();
            }
        });
    });
});


function reload() {
    $.ajax({
        type: 'POST',
        url: "../control/MessageManagement.php",
        data: "action=load",
        error: function (jqXHR, textStatus, errorThrown) {
            consol.log("failure: " + textStatus + " error: " + errorThrown);
            alertError(errorThrown);
        },
        success: function (data, textStatus, jqXHR) {
            $('#table_Message tbody').empty();
            $('#table_Message tbody').append(data);
        }
    });
}

