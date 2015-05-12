<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Đăng Nhập Quản Trị</title>
        <link rel="shortcut icon" href="asset/image/logo.ico" />
        <link rel="stylesheet" href="asset/login.css" />
        <?php
        include_once ("./Component/source.php");
        ?>
    </head>

    <body>
        <div class="row">
            <form action="" method="post" id="form_login" class="form-horizontal col-md-4 col-md-offset-4" role="form">
                <h2>Đăng Nhập Hệ Thống Quản Trị</h2>
                <div class="form-group">
                    <input type="text" class="form-control" id="txt_Account" runat="server" placeholder="Tài Khoản " />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="txt_Pass" runat="server" placeholder="Mật Khẩu" />
                </div>
                <div class="form-group">
                    <button type="button" id="btn_login" class="btn btn-info btn-block" >Đăng Nhập</button>
                </div>
                <div class="form-group">
                    <div class="alert alert-danger hidden" role="alert">
                        <span class="glyphicon glyphicon-remove"></span>
                        <span> Tài Khoản Không Tồn Tại!</span>
                    </div>
                    <div class="alert alert-success hidden" role="alert">
                        <span class="glyphicon glyphicon-check"></span>
                        <span> Đăng Nhập Thành Công! Chờ Vài Giây</span>
                    </div>
                </div>

            </form>
        </div>
        <?php include_once './Component/footer.php'; ?>
        
        <!--<script src="asset/script/Login.js"></script>-->
    </body>
</html>