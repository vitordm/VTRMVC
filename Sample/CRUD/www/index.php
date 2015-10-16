<?php

include "../../../vendor/autoload.php";

try {
	$app = new VTRMVC\Core\App(); //Create object of Framework
	$url = isset($_GET['_url']) ? $_GET['_url'] : ""; //get the Friendly URL
	$app->start("../start_sample.json", $url); //Start
} catch (\VTRMVC\Core\Exceptions\InvalidConfigurationException $inC) {
	\VTRMVC\Util\Util::varzx($inC->getMessage());
} catch (Exception $ex) {
	\VTRMVC\Util\Util::varzx($ex->getMessage());
}

