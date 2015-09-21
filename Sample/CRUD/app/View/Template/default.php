<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <?php
    echo Html\HtmlHelper::css([
        "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css",
        "https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"], false);
    echo Html\HtmlHelper::css("justified-nav.css");

    echo Html\HtmlHelper::js("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css", false);


    ?>
    <title>Sample template</title>
</head>
<body>
<div>
    <div class="container">

        <!-- The justified navigation menu is meant for single line per list item.
			 Multiple lines will require custom code not provided by Bootstrap. -->
        <div class="masthead">
            <h3 class="text-muted">Project name</h3>
            <nav>
                <ul class="nav nav-justified">
                    <li class="active"><?= \Html\HtmlHelper::a("home", "Home"); ?></li>
                    <li><?=\Html\HtmlHelper::a("crud", "Crud"); ?></li>
                    <li><?=\Html\HtmlHelper::a("docs/index", "Learn"); ?></li>
                    <li><?=\Html\HtmlHelper::a("home/about", "About"); ?></li>

                </ul>
            </nav>
        </div>

        <!-- Jumbotron -->
        <div class="jumbotron">
            <h1>VTRMVC</h1>
            <p class="lead">Make your MVC Application easily. It's simple!</p>
            <p><a class="btn btn-lg btn-success" href="docs/getstarted" role="button">Get started today</a></p>
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

</body>
</html>