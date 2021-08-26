<?php

/**
 *
 * A wrapper for using Validator class from Laravel (illuminate/validation)
 *
 * Usage:
 * $v = Validator::init();
 *
 * $v->make($data, $rules);
 *
 * @see http://laravel.com/docs/validation
 *
 * @author Jofry HS
 */

class Validator {

	public static function init() {

		$translator = new Symfony\Component\Translation\Translator('en');
		$factory = new Illuminate\Validation\Factory($translator);
		
		return $factory;
	}

}