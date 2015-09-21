<?php

include "../../../vendor/autoload.php";


try {
	$app = new VTRMVC\Core\App();
	$url = isset($_GET['_url']) ? $_GET['_url'] : "";
	$app->start("../start_sample.json", $url);
} catch (\VTRMVC\Core\Exceptions\InvalidConfigurationException $inC) {
	\VTRMVC\Util\Util::varzx($inC->getMessage());
} catch (Exception $ex) {
	\VTRMVC\Util\Util::varzx($ex->getMessage());
}

