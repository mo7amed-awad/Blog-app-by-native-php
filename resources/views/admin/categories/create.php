<?php
view('admin.layouts.header', ['title' => trans('admin.categories')]);
$categories = db_paginate('categories', '', 10);

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>{{trans('admin.categories')}} / {{trans('categories.create')}}</h3>
        <a class="btn btn-primary" href="{{aurl('categories')}}">{{trans('admin.categories')}}</a>
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
    $icone_errors=get_errors('icone');
    $description_errors=get_errors('description');
    end_errors();
    @endphp
    <form method="post" action="{{aurl('categories/create')}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{trans('categories.name')}}</label>
                    <input type="text" name="name" value="{{old('name')}}"
                        class="form-control {{ !empty($name_errors) ? 'is-invalid' : '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{trans('categories.icone')}}</label>
                    <input type="file" name="icone" 
                        class="form-control {{ !empty($icone_errors) ? 'is-invalid' : '' }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">{{trans('categories.description')}}</label>
                    <textarea name="description" 
                        class="form-control {{ !empty($description_errors) ? 'is-invalid' : '' }}">
                        {{old('description')}}
                    </textarea>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-success" value="{{trans('admin.create')}}" >
    </form>
</main>
<?php view('admin.layouts.footer'); ?>