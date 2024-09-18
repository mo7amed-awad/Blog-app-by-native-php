<?php

if(!function_exists('view'))
{
    function view(string $path,$vars=null)
    {
        //style.layouts.header.php
        // $full_path='';
        // $current_paths=explode('.',$path);
        // foreach($current_paths as $current)
        // {
        //     $full_path.='/'.$current;
        // }
        // return $full_path.'.php';
        $file=config('view.path').str_replace(['.','/'],DIRECTORY_SEPARATOR,$path).".php";
        if(file_exists($file))
        {
            if(!is_null($vars)&& is_array($vars)){
            foreach($vars as $key=>$value)
            {
                ${$key}=$value;
            }}
             include $file;
        }else
        {
            include config('view.path').'404.php';
        }
        return null;
    }
}
