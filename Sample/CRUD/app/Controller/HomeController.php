<?php

class HomeController extends AppController
{

    protected $nav_ident = "Home";

    public function indexAction()
    {
        \VTRMVC\Core\View::$bag["class"] = (string)$this;
    }

    public function aboutAction()
    {
        $this->setVar('nav_ident', "About");

    }

}