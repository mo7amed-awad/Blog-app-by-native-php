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
        <h3><?php echo trans('admin.users'); ?> / <?php echo trans('admin.edit'); ?></h3>
        <a class="btn btn-primary" href="<?php echo aurl('users'); ?>"><?php echo trans('admin.users'); ?></a>
    </div>
    <?php if( all_errors()): ?>
    <div class="alert alert-danger">
        <ol>
            <?php foreach(all_errors() as $error): ?>
            <li><?php echo $error ?></li>
            <?php endforeach; ?>
        </ol>

    </div>
    <?php endif; ?>

    <?php 
    $name_errors=get_errors('name');
    $email_errors=get_errors('email');
    $password_errors=get_errors('password');
    $mobile_errors=get_errors('mobile');
    $user_type_errors=get_errors('user_type');
    end_errors();
     ?>
    <form method="post" action="<?php echo aurl('users/edit?id='.$user['id']); ?>" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"><?php echo trans('users.name'); ?></label>
                    <input type="text" name="name" value="<?php echo  !empty(old('name')) ? old('name') : $user['name'] ; ?>"
                        class="form-control <?php echo  !empty($name_errors) ? 'is-invalid' : '' ; ?>">
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email"><?php echo trans('users.email'); ?></label>
                    <input type="email" name="email" value="<?php echo  !empty(old('email')) ? old('email') : $user['email'] ; ?>"
                        class="form-control <?php echo  !empty($email_errors) ? 'is-invalid' : '' ; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="password"><?php echo trans('users.password'); ?></label>
                    <input type="password" name="password"
                        class="form-control <?php echo  !empty($password_errors) ? 'is-invalid' : '' ; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile"><?php echo trans('users.mobile'); ?></label>
                    <input type="text" name="mobile" value="<?php echo  !empty(old('mobile')) ? old('mobile') : $user['mobile'] ; ?>"
                        class="form-control <?php echo  !empty($mobile_errors) ? 'is-invalid' : '' ; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_type"><?php echo trans('users.user_type'); ?></label>
                    <select class="form-select <?php echo  !empty($user_type_errors) ? 'is-invalid' : '' ; ?>" name="user_type">
                        <option value="user" <?php echo $user['user_type'] == 'user'?'select':''; ?>><?php echo trans('users.user'); ?></option>
                        <option value="admin" <?php echo $user['user_type'] == 'admin'?'select':''; ?>><?php echo trans('users.admin'); ?></option>
                    </select>
                </div>
            </div>

        </div>
        <input type="submit" class="btn btn-success" value="<?php echo trans('admin.edit'); ?>">
    </form>
</main>
<?php view('admin.layouts.footer');
session_flash('old');
?>