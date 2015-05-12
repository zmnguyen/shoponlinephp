<!doctype html>
<html><!-- InstanceBegin template="/Templates/admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta charset="utf-8">
        <!-- InstanceBeginEditable name="doctitle" -->
        <title>Untitled Document</title>
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
                ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="page-header">Quản Lý Event</h2>
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Danh Sách Event</a></li>
                            <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Thông Tin Event</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active fade in" id="tab1">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tên Chương Trình</th>
                                            <th>Giảm Giá</th>
                                            <th>Bắt Đầu - Kết Thúc</th>
                                            <th>Tình Trạng</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once '../Model/Event.php';
                                        $event = new Event();

                                        $listEvent = $event->selectAll();

                                        while ($row = mysqli_fetch_assoc($listEvent)) {
                                            echo "<tr>"
                                            . "<td>" . $row["EVENT_id"] . "</td>"
                                            . "<td>" . $row["EVENT_name"] . "</td>"
                                            . "<td>" . $row["EVENT_discount"] . "%</td>"
                                            . "<td>" . $row['EVENT_from'] . "-" . $row['EVENT_to'] . "</td>"
                                            . "<td></td>"
                                            . "<button type='button' class='btn btn-info' value='" . $row["EVENT_id"] . "' >Thông Tin</button>"
                                            . "<button type='button' class='btn btn-danger' value='" . $row["PRODUCT_id"] . "' >Xóa</button>"
                                            . "<td></td>"
                                            . "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="tab2">
                                <form class="form-horizontal" role="form" id="form_event">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Id:</label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="action" id="txt_action" />
                                            <input type="text" class="form-control" placeholder="Id Event" id="txt_id" name="id" readonly />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Banner:</label>
                                        <div class="col-md-9">
                                            <input type="file" class="img img-thumbnail" name="banner" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Tên Event:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Tên vai Trò" id="txt_name" name="name" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Giảm Giá:</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Phần Trăm Giảm Giá Cho Sự Kiện">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Bắt Đầu - Kết Thúc:</label>
                                        <div class="col-md-9">
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="from" />
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="to" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Nội Dung:</label>
                                        <div class="col-md-9">
                                            <textarea class="ckeditor" name="content" id="txt_editor"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Các Loại Hàng Giảm Giá:</label> 
                                        <div class="col-md-9">
                                            <?php
                                            include_once '../Model/Categories.php';
                                            $Cate = new Categories();

                                            $listCate = $Cate->selectAll();
                                            while ($row = mysqli_fetch_assoc($listCate)) {
                                                ?>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <input type="checkbox" name="Categories" value="<?php echo $row["CATE_id"]; ?>" />
                                                        </span>
                                                        <input type="text" class="form-control" value="<?php $row["CATE_name"] ?>" readonly />
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_anount">

                                    </div>
                                    <div class="form-group pull-right col-md-6">
                                        <button type="button" class="btn btn-success" id="btn_submit">Submit</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include_once './Component/footer.php';
        ?>
        <script>
            CKEDITOR.replace('txt_editor', {
                filebrowserUploadUrl: '../ckeditor/plugins/imgupload/imgupload.php',
                filebrowserImageUploadUrl: '../ckeditor/plugins/imgupload/imgupload.php?type=Images'
            });
        </script>

        <script type="text/javascript" src="script/EventManagement.js"></script>

        <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
        <script>
            webshims.setOptions('forms-ext', {types: 'date'});
            webshims.polyfill('forms forms-ext');
        </script>
    </body>
    <!-- InstanceEnd -->
</html>
