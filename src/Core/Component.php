<?php

namespace VTRMVC\Core;

use VTRMVC\Core\IApp\TApp;

class Component extends TApp
{

    /**
     * Models utilizadas
     * @var array
     */
    protected $uses = array();

	/**
	 * Classe de controlle
	 * @var \AppController | Controller
	 */
	protected $controller;

    /**
     * Contrutor da classe
     */
    public function __construct(Controller &$controller = null)
    {
	    $this->controller = $controller;

	    parent::__construct();

        $this->beforeAction();
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

    public function __destruct()
    {
        
    }

    public function __toString()
    {
        return __CLASS__;
    }

}