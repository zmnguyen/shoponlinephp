/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('form#form_product').submit(function () {
        if ($('#txt_id').val() == '') {
            $('#txt_action').val("add");
        } else {
            $('#txt_action').val("update");
        }

        var data = new FormData($(this)[0]);
        $.ajax({
            url: "control/ProductManagement.php",
            type: 'POST',
            data: data,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Failure: " + textStatus + " error: " + errorThrown);
                alertError(errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                loadData();
                alertSuccess();
            }
        });

        return false;
    });


    $('.btn-info').click(function () {
        console.log($(this).val());

        $.ajax({
            url: "control/ProductManagement.php",
            type: 'POST',
            data: "action=select&&id: " + $(this).val(),
            dataType: 'application/json',
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Failure: " + textStatus + " error: " + errorThrown);
                alertError(errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                var result = JSON.parse(data);

                $('#txt_id').val(result.id);
                $('#txt_name').val(result.name);
                $('#txt_categories').val(result.categories);
                $('#txt_meterial').val(result.meterial);
                $('#txt_producer').val(result.producer);
                $('#txt_supplier').val(result.supplier);
                $('#txt_import').val(result.import);
                $('#txt_export').val(result.export);
                $('#txt_amount').val(result.amount);

                $('#tab2').tab('show');
            }
        });

    });

    $('.btn-danger').click(function () {
        if (confirm("Xác Nhận?")) {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: "control/ProductManagement.php",
                data: "action=delete&&id=" + id,
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("Failure: " + textStatus + " error: " + errorThrown);
                    alertError(errorThrown);
                },
                success: function (data, textStatus, jqXHR) {
                    alertSuccess();
                }
            });
        }
    });


    function loadData()
    {
        var data = {
            action: "load"
        };

        $.ajax({
            url: "../Control/ProductManagement.php",
            type: 'POST',
            data: data,
            dataType: 'application/json',
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Failure: " + textStatus + " error: " + errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                $('#table_Product tbody').empty();
                var result = $.parseJSON(data);
                $('#table_Product tbody').append(result);
            }
        });
    }
});