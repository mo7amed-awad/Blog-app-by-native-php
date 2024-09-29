<?php
$data=validation([
    'email'=>'required|email',
    'password'=>'required',
    'remember_me'=>''
],[
    'email'=>trans('main.email'),
    'password'=>trans('main.password'),
]);
$login = db_first('users', "WHERE email LIKE '%".$data['email']."%'");

if(empty($login) || (!hash_check($data['password'],$login['password']) || $login['user_type']=='admin'))
{
    session('error_login',trans('admin.login_failed'));
    redirect(ADMIN.'/login');
}else {
    session('admin',json_encode($login));
    redirect(ADMIN);
}
