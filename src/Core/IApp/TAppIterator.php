<?php

namespace VTRMVC\Core\IApp;


class TAppIterator implements \ArrayAccess
{
    protected $container = [];

    public function __construct($container = [])
    {
        $this->container = $container;
    }

    public function __get($name)
    {
        if ($this->offsetExists($name))
            return $this->offsetGet($name);
        return false;
    }

    public function __set($name, $val)
    {
        $this->offsetSet($name, $val);
        return true;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset))
        {
            $this->container[] = $value;
        }
        else
        {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset))
            unset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset))
            return $this->container[$offset];
        return null;
    }

} 