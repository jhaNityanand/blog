
@extends('admin.layouts.app')

@section('css')
@php config(['app.name' => 'Blog | Blog']); @endphp
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
                            <a href="{{ route('blog.create') }}" class="btn btn-outline-primary">
                                <strong>Add New Blog</strong>
                            </a>
                        </b>
                    </div>
                    <h4 class="page-title"> View all blogs </h4>
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
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>No. of Comment</th>
                                <th>No. of View</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @foreach($blog_data as $key => $value)
                            <tr>
                                <td>
                                    <span class="avatar-sm-box bg-purple">
                                        {{ $key + 1 }}
                                    </span>
                                </td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->category }}</td>
                                <td>
                                    @if($value->status == 'Active')
                                    <button class="btn btn-success">
                                        <strong>{{ $value->status }}</strong>
                                    </button>
                                    @elseif($value->status == 'InActive')
                                    <button class="btn btn-danger">
                                        <strong>{{ $value->status }}</strong>
                                    </button>
                                    @else
                                    <button class="btn btn-dark">
                                        <strong>{{ $value->status }}</strong>
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    <b>
                                        <a data-toggle="tooltip" data-placement="top" title="View Record" href="{{ route('blog.show', $value->id) }}" target="_blank" class="btn btn-outline-warning">
                                            <i class='fas fa-eye'></i>
                                        </a>
                                    </b>
                                    <b>
                                        <a data-toggle="tooltip" data-placement="top" title="Edit Record" href="{{ route('blog.edit', $value->id) }}" class="btn btn-outline-info">
                                            <i class='fas fa-edit'></i>
                                        </a>
                                    </b>
                                    @if($value->status != 'Deleted')
                                    <b>
                                        <a data-toggle="tooltip" data-placement="top" title="Delete Record" class="btn btn-outline-danger" href="javascript:void(0);"
                                                onclick="deletes('delete-form-{{ $key + 1 }}')">
                                            <i class='fas fa-trash'></i>
                                        </a>
                                        <form id="delete-form-{{ $key + 1 }}" action="{{ route('blog.destroy', $value->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </b>
                                    @endif
                                    <!-- @if($value->status != 'Deleted')
                                    <b>
                                        <form action="{{ route('blog.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class='fas fa-trash'></i>
                                            </button>
                                        </form>
                                    </b>
                                    @endif -->
                                </td>
                                <td>{{ $value->comment }}</td>
                                <td>{{ $value->view }}</td>
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

    $('#datatabless').DataTable({
        "paging": true,
        "lengthChange": 20,
        "searching": true,
        "ordering": true,
        "autoWidth": false,
        "responsive": false,
        "scrollX": true,
      });
</script>
@endsection
