<?php

use VTRMVC\Core\Controller;

class AppController extends Controller
{

	protected $nav_ident = "Home";

	public function startup()
	{
		/**
		 * Setting a URL site for HTML Helper
		 */
		Html\HtmlHelper::setBaseSite(SITE);
		Html\HtmlHelper::setCSSLink(SITE . 'css');
		Html\HtmlHelper::setJSLink(SITE . "js");

		$this->setVar("nav_ident", $this->nav_ident);

		\VTRMVC\Core\Conf::set("Site.title", "VTRMVC - Sample");


	}

}