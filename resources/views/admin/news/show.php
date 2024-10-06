<?php
$category = db_find('categories', request('id'));
view('admin.layouts.header', ['title' => trans('admin.categories').'--'.$category['name']]);
// if(empty($category)){
//     redirect(aurl('categories'));
// }
redirect_if(empty($category),aurl('categories'));
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>{{trans('admin.categories')}} / {{$category['name']}}</h3>
        <a class="btn btn-primary" href="{{aurl('categories')}}">{{trans('admin.categories')}}</a>
    </div>
    <input type="hidden" name="_method" value="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{trans('categories.name')}} : </label>
                {{$category['name']}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{trans('categories.icone')}} : </label>
                {{image(storage_url($category['icone']))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{trans('categories.description')}} : </label>
                {{$category['description']}}

            </div>
        </div>
    </div>

</main>
<?php view('admin.layouts.footer'); ?>