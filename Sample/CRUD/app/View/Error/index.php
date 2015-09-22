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
	echo Html\HtmlHelper::css([
		"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css",
		"https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"], false);
	echo Html\HtmlHelper::css("cover.css");
	echo Html\HtmlHelper::js([
		"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js",
		"https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"], false);
	?>
</head>

<body>

<?php

echo \Html\HtmlHelper::tag("div",
	\Html\HtmlHelper::tag("div",
		\Html\HtmlHelper::tag("div",
			Html\HtmlHelper::tags([
				"type" => "div",
			    "class" => "masthead clearfix",
				"text" => \Html\HtmlHelper::tag('div',
					Html\HtmlHelper::tags([
						"type" => "h3",
						"class" => "masthead-brand",
						"text"  => "VtrMVC"
					], [
						"type" => "nav",
						"text" => \Html\HtmlHelper::tag("ul",
							\Html\HtmlHelper::tags([
								'type' => "li",
								"class" => "active",
								"text" => \Html\HtmlHelper::a("Home", "Error")
							],[
								'type' => "li",
								"text" => \Html\HtmlHelper::a("Home", "Home")
							]),
							"nav masthead-nav")
					]),
					"inner")
			], [
				"type" => "div",
				"class" => "inner cover",
				"text" => Html\HtmlHelper::tags(
					[
						"type" => "h1",
						"class" =>"cover-heading",
						"text" => "Error " .  \VTRMVC\Core\View::$bag["code"]
					],
					[
						"type" => "p",
						"class" => "lead",
						"text" => "Viiishh... We didn't find your request. Please verify it and try again"
					],
					[
						"type" => "p",
						"class" => "lead",
						"text" => \Html\HtmlHelper::a("home", "Bring me back to home! " . Html\BootstrapHelper::icon("hand-spock-o"), false, ["class" => "btn btn-lg btn-default"])
					]
				)
			], [
				"type" => "div",
				"class" => "mastfoot",
				"text" => \Html\HtmlHelper::tag("div",
					\Html\HtmlHelper::tag("p",'Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>'),
					"inner")
			]),
			"cover-container"),
		"site-wrapper-inner"),
	"site-wrapper");


?>
</body>
</html>