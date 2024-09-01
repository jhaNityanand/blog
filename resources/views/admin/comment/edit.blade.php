
@extends('admin.layouts.app')

@section('css')
@php config(['app.name' => 'Blog | Comment/Update']); @endphp
<!-- Plugin css -->
<link href="{{ url('public\assets\libs\select2\select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Edit Comment</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="">
                        <form action="{{ route('comment.update', $comment_data->id) }}" method="post" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="name">UserName</label>
                                <input type="text" value="{{ $comment_data->name }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Comment Title" />

                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input type="email" value="{{ $comment_data->email }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Comment Title" />

                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="blog_id">Blog</label>
                                <select class="form-control @error('blog_id') is-invalid @enderror select2" name="blog_id" id="blog_id">
                                    <option value="">Select a blog</option>
                                    @foreach($blog_data as $key => $value) 
                                    @if($value->id == $comment_data->blog_id)                                   
                                    <option value="{{ $value->id }}" {{ ($comment_data->blog_id == $value->id) ? 'selected' : '' }}>{{ $value->title }}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @if($errors->has('blog_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('blog_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="message">Comment Message</label>
                                <input type="text" value="{{ $comment_data->message }}" class="form-control @error('message') is-invalid @enderror" name="message" id="message" placeholder="Comment Message" />

                                @if($errors->has('message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="status">Comment Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="">Select a status</option>
                                    <option value="Active" {{ ($comment_data->status == 'Active') ? 'selected' : '' }}>Active</option>
                                    <option value="InActive" {{ ($comment_data->status == 'InActive') ? 'selected' : '' }}>InActive</option>
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
<!-- Vendor js -->
<script src="{{ url('public\assets\libs\select2\select2.min.js') }}"></script>
<script>
    $(function(){
        $(".select2").select2(),
        $(".select2-limiting").select2({maximumSelectionLength:2})
    });
</script>
@endsection
