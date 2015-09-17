<?php

namespace VTRMVC\Core;

use VTRMVC\Configuration\AppSettings;

class App
{

    /** @var string */
    public $actionDefault = "index";
    /** @var string */
    public $contollerDefault = "Home";
    /** @var Controller */
    public $controller;
    /** @var  AppSettings */
    private $configuration;
    /** @var bool Block dispacth to execute */
    public $blockLoad = false;

    /**
     * @param string $json_path
     * @param string $action
     * @throws \Exception
     */
    public function start($json_path, $action = "home/index")
    {
        try {

            $this->configuration = $this->loadJsonConfigs($json_path);
            $this->setEnvironment();
            $this->setDebug();
            $this->setConstants();

            $this->removeMagicQuotes();
            $this->unregisterGlobals();

            $this->actionDefault = $this->configuration->getMVCActionDefault();
            $this->contollerDefault = $this->configuration->getMVCControllerDefault();

            $this->dispatch($action);

        } catch (\Exception $ex) {
            throw $ex;

        }
    }

    /**
     * Dispatch
     * @param $action
     */
    private function dispatch($action)
    {
        if ($this->blockLoad)
            return;

        if (empty($action)) {
            $action = $this->contollerDefault . "/" . $this->actionDefault;
        }
        $app_action = $this->getAction($action);

        $controller = $app_action->controller_class;


        if ($this->configuration->useMVCAppController())
            App::loadController('AppController');

        if ($this->configuration->useMVCAppModel())
            App::loadModel('AppModel');

        if (App::loadController($controller)) {

            $suffix_action = $this->configuration->getMVCSuffixAction();

            $action_method = $app_action->action . $suffix_action;

            $dispatch = new $controller($app_action->controller, $action_method);

            $this->executeController($dispatch, $app_action->action, $app_action->params);

        } else {
            $this->executeError();
        }

    }

    /**
     * @param Controller $controller
     * @param $action
     * @param $params
     */
    private function executeController(Controller $controller, $action, $params)
    {
        $this->controller = $controller;

        $template = $this->configuration->getMVCTemplate();

        if ($template)
            $controller->template = $template;

        if (method_exists($this->controller, $action)) {
            call_user_func_array(array ($this->controller, $action), $params);
        }

        $this->controller->render();

    }

    /**
     * @throws Exceptions\InvalidRouteException
     */
    private function executeError()
    {

        if ($this->configuration->getRoute("404")) {

            $action = $this->getAction($this->configuration->getRoute("404"));

            if (!App::loadController($action->controller)) {
                throw new Exceptions\InvalidRouteException("Error - Invalid route definition");
            }

            Router::redirect($this->configuration->getRoute("404"));
        }

        throw new Exceptions\InvalidRouteException("Error 404 - Not found");
    }

    /**
     * Load and set configuration for application
     * @param $json
     * @return AppSettings
     * @throws \Exception
     */
    private function loadJsonConfigs($json)
    {

        if (strpos($json, "{") === false) {

            $json = file_get_contents($json);

            if (!$json)
                throw new Exceptions\StartException("Could not load json file!");
        }

        $json = json_decode($json, true);

        if (!$json)
            throw new Exceptions\StartException("Failed to load configuration. " . __FUNCTION__);

        try {
            $configuration = new AppSettings($json);
        } catch (\Exception $ex) {
            throw $ex;
        }

        Conf::set("App.Configuration", $configuration);

        return $configuration;

    }

    /**
     * set the environment
     */
    private function setEnvironment()
    {
        $ambience = $this->configuration->getEnvironment();

        if (is_null($ambience)) {

            // Identify Ambience
            $verifyLocalHost = (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false);
            $verifyLocalIp = (strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false);
            $verifyLocalServidor = (strpos($_SERVER['HTTP_HOST'], 'servidor') !== false);
            $verifyC9 = (strpos($_SERVER['HTTP_HOST'], 'c9.io') !== false);

            if ($verifyLocalServidor or $verifyLocalIp or $verifyLocalHost or $verifyC9)
                $ambience = false;

        }

        Conf::w('App.online', $ambience);

    }

    /**
     * Set Debug of application
     */
    private function setDebug()
    {
        $ambience = Conf::get("App.online", false);

        $debug = !$ambience;

        if ($this->configuration->offsetExists("debug"))
            $debug = $this->configuration->debug;

        Conf::set("App.debug", $debug);
    }

    /**
     * Set default constants
     */
    private function setConstants()
    {

        if (!defined('APP')) {
            define("APP", $this->configuration->getMVCPath());
        }

        if (!defined('TEMPLATE_PATH')) {
            define("TEMPLATE_PATH", $this->configuration->mvc->view->template_folder);
        }

        if (!defined("TEMPLATE_FILE")) {
            define("TEMPLATE_FILE", $this->configuration->mvc->view->template_file);
        }

        define("SITE", Router::getURL());
        define("SITE_ROOT", $this->configuration->getSitePath());
        define("TMP", $this->configuration->getTmpPath());
        define("LOG", $this->configuration->getLogPath());
    }

