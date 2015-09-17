<?php

namespace VTRMVC\Util;

class Util
{
    /**
     * Pretty Print Run Kill
     * @param mixed
     */
    public static function printrx()
    {
        $arguments = func_get_args();
        call_user_func(array('self', 'printr'), $arguments);
        die;
    }
    
    public static function printr()
    {
        $arguments = func_get_args();
        
        if (!$arguments)
            return null;
        
        foreach ($arguments as $argument) {
            echo "<pre>";
            print_r($argument);
            echo "</pre>";
        }
    }
    
    public static function varz()
    {
        
        $arguments = func_get_args();
        foreach ($arguments as $argument)
        {
            echo "<pre>";
            if(is_object($argument) || is_array($argument))
                print_r($argument);
            else
                var_dump ($argument);
            echo "</pre>";
        }
    }
    
    /**
     * Chama a função varz e moore;
     */
    public static function varzx()
    {
        $args = func_get_args();
        call_user_func_array(array('self', 'varz'), $args);
        die;
    }

	public static function tree($rows)
	{
		return self::tree_build_menu($rows);
	}

	/**
	 * @param array $rows
	 * @param int|string $id
	 *
	 * @return bool
	 */
	public static function tree_has_children($rows, $id)
	{
		foreach ($rows as $row) {
			if ($row['parent_id'] == $id)
				return true;
		}
		return false;
	}

	/**
	 * @param array $rows
	 * @param int   $parent
	 *
	 * @return array
	 */
	public static function tree_build_menu($rows, $parent = 0)
	{
		$result = array();
		foreach ($rows as $row) {
			$row_id = $row['id'];
			$row_parent = $row['parent_id'];

			if ($row_parent == $parent) {
				$result[$row_id] = $row;

				if (self::tree_has_children($rows, $row_id))
					$result[$row_id]['children'] = self::tree_build_menu($rows, $row_id);
				else
					$result[$row_id]['children'] = array();
			}
		}

		return $result;
	}

    /**
     * @param array $mainArray
     * @param array $keys
     * @return bool
     */
    public static function checkIfKeysExists(array $mainArray, array $keys)
    {
        $keys_in = array_keys($mainArray);

        $not_in = array();
        foreach ($keys as $k) {
            if (!in_array($k, $keys_in))
                $not_in[] = $k;
        }

        return !$not_in;

    }

}