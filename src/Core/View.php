<?php

namespace VTRMVC\Core;

use Html\HtmlHelper as HtmlHelper;
use Html\FormHelper as FormHelper;
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

	/** @var HtmlHelper */
	public $html;

	/** @var FormHelper */
	public $form;

	/** @var array Variaveis */
	public static $bag = [];


	/**
	 * @param Controller $controller
	 */
	public function __construct(Controller &$controller = null)
	{
		$this->controller = $controller;

		$this->html = new HtmlHelper(SITE);
		$this->form = new FormHelper(SITE);

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
		$this->defineLayout();

		if ($this->controller) {
			$this->action = $this->controller->getAction();
			$this->folder = str_replace("\\", DS, $this->controller->name);
			$this->template = $this->controller->template;
		}


		if (!$this->view) {

            $app = APP . DS . 'View' . DS . $this->folder  . DS . $this->action . '.php';

			if (file_exists($app))
				$this->view = $app;
			else
				$this->view = false;
		}


		extract($this->vars);
		$html = &$this->html;
		$form = &$this->form;


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
		header("HTTP/1.0 404 Not Found");
		if ($this->error_page)
			App::import($this->error_page);
		else
			die("Not possible execute view");
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

}