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
    <body style="padding-top: 100px;">

        <?php include './Header.php'; ?>

        <div class="container text-center">

            <form id="signin_form" class="form-horizontal center-block" action="ctrl/search.php" method="POST">
                <div class="form-group">
                    <img class="img-circle center-block" src="img/user.png" width="200"/>
                </div>

                <div class="form-group">
                    <input type="text" name="un" class="form-control center-block" style="width: 300px" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="pw" class="form-control center-block" style="width: 300px" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="submit" value="SIGN IN" class="btn btn-primary btn-sm"/>
                </div>
                <div class="form-group">
                    <span class="a-btn-text">Not a member yet?</span> 
                    <span class="a-btn-slide-text">
                        <a href="#" class="a-btn">Create an account</a>
                    </span>
                    <span class="a-btn-icon-right"><span></span></span>
                </div>
            </form>

        </div>

        <script type="text/javascript" src="js/bootstrap/dropdown.js"></script>
        <script>
            $('.dropdown-toggle').dropdown();
        </script>
    </body>
</html>
