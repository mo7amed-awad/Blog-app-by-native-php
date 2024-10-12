<?php
$data=validation([
    'name'=>'required|string',
    'email'=>'required|email|unique:users',
    'password'=>'required|string',
    'mobile'=>'required|unique:users',
    'user_type'=>'required|string',
],[
    'name'=>trans('users.name'),
    'email'=>trans('users.email'),
    'password'=>trans('users.password'),
    'mobile'=>trans('users.mobile'),
    'user_type'=>trans('users.user_type'),

]);

$data['password']=bcrypt($data['password']);

db_create('users',$data);

redirect(aurl('users'));