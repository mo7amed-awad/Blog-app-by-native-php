<?php
$user = db_find('users', request('id'));
view('admin.layouts.header', ['title' => trans('admin.users') . '--' . $user['name']]);
// if(empty($user)){
//     redirect(aurl('users'));
// }
redirect_if(empty($user), aurl('users'));
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>{{trans('admin.users')}} / {{trans('admin.edit')}}</h3>
        <a class="btn btn-primary" href="{{aurl('users')}}">{{trans('admin.users')}}</a>
    </div>
    @if( all_errors())
    <div class="alert alert-danger">
        <ol>
            @foreach(all_errors() as $error)
            <li><?php echo $error ?></li>
            @endforeach
        </ol>

    </div>
    @endif

    @php
    $name_errors=get_errors('name');
    $email_errors=get_errors('email');
    $password_errors=get_errors('password');
    $mobile_errors=get_errors('mobile');
    $user_type_errors=get_errors('user_type');
    end_errors();
    @endphp
    <form method="post" action="{{aurl('users/edit?id='.$user['id'])}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{trans('users.name')}}</label>
                    <input type="text" name="name" value="{{ !empty(old('name')) ? old('name') : $user['name'] }}"
                        class="form-control {{ !empty($name_errors) ? 'is-invalid' : '' }}">
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">{{trans('users.email')}}</label>
                    <input type="email" name="email" value="{{ !empty(old('email')) ? old('email') : $user['email'] }}"
                        class="form-control {{ !empty($email_errors) ? 'is-invalid' : '' }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">{{trans('users.password')}}</label>
                    <input type="password" name="password"
                        class="form-control {{ !empty($password_errors) ? 'is-invalid' : '' }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile">{{trans('users.mobile')}}</label>
                    <input type="text" name="mobile" value="{{ !empty(old('mobile')) ? old('mobile') : $user['mobile'] }}"
                        class="form-control {{ !empty($mobile_errors) ? 'is-invalid' : '' }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_type">{{trans('users.user_type')}}</label>
                    <select class="form-select {{ !empty($user_type_errors) ? 'is-invalid' : '' }}" name="user_type">
                        <option value="user" {{$user['user_type'] == 'user'?'select':''}}>{{trans('users.user')}}</option>
                        <option value="admin" {{$user['user_type'] == 'admin'?'select':''}}>{{trans('users.admin')}}</option>
                    </select>
                </div>
            </div>

        </div>
        <input type="submit" class="btn btn-success" value="{{trans('admin.edit')}}">
    </form>
</main>
<?php view('admin.layouts.footer');
session_flash('old');
?>