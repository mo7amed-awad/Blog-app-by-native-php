<?php
require_once __DIR__."/../includes/app.php";

//symlink(base_path('storage/files'), public_path('storage'));
route_init();
//delete_file('storage/test/test/file.png');
//remove_folder('storage/test');
if(!empty($GLOBALS['query']))
{
    mysqli_free_result($GLOBALS['query']);
}


mysqli_close($GLOBALS['connect']);
ob_end_flush();

