<?php
view('admin.layouts.header', ['title' => trans('admin.categories')]);
$categories = db_paginate('categories', '', 10);

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3><?php echo trans('admin.categories'); ?> / <?php echo trans('categories.create'); ?></h3>
        <a class="btn btn-primary" href="<?php echo aurl('categories'); ?>"><?php echo trans('admin.categories'); ?></a>
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
    $icone_errors=get_errors('icone');
    $description_errors=get_errors('description');
    end_errors();
     ?>
    <form method="post" action="<?php echo aurl('categories/create'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"><?php echo trans('categories.name'); ?></label>
                    <input type="text" name="name" value="<?php echo old('name'); ?>"
                        class="form-control <?php echo  !empty($name_errors) ? 'is-invalid' : '' ; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"><?php echo trans('categories.icone'); ?></label>
                    <input type="file" name="icone" 
                        class="form-control <?php echo  !empty($icone_errors) ? 'is-invalid' : '' ; ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description"><?php echo trans('categories.description'); ?></label>
                    <textarea type="file" name="description"
                        class="form-control <?php echo  !empty($description_errors) ? 'is-invalid' : '' ; ?>">
                        <?php echo old('description'); ?>
                    </textarea>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-success" value="<?php echo trans('admin.create'); ?>" >
    </form>
</main>
<?php view('admin.layouts.footer'); ?>