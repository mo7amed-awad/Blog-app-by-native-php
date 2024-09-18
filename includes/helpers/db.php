<?php 

if(!function_exists('db_create'))
{
    function db_create($table,array $data):array{
        $sql="INSERT INTO ".$table;
        $columns='';
        $values='';
        foreach ($data as $key=>$value)
        {
            $columns.=$key.",";
            $values.=" '".$value."',";
        }
        $columns=rtrim($columns,",");
        $values=rtrim($values,",");
        $sql.=" (".$columns.") VALUE (".$values.")";
        $query=mysqli_query($GLOBALS['connect'],$sql);
        $id=mysqli_insert_id($GLOBALS['connect']);
        $rowinfo=mysqli_query($GLOBALS['connect'],"SELECT * FROM ".$table." WHERE id=".$id);
        $GLOBALS['query']=$rowinfo;
        return mysqli_fetch_assoc($rowinfo);
    }
}



if(!function_exists('db_update'))
{
    function db_update(string $table,array $data,int $id):array{
        $sql="UPDATE ".$table." SET ";
        $column_value='';
        foreach ($data as $key=>$value)
        {
            $column_value.=$key."='".$value."',";
        }
        $column_value=rtrim($column_value,",");
        $sql.=$column_value." where id=".$id;
        mysqli_query($GLOBALS['connect'],$sql);
        $rowinfo=mysqli_query($GLOBALS['connect'],"SELECT * FROM ".$table." WHERE id=".$id);
        $GLOBALS['query']=$rowinfo;
        return mysqli_fetch_assoc($rowinfo);
    }
}



if(!function_exists('db_delete'))
{
    function db_delete(string $table,int $id):mixed{
        $query=mysqli_query($GLOBALS['connect'],"DELETE FROM ".$table." WHERE id=".$id);
        $GLOBALS['query']=$query;
        return $query;
    }
}


if(!function_exists('db_find'))
{
    function db_find(string $table,int $id):mixed{
        $query=mysqli_query($GLOBALS['connect'],"SELECT * FROM ".$table." WHERE id=".$id);
        $GLOBALS['query']=$query;
        return mysqli_fetch_assoc($query);
    }
}


if(!function_exists('db_first'))
{
    function db_first(string $table,string $query_str):mixed{
        $query=mysqli_query($GLOBALS['connect'],"SELECT * FROM ".$table." ".$query_str);
        //var_dump(mysqli_num_rows($query)); //=6
        $GLOBALS['query']=$query;
        return mysqli_fetch_assoc($query);//return the first value only
    }
}


if(!function_exists('db_get'))
{
    function db_get(string $table,string $query_str):mixed{
        $query=mysqli_query($GLOBALS['connect'],"SELECT * FROM ".$table." ".$query_str);
        $num=mysqli_num_rows($query);
        $GLOBALS['query']=$query;
        return [
            'query'=>$query,
            'num'=>$num
        ];
    }
}


if(!function_exists('render_paginate'))
{
    function render_paginate(int $total_pages):string
    {
        $html='<ul>';
        for ($i=1 ; $i<=$total_pages;$i++)
        {
            $html.= '<li> <a href="?page='.$i.'">'.$i.'</a></li>';
        }
        $html.='</ul>';
        return $html;
    }
}
if(!function_exists('db_paginate'))
{
    function db_paginate(string $table,string $query_str,int $limit=15 ,$orderby='asc'):array{

        if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0)
        {
            $current_page=$_GET['page']-1;
        }else{
            $current_page=0;
        }

        $query_count=mysqli_query($GLOBALS['connect'],"SELECT COUNT(id) FROM ".$table." ".$query_str);
        $count=mysqli_fetch_row($query_count);
        $total_records=$count[0];

        $start=$current_page*$limit;
        $total_pages=ceil($total_records/$limit);

        if($current_page>=$total_pages)
        {
            $start=$total_pages+1;
        }

        $query=mysqli_query($GLOBALS['connect'],"SELECT * FROM ".$table." ".$query_str . " order by id ".$orderby." LIMIT {$start},{$limit}");
        $num=mysqli_num_rows($query);
        $GLOBALS['query']=$query;
        return [
            'query'=>$query,
            'num'=>$num,
            'render'=>render_paginate($total_pages),
            'current_page'=>$current_page,
            'limit'=>$limit
        ];
    }
}



// $data= db_create('users',[
//     'name'=>'phpanonymous',
//     'password'=>'12345',
//     'email'=>'php5@php.net'
// ]);
// echo"<pre>";
// var_dump($data);
// echo"</pre>";

// $data= db_update('users',[
//     'name'=>'phpanonymous',
//     'password'=>'12345',
//     'email'=>'mohamedawad@we'
// ],12);
// echo"<pre>";
// var_dump($data);
// echo"</pre>";

//var_dump(db_delete('users',1));

// echo"<pre>";
// var_dump(db_find('users',12));
// echo"</pre>";

// echo"<pre>";
// var_dump(db_first('users',"where name = 'phpanonymous'"));
// echo"</pre>";



// $users=db_get('users',"");
// if($users['num']>0)
// {
//     while($row=mysqli_fetch_assoc($users['query']))
//     {
//         echo $row['email']."<br>";
//     }
// }



// $users=db_paginate('users','',1);
// while($row=mysqli_fetch_assoc($users['query']))
// {
//     echo $row['email'];
// }
// echo $users['render'];

