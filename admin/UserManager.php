<!doctype html>
<html><!-- InstanceBegin template="/Templates/admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta charset="utf-8">
        <title>Untitled Document</title>
        <?php include_once './Component/source.php'; ?>
    </head>

    <body>
        <?php include_once './Component/Head.php'; ?>

        <div class="container-fluid">
            <div class="row">
                <?php include_once './Component/navigation.php';?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-md-3">Id:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Id Vài Trò" id="txt_id" name="id" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tên Vai Trò:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Tên vai Trò" id="txt_name" name="name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Chức Năng:</label> 
                            <div class="col-md-9">
                                
                            </div>
                        </div>
                        <div class="form-group" id="dic_anount">
                            
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-success" id="btn_submit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
