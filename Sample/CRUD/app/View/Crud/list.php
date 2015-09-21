<?php

echo \Html\HtmlHelper::table(
	["id", "Name",  "E-mail", "#"],
	[
		["1", "Snow, John", "", "Edit | Delete"],
		["2", "Snow, John", "", "Edit | Delete"],
		["3", "Snow, John", "", "Edit | Delete"],
	]
);