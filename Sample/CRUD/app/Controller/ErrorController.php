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
		\VTRMVC\Core\View::$bag["code"] = $code;
	}

}
