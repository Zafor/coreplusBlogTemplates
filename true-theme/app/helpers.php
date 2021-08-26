<?php

use Illuminate\Support\Arr;

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        if (strlen($value) > 1 && \Illuminate\Support\Str::startsWith($value, '"') && \Illuminate\Support\Str::endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('make_image')) {
    function make_image($img, $size = 'thumbnail', $classes = [], $attributes = [])
    {
        if (is_array($img)) {
            $img = Arr::get($img, 'ID');
        }
        $attributes = array_merge($attributes, [
            'class' => implode(' ', $classes)
        ]);
        $imgTag = wp_get_attachment_image($img, $size, false, $attributes);
        if (empty($imgTag) && is_string($img) && !empty($img)) {
            $htmlAttributes = str_replace('=', '="', http_build_query($attributes, null, '" ', PHP_QUERY_RFC3986)) . '"';
            $htmlAttributes = str_replace('%20', ' ', $htmlAttributes);
            $imgTag = sprintf('<img src="%s" %s>', $img, $htmlAttributes);
        }
        return $imgTag;
    }
}

if (! function_exists('asset_version')) {
    /**
     * Return asset version from manifest file
     *
     * @param string $path Override version manifest file path. If not supplied, default path will be used.
     *
     * @return string
     */
    function asset_version($path = null)
    {
        static $version = false;

        if ($version === false) {
            if (is_null($path)) {
                $path = get_template_directory() . '/assets/version.json';
            }

            if (!file_exists($path)) {
                $version = [];
            } else {
                $version = json_decode(file_get_contents($path), true);
            }
        }

        return isset($version['version'])
            ? $version['version']
            : '';
    }
}
