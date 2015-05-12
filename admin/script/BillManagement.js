/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('#table_order .btn-info').click(function () {
        var id = $(this).val();

        $.ajax({
            type: 'POST',
            url: "../control/BillManagement.php",
            data: "action=select&kind=order&id=" + id,
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Failure: " + textStatus + " error: " + errorThrown);
                alertError(errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                $('#table_detail tbody').empty();

                $('#table_detail tbody').append(data);
            }
        });
    });

    $('#table_order .btn-danger').click(function () {
        var id = $(this).val();

        $.ajax({
            type: 'POST',
            url: "../control/BillManagement.php",
            data: "action=delete&kind=order&id=" + id,
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Failure: " + textStatus + " error: " + errorThrown);
                alertError(errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                $('#table_detail tbody').empty();


            }
        });
    });

    $('#table_detail .btn-danger').click(function () {

    });
});


function load(kind) {
    if (kind == "order") {
        $.ajax({
            type: 'POST',
            url: "../control/BillManagement.php",
            data: "action=load&kind=order",
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("failure: " + textStatus + " error: " + errorThrown);
                alertError(errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                $('#table_order tbody').empty();

                $('#table_order tbody').append(data);
            }
        });
    }else if(kind == "detail"){
        $.ajax({
            type: 'POST',
            url: "../control/BillManagement.php",
            data: "action=load&kind=detail",
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("failure: " + textStatus + " error: " + errorThrown);
                alertError(errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                $('#table_detail tbody').empty();

                $('#table_detail tbody').append(data);
            }
        });
    }
}