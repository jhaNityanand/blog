
@extends('admin.layouts.app')

@section('css')
@php config(['app.name' => 'Blog | Question/Update']); @endphp
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
                    <h4 class="page-title">Edit Question </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="">
                        <form action="{{ route('questions.update', $question_data->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="title">Question Title</label>
                                <input type="text" value="{{ $question_data->title }}" class="form-control @error('title') is-invalid @enderror generateURL generateMetaTitle" name="title" id="title" placeholder="Enter title" autofocus>

                                @if($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="url">Question URL</label>
                                <input type="text" value="{{ $question_data->url }}" class="form-control @error('url') is-invalid @enderror getURL" name="url" id="url" placeholder="Enter URL">

                                @if($errors->has('url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="category">Question Category</label>
                                <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                                    <option value="">Select a category</option>
                                    @foreach($category_data as $key => $value)                                    
                                    <option value="{{ $value->id }}" {{ ($question_data->category == $value->id) ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group mb-4">
                                <label>Content</label>
                                <textarea name="content" id="content" class="summernote @error('content') is-invalid @enderror" placeholder="Content...">
                                    {{ $question_data->content }}
                                </textarea>

                                @if($errors->has('content'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label>Question Tags</label>
                                <input type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" id="tags" value="{{ $question_data->tags }}" data-role="tagsinput" placeholder="Add Tags">

                                @if($errors->has('tags'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="status">Question Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="">Select a status</option>
                                    <option value="Active" {{ ($question_data->status == 'Active') ? 'selected' : '' }}>Active</option>
                                    <option value="InActive" {{ ($question_data->status == 'InActive') ? 'selected' : '' }}>InActive</option>
                                </select>

                                @if($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="author">Question Author Name</label>
                                <input type="text" value="{{ $question_data->author }}" class="form-control @error('author') is-invalid @enderror" name="author" id="author" placeholder="Enter Author Name">

                                @if($errors->has('author'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- META start -->

                            <div class="form-group mb-4">
                                <label for="meta_title">Meta Question Title</label>
                                <input type="text" value="{{ $question_data->meta_title }}" class="form-control @error('meta_title') is-invalid @enderror getMetaTitle" name="meta_title" id="meta_title" placeholder="Enter Meta Question Title">

                                @if($errors->has('meta_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('meta_title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="meta_description">Meta Question Description</label>
                                <input type="text" value="{{ $question_data->meta_description }}" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description" placeholder="Enter Meta Question Description">

                                @if($errors->has('meta_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('meta_description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="meta_author">Meta Author Name</label>
                                <input type="text" value="{{ $question_data->meta_author }}" class="form-control @error('meta_author') is-invalid @enderror" name="meta_author" id="meta_author" placeholder="Enter Meta Author Name">

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
