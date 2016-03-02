<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="img/logo.jpg" style="height: 55px;"/>
            <!--<a class="navbar-brand" href="#">HOVAEL Constructions</a>-->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./Index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
                <?php if ($_SESSION != NULL) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo ' ' . $_SESSION['fname']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="db/SignOut.php"><span class="glyphicon glyphicon-off"></span> Sign Out</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li><a href="./SignIn.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Sign In</a></li>
                    <?php } ?>
            </ul>
        </div>
    </div>
</nav>