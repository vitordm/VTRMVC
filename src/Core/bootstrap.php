<?php
/** Simple alias for directory separator */
if (!defined('DS'))
    define("DS", DIRECTORY_SEPARATOR);

/** Core folder definition */
if(!defined('CORE'))
    define('CORE', dirname(__FILE__));

if (!defined("__SRC__"))
    define("__SRC__", dirname(CORE));

include_once CORE. DS . 'functions.php';

include_once CORE. DS . 'App.php';

