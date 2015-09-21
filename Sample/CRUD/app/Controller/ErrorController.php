<?php

class ErrorController extends AppController
{
	public $model = false;

	public function beforeAction()
	{
		$this->setAction("index");
	}

	public function indexAction($code = 404)
	{
		$this->template = false;
		\VTRMVC\Core\View::$bag["code"] = 404;
	}

}