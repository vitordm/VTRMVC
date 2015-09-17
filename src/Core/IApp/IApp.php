<?php

namespace VTRMVC\Core\IApp;

/**
 * Interface de implementação de Controller e Components
 */ 
interface IApp
{
    /**
     * Carrega as controllers
     * @param string $controller nome da controller
     */ 
    public function loadController($controller);
    
    /**
     * Carrega as models
     * @param string $model nome da model
     */ 
    public function loadModel($model);
    
    /**
     * Carrega os component editaveis
     * @param string $component nome do component ex: \Namespace\Component
     */ 
     public function loadComponent($component);
}