<?php
$data=validation([
    'name'=>'required|string',
    'email'=>'required|email|unique:users,email,'.request('id'),
    'password'=>'',
    'mobile'=>'required|unique:users,mobile,'.request('id'),
    'user_type'=>'required|string',
],[
    'name'=>trans('users.name'),
    'email'=>trans('users.email'),
    'password'=>trans('users.password'),
    'mobile'=>trans('users.mobile'),
    'user_type'=>trans('users.user_type'),

]);

if (!empty($data['password'])) {
    $data['password']=bcrypt($data['password']);

} else {
    unset($data['password']);
}
db_update('users', $data, request('id'));
redirect(aurl('users'));
