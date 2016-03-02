<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="Description" content="HOVAEL"/>
        <meta name="author" content="eBOX"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>HOVAEL</title>

        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include './Header.php'; ?>

        <div class="container" style="padding-top: 75px; padding-bottom: 25px;">
            <?php if ($_SESSION != NULL) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Warning!</strong> Please, Sign out first....</a>
                </div>
                <?php
            } else {
                if ($_GET != NULL) {
                    if ($_GET["status"] == "1") {
                        ?>
                        <div class="center-block" style="width: 750px;">
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning!</strong> Some of your data seemed to be incorrect. Please fill this form with correct data.                
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>

                    <form id="reg_form" class="form-horizontal" onsubmit="validateRegisterForm(this);
                                            return false;" action="db/" method="POST">

                        <div class="form-group">
                            <label class="col-sm-2 control-label"> First Name</label>
                            <div id="divdate" class="col-sm-2">
                                <input id="date" type="text" class="form-control" name="fn">
                                <span id="spandate" class="" aria-hidden="true"></span>
                            </div>
                            <label class="col-sm-2 control-label"> Last Name</label>
                            <div id="divdate" class="col-sm-2">
                                <input id="date" type="text" class="form-control" name="ln">
                                <span id="spandate" class="" aria-hidden="true"></span>
                            </div>
                            <label class="col-sm-2 control-label"> Designation</label>
                            <div id="divdate" class="col-sm-2">
                                <input id="date" type="text" class="form-control" name="ln">
                                <span id="spandate" class="" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> E-Mail</label>
                            <div id="divdate" class="col-sm-2">
                                <input id="date" type="text" class="form-control" name="ln">
                                <span id="spandate" class="" aria-hidden="true"></span>
                            </div>
                            <label class="col-sm-2 control-label"> Office</label>
                            <div id="divdate" class="col-sm-2">
                                <input id="date" type="text" class="form-control" name="ln">
                                <span id="spandate" class="" aria-hidden="true"></span>
                            </div>
                            <label class="col-sm-2 control-label"> Mobile</label>
                            <div id="divdate" class="col-sm-2">
                                <input id="date" type="text" class="form-control" name="ln">
                                <span id="spandate" class="" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary pull-right">Register</button>
                            </div>
                        </div>
                    </form>

                    <?php
                }
            }
            ?>
        </div>     

        <script type="text/javascript" src="js/bootstrap/dropdown.js"></script>
        <script>
                        $('.dropdown-toggle').dropdown();
        </script>
    </body>
</html>
