<?php

define('ADMIN','admin');
route_get(ADMIN,'admin.index');
route_get(ADMIN.'/lang','controllers.admin.set_language');


route_get(ADMIN.'/login','admin.login');
route_post(ADMIN.'/do/login','controllers.admin.login');

route_get(ADMIN.'/logout','controllers.admin.logout');

//categories
route_get(ADMIN.'/categories','admin.categories.index');
route_get(ADMIN.'/categories/create','admin.categories.create');          
route_post(ADMIN.'/categories/create','controllers.admin.categories.create');          
route_get(ADMIN.'/categories/show','admin.categories.show');          
route_get(ADMIN.'/categories/edit','admin.categories.edit');          
route_post(ADMIN.'/categories/edit','controllers.admin.categories.update');          
route_post(ADMIN.'/categories/delete','controllers.admin.categories.destroy');          

//news
route_get(ADMIN.'/news','admin.news.index');
route_get(ADMIN.'/news/create','admin.news.create');          
route_post(ADMIN.'/news/create','controllers.admin.news.create');          
route_get(ADMIN.'/news/show','admin.news.show');          
route_get(ADMIN.'/news/edit','admin.news.edit');          
route_post(ADMIN.'/news/edit','controllers.admin.news.update');          
route_post(ADMIN.'/news/delete','controllers.admin.news.destroy');



//users
route_get(ADMIN.'/users','admin.users.index');
route_get(ADMIN.'/users/create','admin.users.create');          
route_post(ADMIN.'/users/create','controllers.admin.users.create');          
route_get(ADMIN.'/users/show','admin.users.show');          
route_get(ADMIN.'/users/edit','admin.users.edit');          
route_post(ADMIN.'/users/edit','controllers.admin.users.update');          
route_post(ADMIN.'/users/delete','controllers.admin.users.destroy');




