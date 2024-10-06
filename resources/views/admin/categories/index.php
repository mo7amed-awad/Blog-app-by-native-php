<?php 
view('admin.layouts.header',['title'=>trans('admin.categories')]);
$categories=db_paginate('categories','',3);

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{trans('admin.categories')}}</h2>
        <a class="btn btn-primary" href="{{aurl('categories/create')}}"> <i class="fa-solid fa-plus"> </i>{{trans('categories.create')}} </a>

    </div>
    <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{trans('categories.name')}}</th>
                        <th scope="col">{{trans('categories.icone')}}</th>
                        <th scope="col">{{trans('categories.description')}}</th>
                        <th scope="col">{{trans('admin.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($category = mysqli_fetch_assoc($categories['query'])):?>
                    <tr>
                        <td>{{$category['id']}}</td>
                        <td>{{$category['name']}}</td>
                        <td>
                        {{image(storage_url($category['icone']))}}
                        </td>
                        <td>{{$category['description']}}</td>
                        <td>
                            <a href="{{aurl('categories/show?id='.$category['id'])}}"><i class="fa-regular fa-eye"></i></a>
                            <a href="{{aurl('categories/edit?id='.$category['id'])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                            {{ delete_record(aurl('categories/delete?id='.$category['id'])) }}
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        {{$categories['render']}}
</main>
<?php view('admin.layouts.footer'); ?>