
<?php
session_start();
if (!isset($_SESSION['userName'])) {
    header("location:Login.php");
}
?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Shop Online Shiver Management</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="Profile.php"><span class="glyphicon glyphicon-user"></span><span> <?php echo $_SESSION["userName"]; ?></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-book"></span> Help</a></li>
                <li>
                    <a href="#" id="btn_logout"><span class="glyphicon glyphicon-log-out"></span> Log-out</a>
                </li>
            </ul>
            <!--<form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>-->
        </div>
    </div>
</div>
