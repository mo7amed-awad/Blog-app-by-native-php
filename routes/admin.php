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
route_post(ADMIN.'/categories/edit','controllers.admin.categories.edit');          