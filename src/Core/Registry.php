<?php

namespace VTRMVC\Core;

/**
 * Registry Class
 * Stores anything
 */
class Registry
{
    /** @var array  $container Store Offsets */
    protected static $container = [];

    /**
     * @param array $container
     */
    public static function loadContainer(array $container)
    {
        foreach ($container as $k => $v) {
            if (!is_string($k)) {
                continue;
            }

            self::set($k, $v);
        }
    }
    
    /**
     * @view Registry::offsetGet
     */
    public static function get($offset)
    {
        return self::offsetGet($offset);
    }
    
    /**
     * @view Registry::offsetSet
     */
    public static function set($offset, $value)
    {
        return self::offsetSet($offset, $value);
    }
    
    /**
     * Offset Get
     * Return a offset if exists
     * @param str|int $offset
     * @return mixed
     */
    public static function offsetGet($offset)
    {
        if (self::offsetExists($offset))
            return self::$container[$offset];
            
        return null;
    }
    
    /**
     * Offset Set
     * Store a offset value
     * @param str|int $offset Offset name
     * @param mixed $value Offset value
     * @return void
     */
    public static function offsetSet($offset, $value)
    {
        self::$container[$offset] = $value;
    }
    
    /**
     * Offset Exsists
     * Verify if a offset exists
     * @param str|int $offset
     * @return bool
     */
    public static function offsetExists($offset)
    {
        return isset(self::$container[$offset]);
    }
    
    /**
     * Offset Unset
     * Remove a offset to storage
     * @param str|int $offset Offset name
     * @return void
     */
    public static function offsetUnset($offset)
    {
        if (self::offsetExists($offset))
            unset(self::$container[$offset]);
    }
}
