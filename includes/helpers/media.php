<?php
if(!function_exists('image')){
    function image($url){
        view('admin.actions.view_image',['image'=>$url]);
    }
}