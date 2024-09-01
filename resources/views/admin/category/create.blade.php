
@extends('admin.layouts.app')

@section('css')
@php config(['app.name' => 'Blog | Category/Add']); @endphp
<!-- Plugins css -->
<link href="{{ url('public\assets\libs\dropify\dropify.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Category</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="">
                        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="title">Category Title</label>
                                <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror generateURL" name="name" id="name" placeholder="Category Title" />

                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="title">Category Type</label>
                                <div class="form-control @error('name') is-invalid @enderror">
                                    <input type="radio" value="blog" name="type" id="type" {{ (old('type') == 'blog') ? 'checked' : '' }} /> Blog
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="question" name="type" id="type" {{ (old('type') == 'question') ? 'checked' : '' }} /> Question
                                </div>

                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="url">Category URL</label>
                                <input type="text" value="{{old('url')}}" class="form-control @error('url') is-invalid @enderror getURL" class="form-control" name="url" id="url" placeholder="Enter URL">

                                @if($errors->has('url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="description">Category Description</label>
                                <input type="text" value="{{old('description')}}" class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Category Short Description" />

                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label>File Uploads (thumbnail 500*500)</label>
                                <input type="file" value="{{ old('image') }}" name="image" id="image" class="dropify @error('image') is-invalid @enderror" data-height="210">

                                @if($errors->has('image'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="status">Category Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="">Select a status</option>
                                    <option value="Active" {{ (old('status') == 'Active') ? 'selected' : '' }} selected>Active</option>
                                    <option value="InActive" {{ (old('status') == 'InActive') ? 'selected' : '' }}>InActive</option>
                                </select>

                                @if($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light mr-1">Save</button>
                            <button type="button" class="back btn btn-danger waves-effect waves-light">Discard</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end container-fluid -->

</div>
<!-- end content -->
@endsection

@section('scripts')
<!-- Plugins js -->
<script src="{{ url('public\assets\libs\dropify\dropify.min.js') }}"></script>

<script>
    $(function() { 
        $(".dropify").dropify({ 
            messages: { 
                default: "Drag and drop a file here or click", 
                replace: "Drag and drop or click to replace", 
                remove: "Remove", 
                error: "Ooops, something wrong appended."
            }, error: { 
                fileSize: "The file size is too big (1M max)." 
            } 
        }) 
    });
</script>
@endsection
