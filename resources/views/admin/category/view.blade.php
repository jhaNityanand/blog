
@extends('admin.layouts.app')

@section('css')
@php config(['app.name' => 'Blog | Category/View']); @endphp
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Category Detail / <b class="badge badge-success">{{ ucwords($category_data->type) }}</b></h4>
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
                                    <img src="{{ asset($category_data->image) }}" alt="" class="img-fluid mx-auto d-block rounded-top">
                                    <h4 class="badge badge-danger">{{ date('M d, Y', strtotime($category_data->created_at)) }}</h4>
                                </div>

                                <div class="card-body">
                                    <div class="post-title">
                                        <center>
                                            <h1><a href="javascript:void(0);">{{ $category_data->name }}</a></h1>
                                        </center>
                                    </div>
                                    <div>
                                        <h4>Description</h4>
                                        {{ $category_data->description }}
                                    </div>
                                </div>
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
