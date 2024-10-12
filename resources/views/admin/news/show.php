<?php
$news = db_first('news', "
JOIN categories on news.category_id=categories.id
JOIN users on news.user_id = users.id
where news.id=" . request('id'), "
news.title,
news.content,
news.category_id,
news.user_id,
news.image,
news.description,
news.id,
users.name as username,
categories.name as category_name");

view('admin.layouts.header', ['title' => trans('admin.news') . '--' . $news['title']]);
// if(empty($news)){
//     redirect(aurl('news'));
// }
redirect_if(empty($news), aurl('news'));
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>{{trans('admin.news')}} / {{$news['title']}}</h3>
        <a class="btn btn-primary" href="{{aurl('news')}}">{{trans('admin.news')}}</a>
    </div>
    <input type="hidden" name="_method" value="post">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">{{trans('news.title')}} : </label>
                {{$news['title']}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="category_id">{{trans('news.category_id')}} : </label>
                <a href="{{aurl('categories/show?id='.$news['category_id'])}}">{{$news['category_name']}}</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="user_id">{{trans('news.user_id')}} : </label>
                <a href="{{aurl('users/show?id='.$news['user_id'])}}">{{$news['username']}}</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">{{trans('news.image')}} : </label>
                {{image(storage_url($news['image']))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{trans('news.description')}} : </label>
                {{$news['description']}}

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="content">{{trans('news.content')}} : </label>
                {{$news['content']}}

            </div>
        </div>
    </div>

</main>
<?php view('admin.layouts.footer'); ?>