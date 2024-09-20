<?php  
view('layout.header',['title'=>trans('main.home')]);
?>
    <h1>
        <?= trans('main.home')?>
        
    </h1>
    <!-- <a href="<?php
    // echo url('storage/test/test/file.png')?>">Download File</a> -->

    <?php if(any_errors()): ?>
        <div class="alert alert-danger">
            <ol>
                <<?php foreach(any_errors() as $errors): ?>
                    <?php foreach($errors as $error): ?>
                        <li><?php echo $error?></li>
                    <?php endforeach; ?>    
                <?php endforeach; ?>
            </ol>
        </div>
    <?php endif; ?>

        <?php
        $email_errors=get_errors('email');
        $mobile_errors=get_errors('mobile');
        $name_errors=get_errors('name');
        end_errors();
        ?>
    <?php echo url('upload');?>
    <form method="post" action="<?php echo url('upload')?>" enctype="multipart/form-data">

        <label><?php echo trans('main.email')?> : </label>
        <input type="text" name="email" value="<?php echo old('email')?old('email'):''; ?>"
        class="form-control <?php echo !empty($email_errors)?'is-invalid':'' ;?>">
        <div class="<?php echo !empty($email_errors)?'invalid-feedback':'valid-feedback' ;?>">
            <?php echo($email_errors)?>
        </div>

        <label><?php echo trans('main.mobile')?> : </label>
        <input type="text" name="mobile" value="<?php echo old('mobile')?old('mobile'):''; ?>"
         class="form-control <?php echo !empty($mobile_errors)?'is-invalid':'' ;?>">
        <div class="<?php echo !empty($mobile_errors)?'invalid-feedback':'valid-feedback' ;?>">
            <?php echo $mobile_errors?>
        </div>

        <label><?php echo trans('main.name')?> : </label>
        <input type="text" name="name" value="<?php echo old('name')?old('name'):''; ?>"
         class="form-control <?php echo !empty($name_errors)?'is-invalid':'' ;?>">
        <div class="<?php echo !empty($name_errors)?'invalid-feedback':'valid-feedback' ;?>">
            <?php echo $name_errors?>
        </div>

        <input type="hidden" name="_method" value="post">
        <input type="submit" class="btn btn-success" value="Send">
    </form>
    <?php session_flash('old');?>
 
<?php  view('layout.footer');?>