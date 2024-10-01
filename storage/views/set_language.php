<?php
if(in_array(request('lang'),['ar','en']))
{
    set_locale(request('lang'));
}

// $path=str_replace("http://php-anonymous/public",'',$_SERVER["HTTP_REFERER"]);

// redirect($path);
back();