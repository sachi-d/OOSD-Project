<?php
session_start();
include './ctrl/setUserPrivilege.php';
if (!isSessionAvailable()) {
    header('Location: ./Index.php');
}
if (!isStatusOK()) {
    header('Location: ./LockScreen.php');
}
if (!isAdmin()) {
    header('Location: ./ErrorPage.php');
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
        <!-- DATA TABLES -->
        <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
        <link href="css/hover.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                        INVENTORY<small>View Inventory</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Inventory</li>
                    </ol>
                </section>

                <hr>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">


                            <?php
                            if (isset($_GET["msg"])) {
                                if ($_GET["msg"] == "error") {
                                    ?>
                                    <div class="pad margin no-print">
                                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                                            An error has occurred. Please try again.
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Custom Tabs -->
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab">Inventory</a></li>
                                            <li><a href="#tab_2" data-toggle="tab">Inventory Type</a></li>
                                            <li><a href="#tab_3" data-toggle="tab">Inventory Category</a></li>
                                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                <a href="InventoryInsert.php">
                                                    <img class="hvr-pulse-grow" src="img/add.png" 
                                                         style="position: fixed; bottom: 60px; right: 15px; z-index: 5; width: 50px; height: 50px;">
                                                </a>
                                                <table id="table_inventory" class="table table-bordered table-striped table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Code</th>
                                                            <th>Category</th>
                                                            <th>Model</th>
                                                            <th>Reg. No</th>
                                                            <th>Eng. No</th>
                                                            <th>S. No</th>
                                                            <th>Year</th>
                                                            <th>Date</th>
                                                            <th>Internal/Hire</th>
                                                            <th>Operator</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include './DBCon.php';
                                                        $res = mysqli_query($con, "SELECT * FROM inventory JOIN inventorytype ON inventory.idinventorytype = inventorytype.id JOIN inventorycat ON inventorytype.idinventorycat = inventorycat.id WHERE inventory.status!=0");
                                                        while ($row = mysqli_fetch_array($res)) {
                                                            $iduser = $row[0];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row[0]; ?></td>
                                                                <td><?php echo $row['code']; ?></td>
                                                                <td><?php echo $row['category']; ?></td>
                                                                <td><?php echo $row['model']; ?></td>
                                                                <td><?php echo $row['regno']; ?></td>
                                                                <td><?php echo $row['engno']; ?></td>
                                                                <td><?php echo $row['sno']; ?></td>
                                                                <td><?php echo $row['year']; ?></td>
                                                                <td><?php echo $row['date']; ?></td>
                                                                <td><?php echo $row['hireinternal']; ?></td>
                                                                <td><?php echo $row['operator']; ?></td>
                                                                <td style="max-width: 50px;">
                                                                    <?php if ($row['status'] == '1') { ?>
                                                                        <form action="db/ChangeStatus.php" method="POST">
                                                                            <input type="hidden" name="id" value="<?php echo $row[0]; ?>"/>
                                                                            <input type="hidden" name="table" value="inventory"/>
                                                                            <input type="hidden" name="url" value="InventoryView"/>
                                                                            <div class="btn-group">
                                                                                <button type="submit" class="btn btn-xs btn-danger"><span class='glyphicon glyphicon-remove'></span></button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } else { ?>
                                                                        <div class="btn-group">
                                                                            <?php if (isAdmin()) { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                                    <span class="caret"></span>
                                                                                </button>  
                                                                                <ul class="dropdown-menu" role="menu">
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row[0]; ?>&status=0&table=inventory&url=InventoryView">Approve</a></li>
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row[0]; ?>&status=1&table=inventory&url=InventoryView">Cancel</a></li>
                                                                                </ul>
                                                                            <?php } else { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>                                                  
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <form action="InventoryUpdate.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $row[0]; ?>"/>
                                                                        <?php if (isAdmin()) { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs">Update</button>
                                                                        <?php } else { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs" disabled>Update</button>
                                                                        <?php } ?>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div><!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_2">
                                                <a href="InventoryTypeInsert.php">
                                                    <img class="hvr-pulse-grow" src="img/add.png" 
                                                         style="position: fixed; bottom: 60px; right: 15px; z-index: 5; width: 50px; height: 50px;">
                                                </a>
                                                <table id="table_inventorytype" class="table table-bordered table-striped table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Category</th>
                                                            <th>Model</th>
                                                            <th>Make</th>
                                                            <th>Capacity</th>
                                                            <th>Country</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include './DBCon.php';
                                                        $res = mysqli_query($con, "SELECT * FROM inventorytype JOIN inventorycat ON inventorytype.idinventorycat = inventorycat.id WHERE inventorytype.status!=0");
                                                        while ($row = mysqli_fetch_array($res)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row[0]; ?></td>
                                                                <td><?php echo $row['category']; ?></td>
                                                                <td><?php echo $row['model']; ?></td>
                                                                <td><?php echo $row['make']; ?></td>
                                                                <td><?php echo $row['capacity']; ?></td>
                                                                <td><?php echo $row['country']; ?></td>
                                                                <td style="max-width: 50px;">
                                                                    <?php if ($row['status'] == '1') { ?>
                                                                        <form action="db/ChangeStatus.php" method="POST">
                                                                            <input type="hidden" name="id" value="<?php echo $row[0]; ?>"/>
                                                                            <input type="hidden" name="table" value="inventorytype"/>
                                                                            <input type="hidden" name="url" value="InventoryView"/>
                                                                            <div class="btn-group">
                                                                                <button type="submit" class="btn btn-xs btn-danger"><span class='glyphicon glyphicon-remove'></span></button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } else { ?>
                                                                        <div class="btn-group">
                                                                            <?php if (isAdmin()) { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                                    <span class="caret"></span>
                                                                                </button>  
                                                                                <ul class="dropdown-menu" role="menu">
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row[0]; ?>&status=0&table=inventorytype&url=InventoryView">Approve</a></li>
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row[0]; ?>&status=1&table=inventorytype&url=InventoryView">Cancel</a></li>
                                                                                </ul>
                                                                            <?php } else { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>                                                  
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <form action="InventoryUpdate.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $row[0]; ?>"/>
                                                                        <?php if (isAdmin()) { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs">Update</button>
                                                                        <?php } else { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs" disabled>Update</button>
                                                                        <?php } ?>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div><!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_3">
                                                <a href="InventoryCategoryInsert.php">
                                                    <img class="hvr-pulse-grow" src="img/add.png" 
                                                         style="position: fixed; bottom: 60px; right: 15px; z-index: 5; width: 50px; height: 50px;">
                                                </a>
                                                <table id="table_inventorycat" class="table table-bordered table-striped table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Category</th>
                                                            <th>Type</th>
                                                            <th>Service (hrs/km)</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include './DBCon.php';
                                                        $res = mysqli_query($con, "SELECT * FROM inventorycat WHERE inventorycat.status!=0");
                                                        while ($row = mysqli_fetch_array($res)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row[0]; ?></td>
                                                                <td><?php echo $row['category']; ?></td>
                                                                <td><?php echo $row['type']; ?></td>
                                                                <td><?php echo $row['service']; ?></td>
                                                                <td style="max-width: 50px;">
                                                                    <?php if ($row['status'] == '1') { ?>
                                                                        <form action="db/ChangeStatus.php" method="POST">
                                                                            <input type="hidden" name="id" value="<?php echo $row[0]; ?>"/>
                                                                            <input type="hidden" name="table" value="inventorycat"/>
                                                                            <input type="hidden" name="url" value="InventoryView"/>
                                                                            <div class="btn-group">
                                                                                <button type="submit" class="btn btn-xs btn-danger"><span class='glyphicon glyphicon-remove'></span></button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } else { ?>
                                                                        <div class="btn-group">
                                                                            <?php if (isAdmin()) { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                                    <span class="caret"></span>
                                                                                </button>  
                                                                                <ul class="dropdown-menu" role="menu">
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row[0]; ?>&status=0&table=inventorycat&url=InventoryView">Approve</a></li>
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row[0]; ?>&status=1&table=inventorycat&url=InventoryView">Cancel</a></li>
                                                                                </ul>
                                                                            <?php } else { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>                                                  
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <form action="InventoryUpdate.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $row[0]; ?>"/>
                                                                        <?php if (isAdmin()) { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs">Update</button>
                                                                        <?php } else { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs" disabled>Update</button>
                                                                        <?php } ?>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div><!-- /.tab-pane -->
                                        </div><!-- /.tab-content -->
                                    </div><!-- nav-tabs-custom -->
                                </div><!-- /.col -->
                            </div>

                        </div>
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <?php include './Footer.php'; ?>

        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
            $(function () {
                $("#table_inventory").DataTable();
                $("#table_inventorytype").DataTable();
                $("#table_inventorycat").DataTable();
            });
        </script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
              Both of these plugins are recommended to enhance the
              user experience. Slimscroll is required when using the
              fixed layout. -->
    </body>
</html>