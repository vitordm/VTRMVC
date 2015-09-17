<?php

/**
 * print_r and var_dump friendly
 * @param $arg
 */
function varz($arg)
{
    $args = func_get_args();
    foreach ($args as $v) {
        echo "<pre>";
        if (is_object($v) || is_array($v))
            print_r($v);
        else
            var_dump($v);
        echo "</pre>";
    }
}

/**
 * call varz function and exit
 * @param $arg
 */
function varzx($arg)
{
    $args = func_get_args();
    call_user_func_array('varz', $args);
    die();
}

/**
 * Trace methods
 */
function traceMethods() {
    $trace = debug_backtrace();
    $trace = array_reverse($trace);
    $trace = array_filter($trace, create_function('$value', 'if(preg_match("/(core|temas|index.php)/", $value["file"]))return FALSE;return true;'));
    foreach ($trace as $indice => $item) {
        echo "FILE: " . $item['file'] . '<br>';
        echo "CLASS: " . $item['class'] . '<br>';
        echo "FUNCTION: " . $item['function'] . '<br>';
        echo "LINE: " . $item['line'] . '<br>';
        echo "<hr>";
    }
}

/**
 * Convert a snake string to upper camel
 * @param $string
 * @return string
 */
function snakeToUpperCamel($string)
{
    $func = create_function('$c', 'return strtoupper($c[1]);');
    return ucfirst(preg_replace_callback('/_([a-z])/', $func, $string));
}