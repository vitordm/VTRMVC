<?php

class ErrorController extends AppController
{
	public $model = false;

	public $http_code = 404;

	public function beforeAction()
	{
		$this->setAction("index");
	}

	public function indexAction($code = 404)
	{
		$this->template = false;
		if ($this->isAjax()) {
			$this->View->layout = "json";
			$this->view = "index.ajax";

		}

		\VTRMVC\Core\View::$bag["code"] = $code;
	}

}
