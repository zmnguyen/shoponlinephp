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
                    <!-- InstanceBeginEditable name="EditRegion3" -->
                    <div class="row" id="div_anount"></div>
                    <h2 class="page-header">Góp Ý Người Dùng</h2>
                    <div class="row hidden" id="div_message">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="control-label col-md-3">Người Gửi:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="txt_sender" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" id="txt_date"></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Nội Dung:</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="txt_content"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 pull-right">
                                    <button class="btn btn-primary" id="btn_close">Đóng</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="placeholders">
                        <table class="table text-left" id="table_Message">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Người Gửi</th>
                                    <th>Nội Dung</th>
                                    <th>Ngày Gửi</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once $_SERVER['DOCUMENT_ROOT'].'/shoponlinephp/Model/Message.php';
                                $message = new Message();

                                $listMess = $message->selectAll();
                                while ($row = mysqli_fetch_assoc($listMess)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row["MESSAGE_id"];?></td>
                                        <td><?php echo $row["MESSAGE_sender"];?></td>
                                        <td></td>
                                        <td>
                                            <?php
                                            if($row["MESSAGE_status"] == false){
                                                echo "<span class='danger'>Chưa Đọc</span>";
                                            }  else {
                                                echo "<span class='success'>Đã Đọc</span>";
                                            }
                                            ?>
                                            
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info" value="<?php echo $row["MESSAGE_id"];?>">Nội Dung</button>
                                            <button type="button" class="btn btn-danger" value="<?php echo $row["MESSAGE_id"];?>">Xóa</button>
                                            <button type="button" class="btn btn-success" value="<?php echo $row["MESSAGE_id"];?>">Đánh Dấu Đã Đọc</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>


                    <!-- InstanceEndEditable -->	
                </div>
            </div>
        </div>
        <?php include_once './Component/footer.php';?>
        <script src="script/MessageManagement.js"></script>
        <script>
            $(document).ready(function(){
                $('#div_message').slideUp("fast");
            });
            
        </script>
    </body>
    <!-- InstanceEnd -->
</html>
