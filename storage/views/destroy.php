<?php
$category = db_find('categories', request('id'));
redirect_if(empty($category), aurl('categories'));
if (!empty($category['icone'])) {
    delete_file($category['icone']);
}

db_delete('categories', request('id'));

redirect(aurl('categories'));
