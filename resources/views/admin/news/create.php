<?php
view('admin.layouts.header', ['title' => trans('admin.news')]);
$categories=db_get('categories','');
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>{{trans('admin.news')}} / {{trans('news.create')}}</h3>
        <a class="btn btn-primary" href="{{aurl('news')}}">{{trans('admin.news')}}</a>
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
    $title_errors=get_errors('title');
    $image_errors=get_errors('image');
    $description_errors=get_errors('description');
    $content_errors=get_errors('content');
    $user_id_errors=get_errors('user_id');
    $category_id_errors=get_errors('category_id');
    end_errors();
    @endphp
    <form method="post" action="{{aurl('news/create')}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">{{trans('news.title')}}</label>
                    <input type="text" name="title" value="{{old('title')}}"
                        class="form-control {{ !empty($title_errors) ? 'is-invalid' : '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_id">{{trans('news.category_id')}}</label>
                    <select name="category_id" id="" class="form-select {{ !empty($category_id_errors) ? 'is-invalid' : '' }}">
                        <option disabled selected>{{trans('admin.choose')}}</option>
                        <?php while($category = mysqli_fetch_assoc($categories['query'])):?>
                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                        <?php endwhile; ?>
                    </select>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">{{trans('news.image')}}</label>
                    <input type="file" name="image" 
                        class="form-control {{ !empty($image_errors) ? 'is-invalid' : '' }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">{{trans('news.description')}}</label>
                    <textarea name="description" 
                        class="form-control {{ !empty($description_errors) ? 'is-invalid' : '' }}">
                        {{old('description')}}
                    </textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="content">{{trans('news.content')}}</label>
                    <textarea name="content" id="content"
                        class="form-control {{ !empty($content_errors) ? 'is-invalid' : '' }}">
                        {{old('content')}}
                    </textarea>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-success" value="{{trans('admin.create')}}" >
    </form>
</main>
<script>
    ClassicEditor
    .create(document.querySelector('#content'),{
        language: '{{ session_has("locale")?session("locale"):"en"}}'
    })
    .catch(error => {
        console.error(error);
    });
</script>
<?php view('admin.layouts.footer'); 
session_flash('old');
?>