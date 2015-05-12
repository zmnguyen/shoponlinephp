<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Untitled Document</title>
        <?php include_once './Component/source.php'; ?>
    </head>

    <body>
        <?php include_once './Component/Head.php'; ?>

        <div class="container-fluid">
            <div class="row">
                <?php include_once './Component/navigation.php'; ?>
                <div class="col-md-10 col-md-offset-2 main">
                    <div class="page-header"><h2>Quản Lý Sản Phẩm</h2></div>
                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Danh Sách Sản Phẩm</a></li>
                            <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Thông Tin Sản Phẩm</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active fade in" id="tab1">
                                <table class="table table-hover" id="table_Product">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Loại</th>
                                            <th>Số Lượng</th>
                                            <th>Giá Nhập</th>
                                            <th>Giá Xuất</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once '../Model/Product.php';

                                        $product = new Product();
                                        $datas = $product->selectAll();
                                        foreach ($datas as $data) {
                                            ?>
                                            <tr>
                                                <td><?php $data["PRODUCT_id"] ?></td>
                                                <td><?php $data["PRODUCT_name"] ?></td>
                                                <td><?php $data["PRODUCT_kind"] ?></td>
                                                <td><?php $data["PRODUCT_importprice"] ?></td>
                                                <td><?php $data["PRODUCT_exportprice"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info" value='<?php $data["PRODUCT_id"] ?>' >Thông Tin</button>

                                                    <button type="button" class="btn btn-danger" value='<?php $data["PRODUCT_id"] ?>' >Xóa</button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="tab2">
                                <?php
                                $item = null;
                                if (isset($_GET["ProID"]) && !empty($_GET["ProID"])) {
                                    $item = mysqli_fetch_assoc($product->select($_GET["ProID"]));
                                }
                                ?>
                                <div class="container-fluid">
                                    <h3 class="header">Thông Tin Sản Phẩm</h3>
                                    <form id="form_product" class="form-horizontal" method="post" enctype="multipart/form-data">
                                        <div class="form-group" id="div_anount">
                                            <input type="hidden" id="txt_action" name="action" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">ID Sản Phẩm:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="txt_id" name="id" readonly="readonly" value="<?php echo $item["PRODUCT_id"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="txt_name">Tên Sản Phẩm:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Tên Sản Phẩm" id="txt_name" name="name" value="<?php echo $item["PRODUCT_name"]; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="txt_categories">Loại:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" list="list_categories" id="txt_categories" name="categeries" placeholder="Loại Sản Phẩm" value="<?php echo $item["PRODUCT_categories"]; ?>" />
                                                <datalist id="list_categories">
                                                    <?php
                                                    include_once '../Model/Categories.php';

                                                    $categories = new Categories();

                                                    $listCate = $categories->selectAll();

                                                    while ($row = mysqli_fetch_assoc($listCate)) {
                                                        echo "<option value='" . $row["CATE_id"] . "'>" . $row["CATE_name"] . "</option>";
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="txt_meterial">Chất Liệu</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" list="list_meterial" id="txt_meterial" name="meterial" placeholder="Chất Liệu Sản Phẩm" value="<?php echo $item["PRODUCT_categories"]; ?>" />
                                                <datalist id="list_meterial">
                                                    <?php
                                                    $listMeterial = $product->select_meterial();
                                                    while ($row = mysqli_fetch_assoc($listMeterial)) {
                                                        echo "<option value='" . $row . "'>" . $row . "</option>";
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="txt_producer">Nhà Sản Xuất:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" list="list_producer" id="txt_producer" name="producer" placeholder="Nhà Sản Xuất" value="<?php echo $item["PRODUCT_producer"]; ?>" />
                                                <datalist id="list_producer">
                                                    <?php
                                                    $listProducer = $product->select_producer();

                                                    while ($row = mysqli_fetch_assoc($listProducer)) {
                                                        echo "<option value='" . $row . "'>" . $row . "</option>";
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="txt_supplier">Nhà Cung Cấp:</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" list="list_supplier" id="txt_supplier" name="supplier" placeholder="Nhà Cung Cấp" value="<?php echo $item["PRODUCT_supplier"]; ?>" />
                                                <datalist id="list_supplier">
                                                    <?php
                                                    $listSupplier = $product->select_supplier();

                                                    while ($row = mysqli_fetch_assoc($listSupplier)) {
                                                        echo "<option value='" . $row . "'>" . $row . "</option>";
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="txt_img">Hình Ảnh:</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" name="fileupload[]" multiple="true" accept="image/*" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Giá Nhập:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="txt_import" name="import" placeholder="Giá Nhập" value="<?php echo $item["PRODUCT_import"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Giá Xuất:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="txt_export" name="export" placeholder="Giá Xuất" value="<?php echo $item["PRODUCT_export"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Số Lượng:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="txt_amount" name="amount" placeholder="Số Lượng" value="<?php echo $item["PRODUCT_amount"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="">Tình Trạng:</label>
                                            <div class="col-sm-9">
                                                <input type="checkbox" id="cb_status" value="true" name="status" <?php
                                                if ($item["PRODUCT_status"] == 1) {
                                                    echo "checked";
                                                }
                                                ?> />
                                                Còn Bán
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="ckeditor" name="decription" id="txt_description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6 pull-right">
                                                <input type="submit" class="btn btn-success" value="Nhập" id="btn_submit" />
                                                <input type="reset" class="btn btn-warning" value="Reset"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php include_once './Component/footer.php'; ?>
            <script src="script/ProductManagement.js"></script>

            <script>
                CKEDITOR.replace('txt_description', {
                    filebrowserUploadUrl: '../ckeditor/plugins/imgupload/imgupload.php',
                    filebrowserImageUploadUrl: '../ckeditor/plugins/imgupload/imgupload.php?type=Images'
                });
            </script>
        </div>
    </body>
</html>
