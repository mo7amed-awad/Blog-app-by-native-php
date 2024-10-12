<?php
$user = db_find('users', request('id'));
view('admin.layouts.header', ['title' => trans('admin.users').'--'.$user['name']]);
// if(empty($user)){
//     redirect(aurl('users'));
// }
redirect_if(empty($user),aurl('users'));
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>{{trans('admin.users')}} / {{$user['name']}}</h3>
        <a class="btn btn-primary" href="{{aurl('users')}}">{{trans('admin.users')}}</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{trans('users.name')}} : </label>
                {{$user['name']}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="email">{{trans('users.email')}} : </label>
                {{$user['email']}}

            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="mobile">{{trans('users.mobile')}} : </label>
                {{$user['mobile']}}

            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="user_type">{{trans('users.user_type')}} : </label>
                    {{trans('users.'.$user['user_type'])}}
            </div>
        </div>
    </div>

</main>
<?php view('admin.layouts.footer'); ?>