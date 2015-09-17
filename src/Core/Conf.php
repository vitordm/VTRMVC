<?php
namespace VTRMVC\Core;
/**
 * @author Vítor G. I. Oliveira <oliveira.vitor3@gmail.com>
 */
class Conf extends Registry
{
    /**
     * read some configure
     * @param string $conf
     * @param mixed $default_return
     * @return mixed
     */
    public static function get($conf, $default_return = null)
    {
        if (self::offsetExists($conf))
            return self::$container[$conf];

        return $default_return;
    }
    
    /**
     * read some configure
     * @param string $conf
     * @return mixed
     */
    public static function r($conf)
    {
        return self::get($conf);
    }
    
    /**
     * write some configure
     * @param string $conf
     * @param mixed $val
     * @return bool
     */
    public static function w($conf, $val)
    {
       return self::set($conf, $val); 
    }

}