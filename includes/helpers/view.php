<?php

if(!function_exists('view'))
{
    function view(string $path,$vars=null)
    {
        //style.layouts.header.php
        // $full_path='';
        // $current_paths=explode('.',$path);
        // foreach($current_paths as $current)
        // {
        //     $full_path.='/'.$current;
        // }
        // return $full_path.'.php';
        $file=config('view.path').str_replace(['.','/'],DIRECTORY_SEPARATOR,$path).".php";
        if(file_exists($file))
        {
             $view=$file;
        }else
        {
            $veiw = config('view.path').'404.php';
        }
        view_engine($view,$vars);
    }
}

if(!function_exists('view_engine'))
{
    function view_engine(string $view,$vars=null)
    {
        if(!is_null($vars)&& is_array($vars)){
            foreach($vars as $key=>$value)
            {
                ${$key}=$value;
            }}
            $file_path=explode('\\',$view);
        $file_name=end($file_path);
        $save_to_storage=base_path('storage/views/'.$file_name);

        $file=file_get_contents($view);

        $file=str_replace('{{','<?php echo ',$file);
        $file=str_replace('}}','; ?>',$file);
        $file=str_replace('@php','<?php ',$file);
        $file=str_replace('@endphp',' ?>',$file);

        $file=preg_replace("/@if\((.*?)\)+/i","<?php if($1)): ?>",$file);
        $file=preg_replace("/@elseif\((.*?)\)+/i","<?php elseif($1)): ?>",$file);
        $file=preg_replace("/@else/i","<?php else: ?>",$file);
        $file=preg_replace("/@endif/i","<?php endif; ?>",$file);
        $file=preg_replace("/@foreach\((.*?) as (.*?)\)+/i","<?php foreach($1 as $2): ?>",$file);
        $file=preg_replace("/@endforeach/i","<?php endforeach; ?>",$file);
        
        //$no=str_replace('resources\views\\','storage/views/',$view);
        //var_dump($no);
        
        file_put_contents($save_to_storage,$file);
        include $save_to_storage;
    }
}
