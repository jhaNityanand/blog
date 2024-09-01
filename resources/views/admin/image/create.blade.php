
@extends('admin.layouts.app')

@section('css')
@php config(['app.name' => 'Blog | Image/Add']); @endphp
<!-- Plugins css -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
@endsection

@section('content')

 <!-- <body>
  <div class="container-fluid">
      <br />
    <h3 align="center">Image Upload in Laravel using Dropzone</h3>
    <br />
        
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Select Image</h3>
        </div>
        <div class="panel-body">
          <form id="dropzoneForm" class="dropzone" action="{{ route('image.create') }}">
            @csrf
          </form>
          <div align="center">
            <button type="button" class="btn btn-info" id="submit-all">Upload</button>
          </div>
        </div>
      </div>
      <br />
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Uploaded Image</h3>
        </div>
        <div class="panel-body" id="uploaded_image">
          
        </div>
      </div>
    </div>
 </body> -->

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <b>
                            <a href="{{ route('image.index') }}" class="">
                                <strong style="font-size: larger;">Image's</strong>
                            </a>
                        </b>
                    </div>
                    <h4 class="page-title">Add Content Image's</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="alert alert-success alert-dismissible hide_show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong style="font-size: large;"><b id="message"></b></strong>
        </div>
        

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="">

                        <label>Content File Uploads</label>
                        <form action="{{ route('image.store') }}" id="dropzoneForm" class="dropzone">
                            @csrf
                        </form>
                        <br>
                        <button type="button" id="submit-all" class="btn btn-success waves-effect waves-light mr-1">
                            <strong>Upload</strong>
                        </button>
                        
                        <button type="button" class="back btn btn-danger waves-effect waves-light">
                            <strong>Discard</strong>
                        </button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

<script>
  Dropzone.options.dropzoneForm = {
    autoProcessQueue : false,
    acceptedFiles : ".png, .jpg, .gif, .bmp, .jpeg, .svg, .webp",

    init:function(){
      var submitButton = document.querySelector("#submit-all");
      myDropzone = this;

      submitButton.addEventListener('click', function(){
        myDropzone.processQueue();
      });

      this.on("complete", function(){
        if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
        {
          var _this = this;
          _this.removeAllFiles();
        }
        
        load();
      });
      
    }
  };

  function load()
  {
    $('.hide_show').show();
    $('#message').html('File Uploaded Successfully!');
  }

  $('.hide_show').hide();

</script>
@endsection
