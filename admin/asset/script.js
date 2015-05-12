$(function () {
    $("[id*=btn_submitFunction]").bind("click", function () {
        var func = {};
        func.FUNCTION_name = $("[id*=txt_functionName]").val();
        func.FUNCTION_link = $("[id*=txt_functionLink]").val();

        $.ajax({
            type: "POST",
            url: "RoleManager.aspx/add_Function",
            data: '{func:' + JSON.stringify(func) + '}',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alertFail(errorThrown);
            },
            success: function (response) {
                alertSuccess("Thêm Thành Công");
                window.location.reload();
            }
        });

        return false;
    });
});


function alertSuccess(message) {
    var $div_alert = $("#div_alert");

    $div_alert.append("<div class='alert alert-success' role='alert'>" + message + "</div>").fadeIn(500).fadeOut(500).fadeIn(500).fadeOut();
}

function alertFail(message) {
    var $div_alert = $("#div_alert");

    $div_alert.append("<div class='alert alert-danger' role='alert'>" + message + "</div>").fadeIn(500).fadeOut(500).fadeIn(500).fadeOut();
}

