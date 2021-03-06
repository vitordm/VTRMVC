<?php

namespace VTRMVC\Core;

/**
 * Classe controlladora
 */
class Controller extends IApp\TApp
{

	/**
	 * Nome da Controller
	 * @var string
	 */
	public $name;

	/**
	 * Verifica se utilizará a model
	 * @var bool
	 */
	protected $useModel = true;

	/**
	 * Model da controller
	 * @var Model
	 */
	protected $model;

	/**
	 * Models utilizadas
	 * @var array
	 */
	protected $uses = array();

	/**
	 * Varivel que verifica se utilizará view
	 * @var bool|string
	 */
	public $view = true;

	/**
	 * @var View
	 */
	protected $View;

	/**
	 * @var string Caminho do template básico
	 */
	public $template = "";

	/**
	 * @var string nome da ação a ser executada
	 */
	public $action;

	/**
	 * @var int
	 */
	public $http_code = 200;

	/**
	 * Contrutor da classe
	 *
	 * @param string $name
	 * @param string $action
	 * @param array $attributes
	 */
	public function __construct($name = NULL, $action = NULL, $attributes = [])
	{
		//configura o nome
		if ($name)
			$this->name = $name;
		else
			$this->name = substr(__CLASS__, 0, -10);

        $this->View = new View($this);

		parent::__construct();

		$this->setAttributes($attributes);

		$this->setModel($name);

		$this->beforeAction();

		$this->setAction($action);




	}

	/**
	 * Destrutor da classe e ações finais
	 */
	public function __destruct()
	{
	}

	/**
	 * Set variavel para o template que deverá ser executado
	 *
	 * @param array $vars
	 */
	public function set(array $vars)
	{
		$this->View->set($vars);
	}

	/**
	 * Chama o método set() com os valores passados no parâmetro
	 *
	 * @param string $name
	 * @param mixed  $value
	 */
	public function setVar($name, $value)
	{
		$var[$name] = $value;
		$this->set($var);
	}

	/**
	 * Chama a classe View e executa o o html
	 */
	public function render()
	{
		if ($this->view) {
			$this->beforeRender();


			$this->View->render();
		}

	}

	/**
	 * Ação de construtor para classes filhas
	 */
	protected function startup()
	{

	}

	/**
	 * Ação executada antes de qualquer ação
	 */
	protected function beforeAction()
	{

	}

	/**
	 * Ação executada antes da renderização
	 */
	protected function beforeRender()
	{

	}

	/**
	 * Set a model que deve a ser carregada
	 *
	 * @param string $model
	 */
	protected function setModel($model)
	{
		$model = $model . 'Model';

		if ($this->useModel and App::loadModel($model)) {
			$this->model = new $model($this);
		}
	}

	protected final function setAttributes($att)
	{

		if (isset($att["template"])) {
			if (!(is_bool($this->template))) {
				$this->template = $att["template"];
			}
		}

	}


	/**
	 * @param string $action
	 */
	protected function changeAction($action)
	{
		$this->beforeAction();
		$this->setAction($action);
	}

	/**
	 * Set a açao que deve ser executada;
	 * Esse metodo executa o meotodo Controller::beforeAction()
	 *
	 * @param string $action
	 */
	protected function setAction($action)
	{
		$this->action = $action;
		$this->view = $action;
	}


	/**
	 * @return bool|string
	 */
	public function getAction()
	{
		if ($this->view and $this->action)
			return $this->action;

		return false;
	}

	/**
	 * Verifica se a requisição é Ajax
	 * @return boolean
	 */
	public function isAjax()
	{
		return Router::isAjax();
	}

	/**
	 * Carrega os component editaveis
	 *
	 * @param string $component nome do component ex: \Namespace\Component
	 */
	public function loadComponent($component)
	{
		App::loadComponent('AppComponent');

		$components = func_get_args();

		foreach ($components as $component) {
			$component = ltrim($component, "\\");
			$fulComponent = explode("\\", $component);
			$componentName = end($fulComponent);

			$component .= 'Component';

			if (App::loadComponent($component)) {
				$this->components->$componentName = new $component($this);
			}
		}
	}


	public function __toString()
	{
		return $this->name;
	}
}