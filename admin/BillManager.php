<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Quản Lý Hóa Đơn</title>
        <?php
        include_once './Component/source.php';
        include_once '../Model/Order.php';

        $order = new Order();
        ?>
    </head>

    <body>
        <?php
        include_once './Component/Head.php';
        ?>

        <div class="container-fluid">
            <div class="row">
                <?php
                include_once './Component/navigation.php';
                ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <div class="row" id="div_anount">

                    </div>
                    <div class="row hidden" id="div_detail">
                        <h3 class="page-header">Chi Tiết Đơn Hàng</h3>
                        <table class="table table-hover" id="table_detail">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Đơn Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Tổng Tiền</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <h3 class="page-header">Danh Sách Đơn Hàng</h3>
                        <table class="table table-hover" id="table_order">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Người Đặt Hàng</th>
                                    <th>Địa Chỉ Nhận</th>
                                    <th>Ngày Đặt Hàng</th>
                                    <th>Tổng Tiền</th>
                                    <th>Tình Trạng Thanh Toán</th>
                                    <th>Tác Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listOrder = $order->selectAll();

                                if ($listOrder) {
                                    while ($row = mysqli_fetch_assoc($listOrder)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row["ORDER_id"]; ?></td>
                                            <td><?php echo $row["ORDER_maker"]; ?></td>
                                            <td><?php echo $row["ORDER_to"]; ?></td>
                                            <td><?php echo $row["ORDER_date"]; ?></td>
                                            <td><?php echo $row["ORDER_total"]; ?></td>
                                            <td>
                                                <?php
                                                if ($row["ORDER_status"] == 0) {
                                                    echo "Chưa Thanh Toán";
                                                } else {
                                                    echo "Đã Thanh Toán";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info" value="<?php echo $row["ORDER_id"]; ?>">Chi Tiết</button>
                                                <button type="button" class="btn btn-danger" value="<?php echo $row["ORDER_id"]; ?>">Huỷ</button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
<?php include_once './Component/footer.php'; ?>
                <script src="script/BillManagement.js"></script>
            </div>
        </div>
    </body>
</html>