    /**
     * Get ação principal
     *
     * @param string $url
     *
     * @return AppAction
     */
    public function getAction($url)
    {
        $retorno = new AppAction();
        $retorno->url = $url;


        if (!isset($url)) {
            $controller = $this->contollerDefault;
            $action = $this->actionDefault;

            $retorno->controller = $controller;
            $retorno->controller_class = $controller . 'Controller';
            $retorno->action = $action;
            $retorno->params = array ();
            return $retorno;
        }


        $urlArray = explode("/", $url);
        $urlArray = array_values(array_filter($urlArray));

        if (count($urlArray) > 1) {

            $namespace = snakeToUpperCamel($urlArray[0]);
            $class = snakeToUpperCamel($urlArray[1]);
            $class_file = $class . 'Controller';

            $file_name = APP . DS . 'Controller' . DS . $namespace . DS . $class_file . '.php';

            if (file_exists($file_name)) {
                unset($urlArray[0], $urlArray[1]);
                $retorno->controller = $namespace . '\\' . $class;
                $retorno->controller_class = $retorno->controller . 'Controller';

                if (isset($urlArray[2])) {
                    $retorno->action = $urlArray[2];
                    unset($urlArray[2]);
                } else
                    $retorno->action = $this->actionDefault;
            } else {
                $class = $namespace;
                $action = $urlArray[1];
                unset($urlArray[0], $urlArray[1]);

                $retorno->controller = $class;
                $retorno->controller_class = $retorno->controller . 'Controller';
                $retorno->action = $action;
            }

            $retorno->params = array_values($urlArray);

            return $retorno;
        }

        $controller = snakeToUpperCamel($urlArray[0]);

        $retorno->controller = $controller;
        $retorno->controller_class = $controller . 'Controller';
        $retorno->action = $this->actionDefault;

        return $retorno;

    }

    /**
     * Remove a magic quotes
     */
    private function removeMagicQuotes()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = $this->stripSlashesDeep($_GET);
            $_POST = $this->stripSlashesDeep($_POST);
            $_COOKIE = $this->stripSlashesDeep($_COOKIE);
        }
    }

    /**
     * Check register globals and remove them *
     */
    private function unregisterGlobals()
    {
        if (ini_get('register_globals')) {
            $array = array ('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    /**
     * Returns the positions of installation of Framework
     * @return string
     */
    public function verifyInstallation()
    {
        return json_encode([
            "CONSTANTS" => [
                "SITE"      => SITE,
                "SITE_ROOT" => SITE_ROOT,
                "TMP"       => TMP,
                "LOG"       => LOG,
                "APP"       => APP,
                "TEMPLATE_PATH" => TEMPLATE_PATH,
                "TEMPLATE_FILE" => TEMPLATE_FILE
            ],
            "CONFIGURATION" => $this->configuration
        ]);
    }

    /**
     * Set display errors
     * @param bool $reporting
     */
    public static function setReporting($reporting = false)
    {
        if (!$reporting) {
            //error_reporting(E_ALL & ~E_STRICT);
            ini_set('error_reporting', E_ALL ^ E_NOTICE);
            ini_set('display_errors', 'On');
            ini_set('log_errors', 'On');
            ini_set('error_log', LOG . DS . 'error.log');
        } else {
            error_reporting(E_ALL & ~E_STRICT);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', LOG . DS . 'error.log');
        }
    }

    /**
     * include once a file
     * @param string $file Caminho do arquivo
     */
    public static function import($file)
    {
        @require_once $file;
    }

    /**
     * inclui controller
     *
     * @param string $controller
     *
     * @return bool
     */
    public static function loadController($controller)
    {
        $controller = str_replace("\\", DS, $controller);
        $file = APP . DS . 'Controller' . DS . $controller . '.php';
        if (file_exists($file)) {
            self::import($file);
            return true;
        }
        return false;
    }

    /**
     * inclui Model
     *
     * @param string $model
     *
     * @return bool
     */
    public static function loadModel($model)
    {
        $model = str_replace("\\", DS, $model);
        $file = APP . DS . 'Model' . DS . $model . '.php';;
        if (file_exists($file)) {
            self::import($file);
            return true;
        }
        return false;
    }

    /**
     * Inclui Component
     *
     * @param string $component
     *
     * @return bool
     */
    public static function loadComponent($component)
    {
        $className = ltrim($component, '\\');
        $fileName = '';

        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        $fileName = APP . DS . 'Component' . DS . $fileName;

        if (file_exists($fileName)) {
            self::import($fileName);
            return true;
        }
        return false;
    }

}

class AppAction
{
    /** @var string */
    public $controller = null;
    /** @var string */
    public $controller_class = null;
    /** @var string */
    public $action = null;
    /** @var array */
    public $params = array ();
    /** @var string */
    public $url = null;
}