
@extends('admin.layouts.app')

@section('css')
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 col-xl-3">
                <div class="card widget-box-three">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <i class="mdi mdi-chart-areaspline display-3 m-0"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-uppercase font-weight-medium text-truncate mb-2">Statistics</p>
                            <h2 class="mb-0"><span data-plugin="counterup">34578</span> <i class="mdi mdi-arrow-up text-success font-24"></i></h2>
                            <p class="text-muted mt-2 m-0"><span class="font-weight-medium">Last:</span> 30.4k</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-lg-6 col-xl-3">
                <div class="card widget-box-three">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <i class="mdi mdi-account-convert display-3 m-0"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-uppercase font-weight-medium text-truncate mb-2">User Today</p>
                            <h2 class="mb-0"><span data-plugin="counterup">895</span> <i class="mdi mdi-arrow-down text-danger font-24"></i></h2>
                            <p class="text-muted mt-2 m-0"><span class="font-weight-medium">Last:</span> 1250</p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-lg-6 col-xl-3">
                <div class="card widget-box-three">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <i class="mdi mdi-layers display-3 m-0"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-uppercase font-weight-medium text-truncate mb-2">User This Month</p>
                            <h2 class="mb-0"><span data-plugin="counterup">52410</span><i class="mdi mdi-arrow-up text-success font-24"></i></h2>
                            <p class="text-muted mt-2 m-0"><span class="font-weight-medium">Last:</span> 40.33k</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-lg-6 col-xl-3">
                <div class="card widget-box-three">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <i class="mdi mdi-av-timer display-3 m-0"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-uppercase font-weight-medium text-truncate mb-2">Request Per Minute</p>
                            <h2 class="mb-0"><span data-plugin="counterup">652</span> <i class="mdi mdi-arrow-down text-danger font-24"></i></h2>
                            <p class="text-muted mt-2 m-0"><span class="font-weight-medium">Last:</span> 956</p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card-box">
                    <h4 class="header-title mb-4">Recent Users</h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-centered m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>
                                        <img src="{{ url('public\assets\images\users\avatar-1.jpg') }}" alt="user" class="avatar-sm rounded-circle">
                                    </th>
                                    <td>
                                        <h5 class="m-0 font-15">Louis Hansen</h5>
                                        <p class="m-0 text-muted"><small>Web designer</small></p>
                                    </td>
                                    <td>+12 3456 789</td>
                                    <td>USA</td>
                                    <td>07/08/2016</td>
                                </tr>

                                <tr>
                                    <th>
                                        <img src="{{ url('public\assets\images\users\avatar-4.jpg') }}" alt="user" class="avatar-sm rounded-circle">
                                    </th>
                                    <td>
                                        <h5 class="m-0 font-15">Bret Weaver</h5>
                                        <p class="m-0 text-muted"><small>Web designer</small></p>
                                    </td>
                                    <td>+00 567 890</td>
                                    <td>USA</td>
                                    <td>20/07/2016</td>
                                </tr>

                                <tr>
                                    <th>
                                        <img src="{{ url('public\assets\images\users\avatar-5.jpg') }}" alt="user" class="avatar-sm rounded-circle">
                                    </th>
                                    <td>
                                        <h5 class="m-0 font-15">Mark</h5>
                                        <p class="m-0 text-muted"><small>Web design</small></p>
                                    </td>
                                    <td>+91 123 456</td>
                                    <td>India</td>
                                    <td>07/07/2016</td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                    <!-- table-responsive -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-6">
                <div class="card-box">
                    <h4 class="header-title mb-4">Recent Users</h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-centered m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>
                                        <span class="avatar-sm-box bg-success">L</span>
                                    </th>
                                    <td>
                                        <h5 class="m-0 font-15">Louis Hansen</h5>
                                        <p class="m-0 text-muted"><small>Web designer</small></p>
                                    </td>
                                    <td>+12 3456 789</td>
                                    <td>USA</td>
                                    <td>07/08/2016</td>
                                </tr>

                                <tr>
                                    <th>
                                        <span class="avatar-sm-box bg-primary">C</span>
                                    </th>
                                    <td>
                                        <h5 class="m-0 font-15">Craig Hause</h5>
                                        <p class="m-0 text-muted"><small>Programmer</small></p>
                                    </td>
                                    <td>+89 345 6789</td>
                                    <td>Canada</td>
                                    <td>29/07/2016</td>
                                </tr>

                                <tr>
                                    <th>
                                        <span class="avatar-sm-box bg-brown">E</span>
                                    </th>
                                    <td>
                                        <h5 class="m-0 font-15">Edward Grimes</h5>
                                        <p class="m-0 text-muted"><small>Founder</small></p>
                                    </td>
                                    <td>+12 29856 256</td>
                                    <td>Brazil</td>
                                    <td>22/07/2016</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-- table-responsive -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

        <div class="row justify-content-center">

            <b>
                <a class="btn btn-outline-purple" href="{{ route('sitemap') }}" target="_blank">
                    <b>Sitemap</b>
                </a>
                <a class="btn btn-outline-purple" href="{{ route('feed') }}" target="_blank">
                    <b>Feed</b>
                </a>
                <a class="btn btn-outline-purple" href="{{ url('clear-cache') }}" target="_blank">
                    <b>Cache Clear</b>
                </a>
                <a class="btn btn-outline-purple" href="{{ url('route-clear') }}" target="_blank">
                    <b>Route Clear</b>
                </a>
                <a class="btn btn-outline-purple" href="{{ url('view-clear') }}" target="_blank">
                    <b>View Clear</b>
                </a>
                <a class="btn btn-outline-purple" href="{{ url('config-cache') }}" target="_blank">
                    <b>Config Cache</b>
                </a>
                <a class="btn btn-outline-purple" href="{{ url('route-cache') }}" target="_blank">
                    <b>Route Cache</b>
                </a>
                <a class="btn btn-outline-purple" href="{{ url('optimize') }}" target="_blank">
                    <b>Optimize</b>
                </a>
            </b>
        </div>
        <!-- end row -->

    </div>
    <!-- end container-fluid -->

</div>
<!-- end content -->
@endsection

@section('scripts')
<!-- Vendor js -->
<script src="{{ url('public\assets\libs\raphael\raphael.min.js') }}"></script>
@endsection
