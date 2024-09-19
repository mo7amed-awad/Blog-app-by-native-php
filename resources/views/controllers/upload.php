<?php
//store_file(request('image'),'test/test/file.png]]');

$data=validation([
    'email'=>'required|email',
    'mobile'=>'required|integer',
    'name'=>'string|required'
],[
    'email'=>trans('main.email'),
    'mobile'=>trans('main.mobile'),
    'name'=>trans('main.name'),
],);

var_dump($data);
