<?php
$data=validation([
    'name'=>'required|string',
    'icone'=>'required|image',
    'description'=>''
],[
    'name'=>trans('categories.name'),
    'icone'=>trans('categories.icone'),
    'description'=>trans('categories.description'),
]);


$file_info=file_ext($data['icone']);
$data['icone']=store_file($data['icone'],'categories/'.$file_info['hash_name']);
db_create('categories',$data);

redirect(aurl('categories'));