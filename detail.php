<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <?php
        session_start();
        include_once './component/head.php';
        ?>
        <title>chi tiết sản phẩm</title>
        <link rel="stylesheet" href="Style/Detail.css" />
    </head>

    <body class="light-grey">
        <!--Banner-->
        <?php include_once './component/banner.php';?>


        <!--slider-->
        <div class="row">

        </div>
        <!--end slider-->


        <div class="row">
            <div class="container-fluid">
                <!--right panel-->
                <div class="col-md-9 col-xs-12" style="">
                    <!-- InstanceBeginEditable name="EditRegion3" -->
                    <div class="container-fluid">
                        <div class="row" align="center">
                            <div class="slider">
                                <input type="radio" name="slide_switch" id="slider1" checked="checked" />
                                <label for="slider1">
                                    <img src="http://thecodeplayer.com/uploads/media/3yiC6Yq.jpg" width="100" />
                                </label>
                                <img src="http://thecodeplayer.com/uploads/media/3yiC6Yq.jpg">

                                <input type="radio" name="slide_switch" id="slider2" />
                                <label for="slider2">
                                    <img src="http://thecodeplayer.com/uploads/media/40Ly3VB.jpg" width="100" />
                                </label>
                                <img src="http://thecodeplayer.com/uploads/media/40Ly3VB.jpg">

                                <input type="radio" name="slide_switch" id="slider3" />
                                <label for="slider3">
                                    <img src="http://thecodeplayer.com/uploads/media/00kih8g.jpg" width="100" />
                                </label>
                                <img src="http://thecodeplayer.com/uploads/media/00kih8g.jpg">

                                <input type="radio" name="slide_switch" id="slider4" />
                                <label for="slider4">
                                    <img src="http://thecodeplayer.com/uploads/media/2rT2vdx.jpg" width="100" />
                                </label>
                                <img src="http://thecodeplayer.com/uploads/media/2rT2vdx.jpg" />
                            </div>
                        </div>

                        <div class="row size-lane" >
                            <div class="col-md-8 col-xs-12">
                                <label class="size">S:</label><label>1</label>
                                <label class="size">M:</label><label>1</label>
                                <label class="size">L:</label><label>1</label>
                                <label class="size">XL:</label><label>1</label>
                                <label class="size">XXL:</label><label>1</label>
                            </div>
                            <div class="col-md-4 col-xs-12 text-right">
                                <label class="label label-" style="color: white; font-size: large">$190.00 </label>
                            </div>
                        </div>

                        <div class="row z-depth-1">
                            <div class="container-fluid">
                                <h3>Tên Sản Phẩm</h3>
                                <p><small>Ngày Đăng</small></p>
                                <span>Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm 
                                    Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm 
                                    Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm Thông tin sản phẩm 
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- InstanceEndEditable -->    
                </div>
                
                
                <!--Navigation pane-->
                <?php include_once './component/Navigation.php';?>
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
