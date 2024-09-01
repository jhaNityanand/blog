
@extends('admin.layouts.app')

@section('css')
@php config(['app.name' => 'Blog | Question/View']); @endphp
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Question Detail</h4>
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
                                    <span class="badge badge-danger">{{ $question_data->category }}</span>
                                </div>

                                <div class="card-body">
                                    <div class="text-muted"><h4>by <a class="text-dark"><strong>{{ $question_data->author }}</strong></a>, {{ date('M d, Y', strtotime($question_data->created_at)) }}</h4></div>
                                    <div class="post-title">
                                        <center>
                                            <h1><a href="javascript:void(0);">{{ $question_data->title }}</a></h1>
                                        </center>
                                    </div>
                                    <div>
                                        {!! $question_data->content !!}

                                        <blockquote class="blockquote blockquote-reverse mt-3 mb-0">
                                            <p>
                                                {{ $question_data->meta_description }}
                                            </p>
                                            <footer class="blockquote-footer">
                                                {{ $question_data->author }}
                                            </footer>
                                        </blockquote>
                                    </div>
                                </div>

                                <hr>
                                <div>
                                    @foreach(explode(',', $question_data->tags) as $key => $value)
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
