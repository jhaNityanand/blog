
@extends('admin.layouts.app')

@section('css')
@php config(['app.name' => 'Blog | Blog/View']); @endphp
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Blog Detail</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="p-4">

                            <!-- Image Post -->
                            <div class="card blog-post bg-transparent">
                                <div class="post-image">
                                    <img src="{{ asset($blog_data->image) }}" alt="" class="img-fluid mx-auto d-block rounded-top">
                                    <span class="badge badge-danger">{{ $blog_data->category }}</span>
                                </div>

                                <div class="card-body">
                                    <div class="text-muted"><h4>by <a class="text-dark"><strong>{{ $blog_data->author }}</strong></a>, {{ date('M d, Y', strtotime($blog_data->created_at)) }}</h4></div>
                                    <div class="post-title">
                                        <center>
                                            <h1><a href="javascript:void(0);">{{ $blog_data->title }}</a></h1>
                                        </center>
                                    </div>
                                    <div>
                                        {!! $blog_data->content !!}

                                        <blockquote class="blockquote blockquote-reverse mt-3 mb-0">
                                            <p>
                                                {{ $blog_data->meta_description }}
                                            </p>
                                            <footer class="blockquote-footer">
                                                {{ $blog_data->author }}
                                            </footer>
                                        </blockquote>
                                    </div>
                                </div>

                                <hr>
                                <div>
                                    @foreach(explode(',', $blog_data->tags) as $key => $value)
                                    <button class="btn btn-outline-purple"><b>{{ $value }}</b></button>
                                    @endforeach
                                </div>
                                <hr>

                            </div>
                            
                        </div>
                        <!-- end p-20 -->
                    </div>
                    <!-- end col -->
                </div>
            </div>

        </div>
        <!-- end container-fluid -->
    </div>

</div>
<!-- end content -->
@endsection

@section('scripts')
@endsection
