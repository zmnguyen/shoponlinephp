<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <?php
        session_start();
        include_once './component/head.php';
        ?>
        <title>Thiên Đường Thời Trang</title>
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
                <div class="col-md-12 col-xs-12" style="">
                    <!-- InstanceBeginEditable name="EditRegion3" -->
                    <?php
                    for ($i = 0; $i < 20; $i++) {
                        ?>
                        <div class="item-product col-md-3 col-xs-10">
                            <div class="row">
                                <div class="size-lane">
                                </div>
                            </div>
                            <div class="row" align="center">
                                <a href="#" class="img-thumbnail">
                                    <img class="img-responsive" src="image/product/logo.jpg" alt="product" />
                                </a>
                            </div>
                            <div class="row">
                                <div class="container-fluid">
                                    <input type="button" class="btn-buys" id="btn_buy" value="Add to Cart" />
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- InstanceEndEditable -->    
                </div>
                <!--end right-->
            </div>
        </div>

        <!--footer-->
        <?php include_once './component/footer.php';?>
        <!--end Footer-->
    </body>
    <!-- InstanceEnd -->
</html>
