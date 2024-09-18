<?php

$GET_ROUTES=isset($routes['GET'])?$routes['GET']:[];

if(!isset($_POST['_method'])&&(segment())!='/' && !in_array(segment(),array_column($GET_ROUTES,'segment')))
    {
        $storage_segment=str_replace('/public/','',segment());

        if(preg_match("/^storage/i",$storage_segment))
        {
            storage($storage_segment);
        }else{
        view('404');
        exit();
            }
    }

