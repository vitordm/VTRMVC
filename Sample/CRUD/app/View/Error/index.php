<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">

	<title>VTRMVC - Error</title>

	<?php
	echo Html\HtmlHelper::css("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css", false);
	echo Html\HtmlHelper::css("cover.css");
	echo Html\HtmlHelper::js("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css", false);
	?>
</head>

<body>

<?php

echo \Html\HtmlHelper::tag("div",
	\Html\HtmlHelper::tag("div",
		\Html\HtmlHelper::tag("div",
			Html\HtmlHelper::tags([
				"type" => "div",
			    "class" => "masthead clearfix"
			], [
				"type" => "div",
				"class" => "inner cover"
			], [
				"type" => "div",
				"class" => "mastfoot"
			]),
			"cover-container"),
		"site-wrapper-inner"),
	"site-wrapper");


?>

<div class="site-wrapper">

	<div class="site-wrapper-inner">

		<div class="cover-container">

			<div class="masthead clearfix">
				<div class="inner">
					<h3 class="masthead-brand">Cover</h3>
					<nav>
						<ul class="nav masthead-nav">
							<li class="active"><a href="#">Home</a></li>
							<li><a href="#">Features</a></li>
							<li><a href="#">Contact</a></li>
						</ul>
					</nav>
				</div>
			</div>

			<div class="inner cover">
				<h1 class="cover-heading">Error <?= \VTRMVC\Core\View::$bag["code"] ?></h1>
				<p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
				<p class="lead">
					<a href="#" class="btn btn-lg btn-default">Learn more</a>
				</p>
			</div>

			<div class="mastfoot">
				<div class="inner">
					<p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
				</div>
			</div>

		</div>

	</div>

</div>
</body>
</html>