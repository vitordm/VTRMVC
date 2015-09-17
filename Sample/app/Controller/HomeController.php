<?php

class HomeController extends AppController
{

    public function index()
    {
        $a = VTRMVC\Core\Conf::get("App.Configuration");
        VTRMVC\Util\Util::varz(get_class($a), get_parent_class($a), VTRMVC\Core\Conf::get("App.Configuration"), "<hr/>");
        $this->view = false;
    }

}