<?php

namespace VTRMVC\Core;

use VTRMVC\Core\Exceptions\InvalidRouteException;
use VTRMVC\Core\IApp\TApp;
use VTRMVC\Util\Util;

class View extends TApp
{
	/** @var array Variaveis que serão extraidas */
	public $vars = array();

	/** @var Controller Controller de toda ação  */
	public $controller;

	/** @var string Ação da controller que deve ser executada */
	public $action;

	/** @var string  */
	public $view = null;

	/** @var string  */
	public $folder = null;

	/** @var string  */
	public $template = null;

	/** @var string  */
	public $layout = "html";

	/** @var null|string */
	protected $error_page = null;

	/** @var array Variaveis */
	public static $bag = [];

	const HTTP_CODE_OK = 200;
	const HTTP_CODE_NOT_MODIFIED = 304;
	const HTTP_CODE_UNAUTHORIZED = 401;
	const HTTP_CODE_FORBIDDEN = 403;
	const HTTP_CODE_NOT_FOUND = 404;

	const HTTP_CODE_INTERNAL_SERVER_ERROR = 500;


	/**
	 * @param Controller $controller
	 */
	public function __construct(Controller &$controller = null)
	{
		$this->controller = &$controller;

		parent::__construct();
	}

	/**
	 * Set vars
	 * @param array $var
	 */
	public function set(array $var)
	{
		if ($var) {
			foreach ($var as $key => $value) {
				$this->vars[$key] = $value;
			}
		}
	}

	/**
	 * Display Template
	 */
	public function render()
	{

		if ($this->controller) {
            $this->define_http_code($this->controller->http_code);
			$this->action = ($this->controller->view) ? $this->controller->view : "";
			$this->folder = str_replace("\\", DS, $this->controller->name);
			$this->template = $this->controller->template;
		}

        $this->defineLayout();

		if (!$this->view) {

            $app = APP . DS . 'View' . DS . $this->folder  . DS . $this->action . '.php';

			if (file_exists($app))
				$this->view = $app;
			else
				$this->view = false;
		}

		extract($this->vars);


		if ($this->view) {

			if ($this->template) {
				include($this->template);
			}
			else {
				include $this->view;
				//$this->import($this->view);
			}
		}
		else
			$this->include_error_page();

	}

	/**
	 * Inclui partes do template na página
	 */
	public function loadTemplate($template)
	{
		$template = str_replace(array('\\', '/'), DS, $template);
		$templateFile = TEMPLATE_PATH . DS . $template . '.php';

		if (file_exists($templateFile)) {
			$this->import($templateFile);
		}
		else {
			die('Error: "' . $template . '" template not found!<br />');
		}
	}

	/**
	 * @param $path
	 */
	public function setPageError($path)
	{
		$this->error_page = $path;
	}

	/**
	 * Inclui a página de erro ao renderizar
	 */
	public function include_error_page()
	{
		$this->define_http_code(self::HTTP_CODE_NOT_FOUND);
		if ($this->error_page)
			App::import($this->error_page);
		else
			throw new InvalidRouteException("Not possible execute view");
	}

	/**
	 * Inclui um arquivo
	 *
	 * @param string $file
	 */
	public function import($file)
	{
		require $file;
	}


	/**
	 * Define a header da página
	 */
	private function defineLayout()
	{
		switch ($this->layout) {
			case "html" :
				header('Content-type: text/html; charset=UTF-8');
				return;
			case "xml":
				header('Content-Type: application/xml; charset=utf-8');
				return;
			case "json":
				header('Content-Type: application/json; charset=UTF-8');
				return;
			case "txt":
			case "plain":
				header('Content-Type: text/plain');
				return;
		}
	}

	public function define_http_code($http_code = self::HTTP_CODE_OK)
	{

		if (is_int($http_code) || is_string($http_code)) {


            switch ($http_code) {
                case self::HTTP_CODE_OK :
                    header("HTTP/1.0 200 OK");
                    return;
                case self::HTTP_CODE_NOT_MODIFIED:
                    header("HTTP/1.0 304 Not Modified");
                    return;
                case self::HTTP_CODE_UNAUTHORIZED:
                    header("HTTP/1.0 401 Unauthorized");
                    return;
                case self::HTTP_CODE_FORBIDDEN:
                    header("HTTP/1.0 403 Forbidden");
                    return;
                case self::HTTP_CODE_NOT_FOUND:
                    header("HTTP/1.0 404 Not Found");
                    return;
                case self::HTTP_CODE_INTERNAL_SERVER_ERROR:
                    header("HTTP/1.0 500 Internal Server Error");
                    return;
                default:
                    header("HTTP/1.0 " . $http_code);
                    return;


            }
        } else {
            throw new \InvalidArgumentException("Invalid argument to set header");
        }

	}

}