<?php

namespace VTRMVC\Core;

use VTRMVC\Core\IApp\IApp;
use VTRMVC\Core\IApp\TAppIterator;
use VTRORM\Model\LazyModel;

class Model extends LazyModel implements IApp
{
	/** @var array &$_GET Ponteiro para a variavel global $_GET */
	public $get;


	/** @var array &$_POST Ponteiro para a variavel global $_GET */
	public $post;


	/** @var array &$_GET Ponteiro para a variavel global $_GET   */
	public $files;

	/** @var \ArrayIterator Objetos  */
	public $objects;

	/**
	 * @var \VTRMVC\Core\IApp\TAppIterator
	 */
	public $models;

	/**
	 * @var \VTRMVC\Core\IApp\TAppIterator
	 */
	public $components;

	/**
	 * Construtor da classe
	 */
	public function __construct()
	{
		$this->get   = & $_GET;
		$this->post  = & $_POST;
		$this->files = & $_FILES;

		$this->objects = new \ArrayIterator();

		$this->models = new TAppIterator();

		$this->components = new TAppIterator();

		$this->startup();

		parent::__construct();
	}

	public function __get($name)
	{
		if ($this->objects->offsetExists($name))
			return $this->objects->offsetGet($name);
		return false;
	}

	public function __set($name, $val)
	{
		$this->objects->offsetSet($name, $val);
		return true;
	}

	/**
	 * Ação de construtor para classes filhas
	 */
	protected function startup()
	{

	}

	/**
	 * Carrega as controllers
	 * @param string $controller nome da controller
	 */
	public function loadController($controller)
	{
		if (App::loadController($controller))
		{
			$this->$controller = new $controller();
		}
	}

	/**
	 * Carrega as models
	 * @param string, [...] $model nome da model
	 */
	public function loadModel($model)
	{

		$models = func_get_args();

		foreach($models as $model)
		{
			$class_model = $model . 'Model';
			if (App::loadModel($class_model))
			{
				$this->models->$model = new $class_model();
			}
		}
	}

	/**
	 * Carrega os component editaveis
	 * @param string $component nome do component ex: \Namespace\Component
	 */
	public function loadComponent($component)
	{
		App::loadComponent('AppComponent');

		$components = func_get_args();

		foreach($components as $component)
		{
			$component = ltrim($component, "\\");
			$fulComponent = explode("\\", $component);
			$componentName = end($fulComponent);

			$component .= 'Component';

			if (App::loadComponent($component))
			{
				$this->components->$componentName = new $component();
			}
		}
	}

	/**
	 * To String
	 * @return string
	 */
	public function __toString()
	{
		return __CLASS__;
	}

} 