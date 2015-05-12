<!doctype html>
<html><!-- InstanceBegin template="/Templates/admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta charset="utf-8">
        <!-- InstanceBeginEditable name="doctitle" -->
        <title>Quản Lý Danh Mục</title>
        <!-- InstanceEndEditable -->
        <!-- InstanceBeginEditable name="head" -->
        <!-- InstanceEndEditable -->
        <?php
        include_once './Component/source.php';
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
                include_once '../Model/Categories.php';
                ?>
                <div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-2 main">
                    <div class="row col-md-9" >
                        <?php
                        $categories = new Categories();
                        ?>
                        <form class="form-horizontal" id="form_Cate">
                            <div class="form-group">
                                <label class="control-label col-md-4">ID Mục:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="id" placeholder="Id của Sản Phẩm" readonly/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Tên:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" id="txt_name" placeholder="Tên Sản Phẩm" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Thuộc Mục:</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="parent">
                                        <option value="">none</option>
                                        <?php
                                        $listCate = $categories->selectAll();
                                        while($row = mysqli_fetch_assoc($listCate)){
                                            echo "<option value='".$row["CATE_id"]."'>".$row["CATE_name"]."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="div_anount">
                                <div class="alert alert-success hidden" >
                                    <span class="glyphicon glyphicon-check"></span> Thêm Sản Phẩm Thành Công
                                </div>

                                <div class="alert alert-danger hidden">
                                    <span class="glyphicon glyphicon-remove"></span> Lỗi Thêm Sản Phẩm và Console biết thêm chi tiết
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <button type="button" class="btn btn-success" id="btn_submit">Submit</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>
                        </form>
                    </div>
                    <div class="row" style="clear: both">
                        <h3 class="page-header">Danh Mục</h3>
                        <table class="table table-hover" id="table_cate">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Danh Mục Cha</th>
                                    <th>Tác Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $baseUrl = $_SERVER['PHP_SELF'];
                                $cate = new Categories();

                                $loadcate = $cate->selectAll();
                                while ($load = mysqli_fetch_array($loadcate)) {
                                    
                                    $parent = "";
                                    $listCate = $categories->selectAll();
                                    while ($cate = mysqli_fetch_array($listCate)) {
                                        if ($load["CATE_parent"] == $cate["CATE_id"]) {
                                            $parent = $cate["CATE_name"];
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $load["CATE_id"]; ?></td>
                                        <td><?php echo $load["CATE_name"]; ?></td>
                                        <td><?php echo $parent;?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" value="<?php echo $load["CATE_id"] ?>">Chỉnh Sửa</button>
                                            
                                            <button type="button" class="btn btn-danger" value='<?php echo $load["CATE_id"] ?>'>Xóa</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php include_once './Component/footer.php'; ?>

                <script src="script/CateManagement.js"></script>
            </div>
        </div>
    </body>
    <!-- InstanceEnd --></html>
