<?php

 /* Request
 /* ------------------------------------------------------
  * Just a wrapper around \Illuminate\Http\Request
  * Make sure it has been required in composer
  */
class Request
{
	/**
	 * Actual request object, should mimic Laravel Input:: (or Request:: in general)
	 */
	private static $req = null;

    public static function make()
    {
        // Ensure $_FILES array is clean.
        foreach($_FILES as $i => $file) {
            if(!file_exists($file['tmp_name'])) {
                unset($_FILES[$i]);
            }
        }
    	self::$req = \Illuminate\Http\Request::createFromGlobals();
        return self::$req;
    }

    public static function get($key)
    {
    	if (!self::$req) {
    		self::make();
    	}
    	return self::$req->get($key);
    }

    public static function all()
    {
    	if (!self::$req) {
    		self::make();
    	}
    	return self::$req->all();
    }

    public static function has($key)
    {
    	if (!self::$req) {
    		self::make();
    	}
    	return self::$req->has($key);
    }

    public static function only()
    {
    	if (!self::$req) {
    		self::make();
    	}
    	$args = func_get_args();
    	return self::$req->only($args);
    }

    public static function except()
    {
    	if (!self::$req) {
    		self::make();
    	}
    	$args = func_get_args();
    	return self::$req->except($args);
    }

    /*
    |--------------------------------------------------------------------------
    | Also wraps around wordpress query vars
    |--------------------------------------------------------------------------
    */

    /**
     * Check if the query var is currently set
     */
    public static function hasVar($type, $var)
    {
        $vars = self::vars();

        if (isset($vars[$type])) {
            if (strpos($vars[$type], $var) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * [vars description]
     * @return [type] [description]
     */
    public static function vars()
    {
        global $wp_query;
        return $wp_query->query_vars;
    }
}