<?php

namespace VTRMVC\Configuration;

use VTRMVC\Core\Exceptions\InvalidConfigurationException;
use VTRMVC\Core\IApp\TAppIterator;
use VTRMVC\Util\Util;

class AppSettings extends TAppIterator
{

    const APP_ENVIRONMENT_ONLINE = "online";
    const APP_ENVIRONMENT_PRODUCTION = "production";
    const APP_ENVIRONMENT_AMAZON = "amazon";
    const APP_ENVIRONMENT_DEV = "dev";
    const APP_ENVIRONMENT_OFFLINE = "offline";
    const APP_ENVIRONMENT_SANDBOX = "sandbox";

    /** @var  TAppIterator */
    public $mvc;
    /** @var  TAppIterator */
    public $route;


    public function __construct(array $configuration)
    {
        parent::__construct([]);
        $this->loadSettings($configuration);
    }

    /**
     * @param array $configuration
     * @throws InvalidConfigurationException
     */
    public function loadSettings(array $configuration)
    {
        $keys_default = array(
            "mvc", "site_path", "tmp_path", "log_path"
        );

        if (!Util::checkIfKeysExists($configuration, $keys_default)) {
            throw new InvalidConfigurationException("Invalid configuration");
        }

        unset($keys_default);

        $route = isset($configuration['route']) ? $configuration['route'] : [];
        $mvc   = $configuration['mvc'];

        unset($configuration['route'], $configuration['mvc']);

        $this->container = $configuration;

        $this->loadMVCSettings($mvc);
        $this->loadRouteSettings($route);

        $this->setSitePath($this->container["site_path"]);
        $this->setTmpPath($this->container["tmp_path"]);
        $this->setLogPath($this->container["log_path"]);

    }

    /**
     * @param array $mvc
     * @throws InvalidConfigurationException
     */
    public function loadMVCSettings($mvc)
    {
        $views = isset($mvc['view']) ? $mvc['view'] : [];

        unset($mvc["view"]);

        if (!isset($mvc["path"])) {
            throw new InvalidConfigurationException("MVC Path was not configurated");
        }

        $this->mvc = new TAppIterator($mvc);

        $this->setMVCPath($mvc['path']);

        $this->mvc->view = new TAppIterator($views);

        if ($this->mvc->view->offsetExists("template_folder")) {
            $this->mvc->view->template_folder = $this->getRealPath($this->mvc->view->template_folder);
        }
    }

    /**
     * @param $route
     */
    public function loadRouteSettings($route)
    {
        $this->route = new TAppIterator($route);
    }

    /**
     * @param string $path
     */
    public function setSitePath($path)
    {
        $this->site_path = $this->getRealPath($path);

    }

    /**
     * @return string|null
     */
    public function getSitePath()
    {
        return $this->site_path;
    }

    /**
     * @param string $path
     */
    public function setTmpPath($path)
    {
        $this->tmp_path = $this->getRealPath($path);

    }

    /**
     * @return string|null
     */
    public function getTmpPath()
    {
        return $this->tmp_path;
    }

    /**
     * @param string $path
     */
    public function setLogPath($path)
    {
        $this->log_path = $this->getRealPath($path);

    }

    /**
     * @return string|null
     */
    public function getLogPath()
    {
        return $this->log_path;
    }

    /**
     * @param string $path
     */
    public function setMVCPath($path)
    {

        $this->mvc->path = $this->getRealPath($path);
    }

    /**
     * @return string
     */
    public function getMVCPath()
    {
        return $this->mvc->path;
    }

    /**
     * @param string $controller
     */
    public function setMVCControllerDefault($controller)
    {
        $this->mvc->controller_default = $controller;
    }

    /**
     * @return string
     */
    public function getMVCControllerDefault()
    {
        return $this->mvc->controller_default;
    }

    /**
     * @param string $action
     */
    public function setMVCActionDefault($action)
    {
        $this->mvc->action_default = $action;
    }

    /**
     * @return string
     */
    public function getMVCActionDefault()
    {
        return $this->mvc->action_default;

    }

    /**
     * @param string $suffix
     */
    public function setMVCSuffixAction($suffix)
    {
        $this->mvc->suffix_action = $suffix;
    }

    /**
     * @return string
     */
    public function getMVCSuffixAction()
    {
        return $this->mvc->suffix_action;
    }

    public function getMVCTemplate()
    {
        $path = $this->mvc->view->template_folder;

        if ($path) {
            if ($this->mvc->view->template_file) {
                $path .= DS . $this->mvc->view->template_file;
                return $path;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function useMVCAppController()
    {
        if ($this->mvc->app_controller)
            return $this->mvc->app_controller;
        return false;
    }

    /**
     * @return bool
     */
    public function useMVCAppModel()
    {
        if ($this->mvc->app_model)
            return $this->mvc->app_model;
        return false;
    }

    /**
     * Get the environment defined in configuration file
     * @return bool|null
     */
    public function getEnvironment()
    {
        if ($this->offsetExists('environment')) {

            switch ($this->environment) {
                case self::APP_ENVIRONMENT_ONLINE:
                case self::APP_ENVIRONMENT_PRODUCTION:
                case self::APP_ENVIRONMENT_AMAZON :
                    return true;
                case self::APP_ENVIRONMENT_DEV:
                case self::APP_ENVIRONMENT_OFFLINE:
                case self::APP_ENVIRONMENT_SANDBOX:
                    return false;
                    break;
                default:
                    return false;

            }

        }

        return null;
    }

    /**
     * @param $route
     * @return mixed|null
     */
    public function getRoute($route)
    {
        if ($this->route->offsetExists($route)) {
            return $this->route->offsetGet($route);
        }

        return null;


    }

    /**
     * @param string $path
     * @return string
     */
    private function getRealPath($path)
    {
        $path = empty($path) ? "." : $path;
        return realpath($path);
    }

}