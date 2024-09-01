
@extends('admin.layouts.app')

@section('css')
@php config(['app.name' => 'Blog | Blog/Update']); @endphp
<!-- Tags -->
<link href="{{ url('public\assets\libs\bootstrap-tagsinput\bootstrap-tagsinput.css') }}" rel="stylesheet">

<!-- Plugins css -->
<link href="{{ url('public\assets\libs\dropify\dropify.min.css') }}" rel="stylesheet" type="text/css">
        
<!-- Summernote css -->
<link href="{{ url('public\assets\libs\summernote\summernote-bs4.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Edit Blog </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="">
                        <form action="{{ route('blog.update', $blog_data->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="title">Blog Title</label>
                                <input type="text" value="{{ $blog_data->title }}" class="form-control @error('title') is-invalid @enderror generateURL generateMetaTitle" name="title" id="title" placeholder="Enter title" autofocus>

                                @if($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="url">Blog URL</label>
                                <input type="text" value="{{ $blog_data->url }}" class="form-control @error('url') is-invalid @enderror getURL" name="url" id="url" placeholder="Enter URL">

                                @if($errors->has('url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="category">Blog Category</label>
                                <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                                    <option value="">Select a category</option>
                                    @foreach($category_data as $key => $value)                                    
                                    <option value="{{ $value->id }}" {{ ($blog_data->category == $value->id) ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-lg-12 mb-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>File Uploads (thumbnail 1000*600)</label>
                                            <input type="file" value="{{ asset($blog_data->image) }}" name="image" id="image" class="dropify @error('image') is-invalid @enderror" data-height="210">

                                            @if($errors->has('image'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <label for=""> &nbsp; </label><br>
                                        <img src="{{ asset($blog_data->image) }}" alt="Thumbnail" style="object-fit: cover;width: 100%;height: auto;padding-top: 44px;">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label>Content</label>
                                <textarea name="content" id="content" class="summernote @error('content') is-invalid @enderror" placeholder="Content...">
                                    {{ $blog_data->content }}
                                </textarea>

                                @if($errors->has('content'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label>Blog Tags</label>
                                <input type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" id="tags" value="{{ $blog_data->tags }}" data-role="tagsinput" placeholder="Add Tags">

                                @if($errors->has('tags'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="status">Blog Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="">Select a status</option>
                                    <option value="Active" {{ ($blog_data->status == 'Active') ? 'selected' : '' }}>Active</option>
                                    <option value="InActive" {{ ($blog_data->status == 'InActive') ? 'selected' : '' }}>InActive</option>
                                </select>

                                @if($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="author">Blog Author Name</label>
                                <input type="text" value="{{ $blog_data->author }}" class="form-control @error('author') is-invalid @enderror" name="author" id="author" placeholder="Enter Author Name">

                                @if($errors->has('author'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- META start -->

                            <div class="form-group mb-4">
                                <label for="meta_title">Meta Blog Title</label>
                                <input type="text" value="{{ $blog_data->meta_title }}" class="form-control @error('meta_title') is-invalid @enderror getMetaTitle" name="meta_title" id="meta_title" placeholder="Enter Meta Blog Title">

                                @if($errors->has('meta_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('meta_title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="meta_description">Meta Blog Description</label>
                                <input type="text" value="{{ $blog_data->meta_description }}" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description" placeholder="Enter Meta Blog Description">

                                @if($errors->has('meta_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('meta_description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="meta_author">Meta Author Name</label>
                                <input type="text" value="{{ $blog_data->meta_author }}" class="form-control @error('meta_author') is-invalid @enderror" name="meta_author" id="meta_author" placeholder="Enter Meta Author Name">

                                @if($errors->has('meta_author'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('meta_author') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- META end -->

                            <button type="submit" class="btn btn-success waves-effect waves-light mr-1">Save</button>
                            <button type="button" class="back btn btn-danger waves-effect waves-light">Discard</button>
                        </form>
                    </div>
                </div>
                <!-- end p-20 -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- end container-fluid -->

</div>
<!-- end content -->
@endsection

@section('scripts')
<!-- Tags -->
<script src="{{ url('public\assets\libs\bootstrap-tagsinput\bootstrap-tagsinput.min.js') }}"></script>

<!-- Summernote js -->
<script src="{{ url('public\assets\libs\summernote\summernote-bs4.min.js') }}"></script>

<!-- Plugins js -->
<script src="{{ url('public\assets\libs\dropify\dropify.min.js') }}"></script>
<script src="{{ url('public\assets\js\pages\blog-add.init.js') }}"></script>

<script>
    $('.summernote').summernote({
        placeholder: 'write here...',
        addDefaultFonts: true,
        dialogsInBody: true,
        height: 240, minHeight: null, maxHeight: null, focus: !1,
        styleTags: [
        'p',
            { title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote' },
            'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
        ],
        toolbar: [
            ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph', 'blockquote']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ]
    });
    $('.summernote').summernote('fontName', 'Arial');
    $('.summernote').summernote('fontSize', 14);
    $('.summernote').summernote('foreColor', 'black');
    $('.summernote').summernote('formatPara');
</script>
@endsection
