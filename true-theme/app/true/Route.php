<?php

 /* Router
 /* ------------------------------------------------------
  * Allow you to register a class which handles request
  * according to Laravel-ish convention.
  * Take a look at Route::registerClass() method on how to use
  * 
  *
  * @require URL
  */
class Route
{
    private static $classes = array();

    /**
     * Register a class to the Route
     * @param  string $className Class name to invoke
     * @param  string $url       Root URL which will invoke the controller
     * @param  array  $options   [
     *             'wildcard' => false|true 
     *                            // Will progressively match additional 
     *                            // url segments after each method
     *                            // e.g. /member/account/trueagency
     *                            // will still call MemberController@getAccount()
     *                            // despite additional segment(s) after account
     *                            // Note that when using this, add_rewrite_url might be needed.
     *                            // Example in AETM project
     *         ]
     * @return [type]            [description]
     */
    public static function registerClass(
        $className,
        $url,
        $options = []
    ) {
        // Add url and default options
        $routeClass = [
            'url'      => $url,
            'wildcard' => false
        ];

        // Set wildcard
        if (isset($options['wildcard'])) {
            $routeClass['wildcard'] = true;
        }

        self::$classes[$className] = $routeClass;
    }

    public static function printRoutes()
    {
        echo '<pre>';
        var_dump(self::$classes);
        echo '</pre>';
    }

    /**
     * Match all registered classes
     * and run if match is found
     * @return [type] [description]
     */
    public static function init()
    {
        $currentSegments = URL::segments();

        // No point if no segments
        if (count($currentSegments) <= 0) {
            return;
        }

        foreach (self::$classes as $className => $routeConfig) {
            $url = $routeConfig['url'];
            $urls = URL::cleanUpSegments($url);

            if (count($urls) > count($currentSegments)) {
                // Not it, continue
                continue;
            }

            $match = Route::matchURL($urls);

            if ($match) {
                if (Route::checkMethodExists($className)) {
                    Route::run($className);
                }
                else if (Route::checkIndex($url, $className)) {
                    Route::run($className, Route::resolveMethodName($className, true));
                }
            }
        }
    }

    /**
     * Match the url up to number of segments in $urls
     * @param  [type] $urls [description]
     * @return [type]       [description]
     */
    private static function matchURL($urls)
    {
        $match = true;
        $count = 0;
        foreach ($urls as $segment) {
            if ($segment != URL::segment($count)) {
                $match = false;
                break;
            }
            $count++;
        }

        return $match;
    }

    /**
     * Is the method exists according to our method name resolver
     * @param  [type] $className    [description]
     * @param  string $methodName   Optional - If not provided, will try to resolve
     *                             from current URL
     * @param  string $url          Optional - If provided try to resolve get/postIndex
     * @return [type]            [description]
     */
    private static function checkMethodExists($className, $methodName = null, $url = null)
    {
        if ($methodName) {
            return method_exists($className, $methodName);
        }
        else {
            return method_exists($className, self::resolveMethodName($className));
        }
    }

    public static function checkIndex($url, $className)
    {
        if (studly_case(URL::lastSegment()) == studly_case(URL::lastSegment($url))) {

            // It is index, but do we have the method?
            if (self::checkMethodExists($className, self::resolveMethodName($className, true))) {
                return true;
            }

            return false;
        }
        else {
            return false;
        }
    }

    /**
     * Return the method name which corresponds to the last segment
     * in current url
     * Following Laravel Route::controller() convention
     * i.e.
     * Current url: /member/account-login [POST]
     * Method to be invoked: Member::postAccountLogin
     * @return string Method name
     */
    private static function resolveMethodName($className, $isIndex = false) {
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if  ($isIndex) {
            return $method . 'Index';
        }

        // Check wildcard
        $wildCardRoute = self::isWildcard($className);
        if ($wildCardRoute !== false) {
            // Get the number of segments of this class url
            $urls = URL::cleanUpSegments($wildCardRoute['url']);
            $segment = URL::segment(count($urls));

            return $method . studly_case($segment);
        }
        return $method . studly_case(URL::lastSegment());
    }

    /**
     * Run the method
     * @param  string $className   The Class to run
     * @param  string $method      Optional - If not provided, will try to resolve
     *                             from current URL
     * @return [type]            [description]
     */
    public static function run($className, $method = null)
    {
        // Run before filter on class
        if (self::checkMethodExists($className, 'before')) {
            call_user_func_array(array($className, 'before'), array(self::resolveMethodName($className)));
        }

        // Add params, only works for wildcard
        $wildCardRoute = self::isWildcard($className);
        $params = [];
        if ($wildCardRoute !== false) {
            $params = self::extractWildCardParams($wildCardRoute['url']);
        }

        if ($method) {
            call_user_func_array(array($className, $method), $params);
        }
        else {
            call_user_func_array(array($className, self::resolveMethodName($className)), $params);
        }

        // Run after filter on class
        if (self::checkMethodExists('after')) {
            call_user_func_array(array($className, 'after'), $params);
        }
    }

    public static function isWildcard($className)
    {
        foreach (self::$classes as $class => $routeConfig) {
            if ($class === $className && $routeConfig['wildcard']) {
                return $routeConfig;
            }
        }
        return false;
    }

    public static function extractWildCardParams($url)
    {
        // Get the number of segments of this class url
        $ignoreCount = count(URL::cleanUpSegments($url)) + 1;

        $currentSegments = URL::segments();
        return array_slice($currentSegments, $ignoreCount);
    }
}
        
// The action to be called when using Route
add_action('wp_loaded', array('Route', 'init'));