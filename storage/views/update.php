<?php
$data = validation([
    'name' => 'required|string',
    'icone' => 'image',
    'description' => 'required'
], [
    'name' => trans('categories.name'),
    'icone' => trans('categories.icone'),
    'description' => trans('categories.description'),
]);

if (!empty($data['icone']['tmp_name'])) {

    $category = db_find('categories', request('id'));
    redirect_if(empty($category), aurl('categories'));
    delete_file($category['icone']);
    
    $file_info = file_ext($data['icone']);
    $data['icone'] = store_file($data['icone'], 'categories/' . $file_info['hash_name']);
} else {
    unset($data['icone']);
}
db_update('categories', $data, request('id'));
redirect(aurl('categories'));
