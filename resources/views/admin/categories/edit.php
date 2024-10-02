<?php
$category = db_find('categories', request('id'));
view('admin.layouts.header', ['title' => trans('admin.categories') . '--' . $category['name']]);
// if(empty($category)){
//     redirect(aurl('categories'));
// }
redirect_if(empty($category), aurl('categories'));
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>{{trans('admin.categories')}} / {{trans('admin.edit')}}</h3>
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
    <form method="post" action="{{aurl('categories/edit?id='.$category['id'])}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{trans('categories.name')}}</label>
                    <input type="text" name="name" value="{{ !empty(old('name')) ? old('name') : $category['name'] }}"
                        class="form-control {{ !empty($name_errors) ? 'is-invalid' : '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{trans('categories.icone')}}</label>
                    <input type="file" name="icone"
                        class="form-control {{ !empty($icone_errors) ? 'is-invalid' : '' }}">
                    <!-- Button trigger modal -->
                    <img src="{{storage_url($category['icone'])}}" data-bs-toggle="modal" data-bs-target="#showImage" style="width:25px;height:25px;cursor:pointer" />
                    <!-- Modal -->
                    <div class="modal fade" id="showImage" tabindex="-1" aria-labelledby="showImageLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="{{storage_url($category['icone'])}}" style="width:100%;height:100%;" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">{{trans('categories.description')}}</label>
                    <textarea name="description"
                        class="form-control {{ !empty($description_errors) ? 'is-invalid' : '' }}">
                        {{ !empty(old('description')) ? old('description') : $category['description'] }}
                    </textarea>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-success" value="{{trans('admin.edit')}}">
    </form>
</main>
<?php view('admin.layouts.footer');
session_flash('old');
?>