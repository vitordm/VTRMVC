<?php

echo \Html\HtmlHelper::table(
	["id", "Name",  "E-mail", "#"],
	[
		[
			"1",
			"Snow, John",
			"",
			(
				\Html\HtmlHelper::a("crud/edit/1", \Html\BootstrapHelper::icon("pencil"), true, ['style' => "color:blue"] ) ." | " .
				\Html\HtmlHelper::a("crud/delete/1", \Html\BootstrapHelper::icon("times"), true, ['style' => "color:red"])
			)
		],
	],
	[
		[
			"1",
			"Snow, John",
			"",
			(
				\Html\HtmlHelper::a("crud/edit/1", \Html\BootstrapHelper::icon("pencil"), true, ['style' => "color:blue"] ) ." | " .
				\Html\HtmlHelper::a("crud/delete/1", \Html\BootstrapHelper::icon("times"), true, ['style' => "color:red"])
			)
		],
	],
	[
		[
			"1",
			"Snow, John",
			"",
			(
				\Html\HtmlHelper::a("crud/edit/1", \Html\BootstrapHelper::icon("pencil"), true, ['style' => "color:blue"] ) ." | " .
				\Html\HtmlHelper::a("crud/delete/1", \Html\BootstrapHelper::icon("times"), true, ['style' => "color:red"])
			)
		],
	]

);