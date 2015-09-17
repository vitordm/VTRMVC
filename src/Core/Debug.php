<?php

namespace VTRMVC\Core;


class Debug extends Registry
{

    public static function addVal($name, $val)
    {
        if(!self::offsetExists($name))
            self::set($name, array());

        return array_push(self::$container[$name], $val);

    }

    public static function info()
    {
        if(Conf::get('App.debug'))
        {

	        $view = new View();
	        $view->view = CORE . DS . 'View' . DS . 'debug.php';
	        $debug = array(
		        '__CONTAINER__' => self::$container,
		        '__SESSION__'   => isset($_SESSION) ?  $_SESSION : null,
		        '__POST__'      => &$_POST,
		        '__GET__'       => &$_GET,
		        '__SERVER__'    => &$_SERVER
	        );
	        $view->set(compact('debug'));

	        $view->render();
	        return;

        }
    }
} 