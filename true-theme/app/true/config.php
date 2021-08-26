<?php

/*
|--------------------------------------------------------------------------
| Configuration Class
|--------------------------------------------------------------------------
| Allow access to global configuration,
| Also reading configuration file a'la Laravel
*/
class Config
{
	const THEME_NAME         = 'TRUE';
	const CONFIG_ROOT 		 = 'app/config/';

	protected static $cachedConfig = array();

	/**
	 * Default Page ID coming from True Base WP Installation
	 * e.g. Config::PAGE_HOME
	 */
	const PAGE_HOME			= 7;
	const PAGE_CONTACT 		= 11;

	static function env()
	{
		return $_SERVER['SERVER_NAME'];
	}

	/**
	 * Get the current environment based on $_SERVER
	 * 
	 * @return
	 */
	public static function isLocal() {
		$env = self::env();
		
		if (strpos($env, 'true.local')) {
			return true;
		}
		return false;
	}

	public static function isStaging() {
		$env = self::env();
		
		if (strpos($env, 'trueagency.com.au') ||
				strpos($env, 'trueserver.com.au')) {
			return true;
		}
		return false;
	}

	public static function isProduction() {
		return (!(self::isLocal() || self::isStaging()));
	}

	/**
	 * Return config value a'la Laravel
	 * Config::get('filename.key1.key2')
	 * @todo Based on environment!
	 * 
	 * @param  string $key Use dot (.) as depth separator
	 * @return [type]      [description]
	 */
	public static function get($key)
	{
		$basePath = self::CONFIG_ROOT;

		$requestedKeys = explode('.', $key);

		// Must be at 2 fragments '$filename.$key'
		if (count($requestedKeys) < 2) {
			return null;
		}

		// Determine if exists
		$filename = array_shift($requestedKeys);
		// Cached?
		if (isset(self::$cachedConfig[$filename])) {
			$configArr = self::$cachedConfig[$filename];
		} else { // require the file
			$locate = locate_template($basePath . $filename . '.php');
			if (empty($locate)) {
				return null;
			} else {
				$configArr = require $locate;
				if (!is_array($configArr)) {
					return null;
				}
			}
		}

		// We have our array from the file
		while (count($requestedKeys) > 0) {
			$keyFragment = array_shift($requestedKeys);
			if (isset($configArr[$keyFragment])) {
				$configArr = $configArr[$keyFragment];
			} else {
				return null;
			}
		}

		return $configArr;
	}
}