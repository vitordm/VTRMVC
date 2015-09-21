<?php

use VTRMVC\Core\Controller;

class AppController extends Controller
{

	public function startup()
	{
		/**
		 * Setting a URL site for HTML Helper
		 */
		Html\HtmlHelper::setBaseSite(SITE);
		Html\HtmlHelper::setCSSLink(SITE . 'css');
		Html\HtmlHelper::setJSLink(SITE . "js");
	}

}