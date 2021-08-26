<?php

 /* Sample Controller
 /* ------------------------------------------------------
  * A sample controller to demonstrate controller usage
  *
  */
    class SampleController
    {

        public static function init()
        {
            /**
             * Registering Route which should be handled by this controller 
             */
            Route::registerClass(__CLASS__, 'sample');
        }

        /**
         * Special hook, for each match found in this class
         * Executed BEFORE the actual method
         * Similar to Laravel before filter
         */
        public static function before($action)
        {
            // Do nothing, but can be used for checking 
            // e.g. if has to be logged in            
        }

        /**
         * Special hook each time a match is found in this class
         * Executed AFTER the actual method
         */
        public static function after()
        {
            // Do nothing
        }

        /**
         * Default route 
         * GET /sample/ or GET /sample/index/
         */
        public static function getIndex()
        {
            echo 'SampleController@getIndex';
            die;
        }

        /**
         * Greets the world
         * GET /sample/hello-world
         */
        public static function getHelloWorld()
        {
            echo 'SampleController@getHelloWorld';
            die;
        }

    }
    // Register this controller
    SampleController::init();