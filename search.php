<!doctype html>
<html><!-- InstanceBegin template="/Templates/template_main.dwt.php" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta charset="utf-8">
        <?php
        session_start();
        include_once './component/head.php';
        ?>
        <title>Search</title>
    </head>

    <body class="light-grey">
        <?php include_once './component/banner.php'; ?>
        <!--slider-->
        <div class="row">

        </div>
        <!--end slider-->
        <div class="row">
            <div class="container-fluid">
                <!--right panel-->
                <div class="col-md-12 col-xs-12" style="">
                    <?php
                    if ($_POST['input']) {
                        include_once './Model/Product.php';
                        $product = new Product();

                        $result = $product->search($_POST["input"]);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class = "item-product col-md-3 col-xs-10">
                                    <div class = "row">
                                        <div class = "size-lane">
                                        </div>
                                    </div>
                                    <div class = "row" align = "center">
                                        <a href = "<?php echo $_SERVER['SERVER_NAME'];?>/detail.php?productId=<?php echo $row["PRODUCT_id"];?>" class = "img-thumbnail">
                                            <img class = "img-responsive" src = "upload_dir/product/<?php echo $row["PRODUCT_img"];?>" alt = "product" />
                                        </a>
                                    </div>
                                    <div class = "row">
                                        <div class = "container-fluid">
                                            <button class="btn btn-buys" value="<?php echo $row["PRODUCT_id"];?>">Thêm Vào Giỏ Hàng</button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            echo "No Result";
                        }
                    } else {
                        echo "no parameter";
                    }
                    ?>
                </div>
                <!--end right-->
                <!--Navigation-->
<?php include_once './component/Navigation.php'; ?>
                <!--end Navigation-->
            </div>
        </div>

        <!--footer-->
<?php include_once './component/footer.php'; ?> 
        <!--end Footer-->
    </body>
    <!-- InstanceEnd --></html>
