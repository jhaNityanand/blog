
@extends('admin.layouts.app')

@section('css')
@php config(['app.name' => 'Blog | Comment']); @endphp
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
                            <a href="{{ route('comment.create') }}" class="btn btn-outline-primary">
                                <strong>Add New Comment</strong>
                            </a>
                        </b>
                    </div>
                    <h4 class="page-title"> View all Comment </h4>
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
                                <th>UserName</th>
                                <th>Blog/Question Title</th>
                                <th>Type</th>
                                <th>Message</th>
                                <th>Replid</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @foreach($comment_data as $key => $value)
                            <tr>
                                <td>
                                    <span class="avatar-sm-box bg-purple">
                                        {{ $key + 1 }}
                                    </span>
                                </td>
                                <td>
                                    <h5 class="m-0 font-15">{{ $value->name }}</h5>
                                    <p class="m-0 text-muted"><small>{{ $value->email }}</small></p>
                                </td>
                                <td>{{ $value->blog ?? $value->question }}</td>
                                <td>{{ ucwords($value->type) }}</td>
                                <td>
                                    <b>
                                        <button class="btn btn-outline-secondary waves-effect waves-light" 
                                                    onclick="modal('{{ $value->blog }}', '{{ $value->message }}')">
                                            <strong>View</strong>
                                        </button>
                                    </b>
                                </td>
                                <td>
                                    @if(!empty($value->reply))
                                        {{ reply($value->reply) }}
                                    @endif
                                </td>
                                <td>
                                    @if($value->status == 'Active')
                                    <button class="btn btn-success">
                                        <strong>{{ $value->status }}</strong>
                                    </button>
                                    @elseif($value->status == 'InActive')
                                    <button class="btn btn-danger">
                                        <strong>{{ $value->status }}</strong>
                                    </button>
                                    @elseif($value->status == 'Pending')
                                    <button class="btn btn-warning">
                                        <strong>{{ $value->status }}</strong>
                                    </button>
                                    @else
                                    <button class="btn btn-dark">
                                        <strong>{{ $value->status }}</strong>
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    @if($value->created_by == 'admin')
                                    <b>
                                        <a data-toggle="tooltip" data-placement="top" title="Edit Record"  href="{{ route('comment.edit', $value->id) }}" class="btn btn-outline-info">
                                            <i class='fas fa-edit'></i>
                                        </a>
                                    </b>
                                    @endif
                                    @if($value->status == 'Pending')
                                    <b>
                                        <a data-toggle="tooltip" data-placement="top" title="Verify Comment"  class="btn btn-outline-success" href="javascript:void(0);"
                                                onclick="event.preventDefault();
                                                    document.getElementById('update-form').submit();">
                                            <i class='fas fa-check'></i>
                                        </a>
                                        <form id="update-form" action="{{ route('comment.update', $value->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="verify" value="verify">
                                        </form>
                                    </b>
                                    @endif
                                    @if($value->status != 'Deleted')
                                    <b>
                                        <a data-toggle="tooltip" data-placement="top" title="Delete Record" class="btn btn-outline-danger" href="javascript:void(0);"
                                                onclick="deletes('delete-form-{{ $key + 1 }}')">
                                            <i class='fas fa-trash'></i>
                                        </a>
                                        <form id="delete-form-{{ $key + 1 }}" action="{{ route('comment.destroy', $value->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </b>
                                    @endif
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

<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="title" class="modal-title mt-0">Modal Heading...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="message">Modal Cintent...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@php
    function reply($user_id)
    {
        $return = DB::table('comments')->where('id', $user_id)->first();
        return $return->name;
    }
@endphp

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
    function modal(title, message) {
        $('#title').html(title);
        $('#message').html(message);
        $('#myModal').modal('show');
    }

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
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "autoWidth": false,
        "responsive": false,
        "scrollX": true,
      });
</script>
@endsection
