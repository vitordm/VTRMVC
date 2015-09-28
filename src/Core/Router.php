<?php

namespace VTRMVC\Core;

/**
 * Description of Router
 *
 * @author VitorG
 */
class Router
{

    //getUrlAtual
	/**
	 * @return string
	 */
    public static function getCurrentUrl()
    {
        $protocolo  = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false) ? 'http' : 'https';
        $host       = $_SERVER['HTTP_HOST'];
        $script     = $_SERVER['SCRIPT_NAME'];
        $parametros = $_SERVER['QUERY_STRING'];

        global $url;

        if(strpos(substr($script, -9), 'index.php') !== false )
            $script = substr($script, 0, -9) . $url;

        $parametros = str_replace(array( "_url={$url}&","_url={$url}"), '', $parametros);
        if($parametros)
            $parametros = "?" .$parametros;
        $UrlAtual   = $protocolo . '://' . $host . $script . $parametros;  //. '?' . $parametros;

        return $UrlAtual;
    }

	/**
	 * @return string
	 */
    public static function getURL()
    {
        $protocolo  = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false) ? 'http' : 'https';
        $host       = $_SERVER['HTTP_HOST'];
        $script     = $_SERVER['SCRIPT_NAME'];

        if(strpos(substr($script, -9), 'index.php') !== false )
            $script = substr($script, 0, -9);

        $UrlAtual   = $protocolo . '://' . $host . $script;

        return $UrlAtual;
    }

	/**
	 * @param $path
	 */
    public static function redirect($path)
    {
        header('location: ' . SITE . $path);
    }

	/**
	 * Verifica se a requisição é Ajax
	 * @return boolean
	 */
	public static  function isAjax () {
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
			return true;
		else
			return false;
	}

}
