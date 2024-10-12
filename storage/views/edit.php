<?php
$news = db_find('news', request('id'));
view('admin.layouts.header', ['title' => trans('admin.news') . '--' . $news['title']]);
// if(empty($category)){
//     redirect(aurl('categories'));
// }
redirect_if(empty($news), aurl('news'));
$categories=db_get('categories','');
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3><?php echo trans('admin.news'); ?> / <?php echo trans('news.create'); ?></h3>
        <a class="btn btn-primary" href="<?php echo aurl('news'); ?>"><?php echo trans('admin.news'); ?></a>
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
    $title_errors=get_errors('title');
    $image_errors=get_errors('image');
    $description_errors=get_errors('description');
    $content_errors=get_errors('content');
    $user_id_errors=get_errors('user_id');
    $category_id_errors=get_errors('category_id');
    end_errors();
     ?>
    <form method="post" action="<?php echo aurl('news/edit?id='.$news['id']); ?>" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title"><?php echo trans('news.title'); ?></label>
                    <input type="text" name="title" 
                    value="<?php echo  !empty(old('title')) ? old('title') : $news['title'] ; ?>"
                        class="form-control <?php echo  !empty($title_errors) ? 'is-invalid' : '' ; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_id"><?php echo trans('news.category_id'); ?></label>
                    <select name="category_id" id="" class="form-select <?php echo  !empty($category_id_errors) ? 'is-invalid' : '' ; ?>">
                        <option disabled selected><?php echo trans('admin.choose'); ?></option>
                        <?php while($category = mysqli_fetch_assoc($categories['query'])):?>
                            <option <?php echo  $news['category_id']==$category['id']?'selected':''; ?> value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endwhile; ?>
                    </select>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title"><?php echo trans('news.image'); ?></label>
                    <input type="file" name="image" 
                        class="form-control <?php echo  !empty($image_errors) ? 'is-invalid' : '' ; ?>">
                        <?php echo image(storage_url($news['image'])); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description"><?php echo trans('news.description'); ?></label>
                    <textarea name="description" 
                        class="form-control <?php echo  !empty($description_errors) ? 'is-invalid' : '' ; ?>">
                        <?php echo  !empty(old('description')) ? old('description') : $news['description'] ; ?>
                    </textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="content"><?php echo trans('news.content'); ?></label>
                    <textarea name="content" id="content"
                        class="form-control <?php echo  !empty($content_errors) ? 'is-invalid' : '' ; ?>">
                        <?php echo  !empty(old('content')) ? old('content') : $news['content'] ; ?>
                    </textarea>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-success" value="<?php echo trans('admin.edit'); ?>" >
    </form>
</main>
<script>
    ClassicEditor
    .create(document.querySelector('#content'),{
        language: '<?php echo  session_has("locale")?session("locale"):"en"; ?>'
    })
    .catch(error => {
        console.error(error);
    });
</script>
<?php view('admin.layouts.footer'); 
session_flash('old');
?>