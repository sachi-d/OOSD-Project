<?php
session_start();
include './ctrl/setUserPrivilege.php';
if (!isSessionAvailable()) {
    header('Location: ./Index.php');
}
if (!isStatusOK()) {
    header('Location: ./LockScreen.php');
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>HOVAEL</title>
        <link rel="shortcut icon" href="img/favicon.png">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="./com.ebox.hovael.css/portBox.css" rel="stylesheet" type="text/css" />
        <link href="css/hover.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include './Header.php'; ?>
            <?php include './SideBar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        INTERNAL HIRE RATE <small>Update Rate</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Internal Hire Rate</li>
                    </ol>
                </section>

                <hr>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">

                            <?php
                            if (isset($_GET["msg"])) {
                                if ($_GET["msg"] == "error") {
                                    ?>
                                    <div class="pad margin no-print">
                                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                                            Some of your data seemed to be incorrect. Please try again.
                                        </div>
                                    </div>
                                    <?php
                                }
                            }

                            if (isset($_POST["id"])) {
                                $id = $_POST["id"];
                            }

                            include './DBCon.php';
                            $res = mysqli_query($con, "SELECT * FROM inventorytype a , inventorycat b ,internalhirerate c where $id=c.id and c.idinventorytype=a.id and a.idinventorycat=b.id ");
                            if ($row = mysqli_fetch_array($res)) {
                                ?>

                                <div class="box box-info">
                                    <!-- form start -->
                                    <form id="updateForm" class="form-horizontal" action="db/UpdateInternalHireRate.php" method="POST">

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> ID :</label>
                                                <div class="col-sm-10">
                                                    <label id="id" class="control-label"> <?php echo $id; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Vehicle/Machine :</label>
                                                <div class="col-sm-5">
                                                    <label id="vehiclemachine" class="control-label"> <?php echo $row['category'] . " | " . $row['model']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Unit :</label>
                                                <div class="col-sm-2">
                                                    <select id="unit" name="unit" class="form-control" required="">
                                                        <option value="select" disabled="">Select Unit</option>
                                                        <?php if ($row['unit'] == '0') { ?>
                                                            <option value="0" selected="">HOURS</option>
                                                            <option value="1">DAYS</option>
                                                            <option value="2">MONTHS</option>
                                                        <?php } else if ($row['unit'] == '1') { ?>
                                                            <option value="0">HOURS</option>
                                                            <option value="1" selected="">DAYS</option>
                                                            <option value="2">MONTHS</option>
                                                        <?php } else if ($row['unit'] == '2') { ?>
                                                            <option value="0">HOURS</option>
                                                            <option value="1">DAYS</option>
                                                            <option value="2" selected="">MONTHS</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 control-label"> Estimated Hours :</label>
                                                <div class="col-sm-2">
                                                    <input id="hrs" name="hrs" type="text" class="form-control" value="<?php echo $row['estimatedhrs']; ?>" required="">
                                                </div>
                                                <label class="col-sm-2 control-label"> Proposed Rate :</label>
                                                <div class="col-sm-2">
                                                    <input id="rate" name="rate" type="text" class="form-control" value="<?php echo $row['rate']; ?>" required="">
                                                </div>
                                            </div>
                                            <input name="id" type="hidden" value="<?php echo $id; ?>">   
                                        </div>

                                        <div class="box-footer">
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- /.box -->
                            <?php } ?>
                        </div>
                    </div>

                    <button data-display="modalWindowValidate" data-animation="fade" data-animationspeed="300" data-closeBGclick="true" id="modalButtonValidate" style="display: none">My Project</button><br>
                    <!--portBox Content--> 
                    <div id="modalWindowValidate" class="col-md-5 portBox">
                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                            Some of your  data seemed to be incorrect. Please try again.
                        </div>
                    </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <?php include './Footer.php'; ?>
            <?php include './ControlSideBar.php'; ?>

        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="plugins/jQueryUI/jquery-ui.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>
        <script src="dist/js/demo.js" type="text/javascript"></script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
              Both of these plugins are recommended to enhance the
              user experience. Slimscroll is required when using the
              fixed layout. -->

        <script type="text/javascript" src="plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="./com.ebox.hovael.js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="./com.ebox.hovael.js/portBox.slimscroll.min.js"></script>

        <!--Validation-->
        <script>
            $(document).on('submit', '#updateForm', function () {
                if (!$.isNumeric($('#hrs').val()) || !$.isNumeric($('#rate').val()) || $('#type').val() === null || $('#unit').val() === null) {
                    event.preventDefault();
                    $('#modalButtonValidate').click();
                }
            });
        </script>
    </body>
</html>