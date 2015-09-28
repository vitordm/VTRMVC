<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <?php
    echo Html\HtmlHelper::css([
        "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css",
        "https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"], false);
    echo Html\HtmlHelper::css("justified-nav.css");

    echo Html\HtmlHelper::js([
        "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js",
        "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
        ], false);


    ?>
    <link rel="icon" href="<?= SITE ?>/favicon.ico">
    <script type="text/javascript" >
        var SITE = "<?= SITE ?>";
        var CURRENT_URL = "<?= VTRMVC\Core\Router::getCurrentUrl(); ?>";
    </script>

    <title><?= VTRMVC\Core\Conf::get("Site.title") ?></title>
</head>
<body>
<div>
    <div class="container">

        <!-- The justified navigation menu is meant for single line per list item.
			 Multiple lines will require custom code not provided by Bootstrap. -->
        <div class="masthead">
            <h3 class="text-muted"><?= \VTRMVC\Core\Conf::get("App.Settings")->getSiteName() ?></h3>
            <nav>
                <ul class="nav nav-justified">
                    <li id="Home"><?= \Html\HtmlHelper::a("home", "Home"); ?></li>
                    <li id="Crud"><?=\Html\HtmlHelper::a("crud", "Crud"); ?></li>
                    <li id="Error"><?=\Html\HtmlHelper::a("error/404", "Error page"); ?></li>
                    <li id="Learn"><?=\Html\HtmlHelper::a("docs/index", "Learn"); ?></li>
                    <li id="About"><?=\Html\HtmlHelper::a("home/about", "About"); ?></li>

                </ul>
            </nav>
        </div>

        <!-- Jumbotron -->
        <div class="jumbotron">
            <h1>VTRMVC</h1>
            <p class="lead">Make your MVC Application easily. It's simple!</p>
            <p><a class="btn btn-lg btn-success" href="<?= SITE ?>docs/getstarted" role="button"><i class="fa fa-hand-o-right"></i> Get started today</a></p>
        </div>

        <!-- Example row of columns -->
        <div class="row">
            <?php include $this->view ?>
        </div>

        <!-- Site footer -->
        <footer class="footer">
            <p>&copy; VTRMVC 2015 <?= \Html\BootstrapHelper::icon("hand-peace-o")?></p>
        </footer>

    </div> <!-- /container -->

</div>

<script>
    $(document).ready(function(){
        $("#<?= $nav_ident ?>").addClass("active");
    });
</script>

</body>
</html>