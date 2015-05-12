<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <?php
        session_start();
        include_once './component/head.php';
        ?>
        <title></title>
    </head>

    <body class="light-grey">
        <!--Banner-->
        <?php
        include_once './component/banner.php';
        ?>
        <!--end banner-->
        <!--slider-->
        <div class="row">

        </div>
        <!--end slider-->


        <div class="row">
            <div class="container-fluid">
                <!--right panel-->
                <div class="col-md-9 col-xs-12" style="">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Mã Sản Phấm</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Đơn Giá </th>
                                <th>Số Lượng </th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-right" colspan="4">Tổng Tiền: </td> 
                                <td>500.00$</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="col-md-9 pull-right">
                            <button type="button" class="btn btn-success">Đặt Hàng</button>
                            <button type="button" class="btn btn-danger">Huỷ Hoá Đơn</button>
                        </div>
                    </div>
                </div>
                <!--Navigation Pane-->
                <?php
                include_once './component/Navigation.php';
                ?>
                <!--end Navigation-->
            </div>
        </div>

        <!--footer-->
        <?php
        include_once './component/footer.php';
        ?>
        <!--end Footer-->
    </body>
    <!-- InstanceEnd -->
</html>
