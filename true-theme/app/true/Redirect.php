<?php

 /* Redirect
 /* ------------------------------------------------------
  * Wrapper around wp_redirect for laravel-ish way
  */
class Redirect
{
    /**
     * Redirect to URL (relative to site_url())
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    public static function to($url)
    {
        wp_redirect(URL::to($url));
        die;
    }
}