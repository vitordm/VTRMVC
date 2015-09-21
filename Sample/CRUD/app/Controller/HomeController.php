<?php

class HomeController extends AppController
{

    public function indexAction()
    {
        \VTRMVC\Core\View::$bag["class"] = (string)$this;
    }

    public function aboutAction()
    {

    }

}