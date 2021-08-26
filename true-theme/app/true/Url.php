<?php

 /* URL
 /* ------------------------------------------------------
  * Common library for URL manipulation
  */
class URL
{
    /**
     * Return URL segment at specified index
     * WIll return NULL if total segment size is less than the $count
     * @param  [type] $count [description]
     * @return [type]        [description]
     */
    public static function segment($count)
    {
        $segments = self::segments();

        if (count($segments) < $count + 1) {
            return '';
        }

        return count($segments) >= $count ? $segments[$count] : null;
    }

    /**
     * Retrieve all segments in current url
     * @return [type] [description]
     */
    public static function segments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return self::cleanUpSegments($uri);
    }

    public static function cleanUpSegments($uri)
    {
        $segments = explode('/', $uri);

        $count = count($segments);

        if ($count <= 0) {
            return array();
        }


        // Removing trailing empty string first and last
        if (empty($segments[0])) {
            array_shift($segments);
        }

        // Update our count!
        $count = count($segments);

        if (empty($segments[$count-1])) {
            array_pop($segments);
        }

        return $segments;
    }

    /**
     * Return the value of last segment
     * Useful in Route when last segment is usually 
     * the action/method name
     * @return [type] [description]
     */
    public static function lastSegment($url = null)
    {
        if (!$url) {
            $segments = self::segments();
        }
        else {
            $segments = self::cleanUpSegments($url);
        }
        $count = count($segments);

        if ($count > 0) {
            return $segments[$count-1];
        }
        else {
            return null;
        }
    }

    /**
     * Generate url
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    public static function to($url)
    {
        $url = $url == '/' ? '' : $url;

        return site_url() . '/' . $url;
    }
}