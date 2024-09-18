<?php

if (!function_exists('trans')) {
    function trans(string $path = null, string $default = null): string
    {
        $trans = explode('.', $path);
        if (session_has('locale')) {
            $default = session('locale');
        } else {
            // $default=@config('lang.default')??config('lang.fallback');
            //$default=!empty(config('lang.default'))?config('lang.default'):config('lang.fallback');
            $default = @config('lang.default') ? config('lang.default') : config('lang.fallback');
        }
        $file=(config('lang.path') . $default . DIRECTORY_SEPARATOR . $trans[0] . ".php");
        if (file_exists($file)&&count($trans) > 0) {
            $result = include $file;
            return isset($result[$trans[1]])?$result[$trans[1]]:$path;
        }
        return '';
    }
}

if (!function_exists('set_locale')) {
    function set_locale(string $lang = null)
    {
        session('locale', $lang);
    }
}

