
@extends('admin.layouts.app')

@section('css')
@php config(['app.name' => 'Blog | Image']); @endphp
<!-- SweetAlert -->
<link href="{{ url('public\assets\libs\sweetalert2\sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

<!-- Table datatable css -->
<link href="{{ url('public\assets\libs\datatables\dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('public\assets\libs\datatables\responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('public\assets\libs\datatables\buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('public\assets\libs\datatables\fixedHeader.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('public\assets\libs\datatables\scroller.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('public\assets\libs\datatables\dataTables.colVis.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <b>
                            <a href="{{ route('image.create') }}" class="btn btn-outline-primary">
                                <strong>Add New Image's</strong>
                            </a>
                        </b>
                    </div>
                    <h4 class="page-title"> View all Image's </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">

                    <!-- @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif -->

                    <!-- @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{ session('success') }}</strong>
                    </div>
                    @endif -->

                    <table id="datatabless" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>SR No.</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @foreach($image_data as $key => $value)
                            <tr>
                                <td>
                                    <span class="avatar-sm-box bg-purple">
                                        {{ $key + 1 }}
                                    </span>
                                </td>
                                <td><b>{{ $value->image_name }}</b></td>
                                <td>
                                    <a href="{{ url($value->image_url) }}" target="_blank">
                                        <img src="{{ asset($value->image_url) }}" width="80" height="40" alt="">
                                    </a>
                                </td>
                               
                                <td>
                                    <b>
                                        <button onclick="myFunction('{{ url($value->image_url) }}', '{{ $key + 1 }}')" data-toggle="tooltip" data-placement="top" title="Copy File URL" class="btn btn-outline-success copy-{{ $key + 1 }}">
                                            <strong>
                                                <i class="mdi mdi-content-copy"></i>
                                            </strong>
                                        </button>
                                        <button onclick="myFunction('{{ url($value->image_url) }}')" data-toggle="tooltip" data-placement="top" title="Copied" class="btn btn-outline-success copied-{{ $key + 1 }} d-none">
                                            <strong>
                                                <i class="mdi mdi-content-copy"></i>
                                            </strong>
                                        </button>
                                    </b>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <b>
                                        <a data-toggle="tooltip" data-placement="top" title="Delete File" class="btn btn-outline-danger selector" href="javascript:void(0);"
                                                onclick="deletes('delete-form-{{ $key + 1 }}')">
                                            <i class='fas fa-trash'></i>
                                        </a>
                                        <form id="delete-form-{{ $key + 1 }}" action="{{ route('image.destroy', $value->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </b>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <!-- end container-fluid -->

</div>
<!-- end content -->
@endsection

@section('scripts')
<!-- Datatable plugin js -->
<script src="{{ url('public\assets\libs\datatables\jquery.dataTables.min.js') }}"></script>
<script src="{{ url('public\assets\libs\datatables\dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ url('public\assets\libs\datatables\dataTables.responsive.min.js') }}"></script>
<script src="{{ url('public\assets\libs\datatables\responsive.bootstrap4.min.js') }}"></script>

<script src="{{ url('public\assets\libs\datatables\dataTables.buttons.min.js') }}"></script>
<script src="{{ url('public\assets\libs\datatables\buttons.bootstrap4.min.js') }}"></script>

<script src="{{ url('public\assets\libs\datatables\buttons.html5.min.js') }}"></script>
<script src="{{ url('public\assets\libs\datatables\buttons.print.min.js') }}"></script>

<script src="{{ url('public\assets\libs\datatables\dataTables.keyTable.min.js') }}"></script>
<script src="{{ url('public\assets\libs\datatables\dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ url('public\assets\libs\datatables\dataTables.scroller.min.js') }}"></script>

<script src="{{ url('public\assets\libs\jszip\jszip.min.js') }}"></script>
<script src="{{ url('public\assets\libs\pdfmake\pdfmake.min.js') }}"></script>
<script src="{{ url('public\assets\libs\pdfmake\vfs_fonts.js') }}"></script>

<!-- Datatables init -->
<script src="{{ url('public\assets\js\pages\datatables.init.js') }}"></script>

<!-- SweetAlert -->
<script src="{{ url('public\assets\libs\sweetalert2\sweetalert2.min.js') }}"></script>
<script src="{{ url('public\assets\js\pages\sweetalerts.init.js') }}"></script>

<script>
    function deletes(id)
    {
        Swal.fire({
            title:"Are you sure?",
            text:"You won't be able to revert this!",
            type:"warning",
            showCancelButton:!0,
            confirmButtonColor:"#348cd4",
            cancelButtonColor:"#6c757d",
            confirmButtonText:"Yes, delete it!"
        }).then(function(t){
            t.value&&Swal.fire(
                "Deleted!",
                "Your file has been deleted.",
                "success",
                event.preventDefault(),
                document.getElementById(id).submit(),
            )
        })
    }

    function myFunction(copyText, id) {

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText);

        // Alert the copied text
        // alert("Copied the text: " + copyText);

        $('.copy-'+id).addClass('d-none');
        $('.copied-'+id).removeClass('d-none');
    }

    $('#datatabless').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "autoWidth": false,
        "responsive": false,
        "scrollX": true,
      });
</script>
@endsection
