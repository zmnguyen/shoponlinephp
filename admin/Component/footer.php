<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
echo "<script type='text/javascript' src='../Script/jquery-1.11.2.js'></script>";
echo "<script type='text/javascript' src='../Script/jquery-ui.min.js'></script>";
echo "<script type='text/javascript' src='../dist/js/bootstrap.min.js'></script>";
echo "<script type='text/javascript' src='script/Login.js'></script>";
echo "<script type='text/javascript' src='../ckeditor/ckeditor.js'></script>";
?>

<script>
    function alertError(message) {
        $('#div_anount').append("<div class='alert alert-danger alert-dismissible'><span class='.glyphicon .glyphicon-remove'></span> Lỗi Trong Quá Trình Sử Lý:" + message + "</div>");
    }

    function alertSuccess(message) {
        $('#div_anount').append("<div class='alert alert-success alert-dismissible'><span class='.glyphicon .glyphicon-check'></span>Thêm Thành Công</div>");
    }
</script>

