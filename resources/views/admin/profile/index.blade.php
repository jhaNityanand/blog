
@extends('admin.layouts.app')

@section('css')
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
                    <h4 class="page-title">Profile</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="">
                        <form action="{{ route('profile.update', $profile_data->p_id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="name">User Name</label>
                                <input type="text" value="{{ $profile_data->name }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="User Name" />

                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="name">User URL</label>
                                <input type="text" value="{{ $profile_data->url }}" class="form-control @error('url') is-invalid @enderror" name="url" id="url" placeholder="User URL" />

                                @if($errors->has('url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="url">User Email</label>
                                <input type="email" value="{{ $profile_data->email }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="User Email" readonly />

                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-lg-12 mb-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Profile Picture (thumbnail 300*300)</label>
                                            <input type="file" value="{{ asset($profile_data->image) }}" name="image" id="image" class="dropify @error('image') is-invalid @enderror" data-height="210">

                                            @if($errors->has('image'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <label for=""> &nbsp; </label><br>
                                        <img src="{{ asset($profile_data->image) }}" alt="Thumbnail" style="object-fit: cover;width: 100%;height: auto;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="message">About Self</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" placeholder="Write About Self (character 190 to 210)......" cols="30" rows="4">
                                    {{ $profile_data->message }}
                                </textarea>

                                @if($errors->has('message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <h4>Social Media Link: </h4>

                            <div class="form-group mb-4">
                                <label for="facebook">Facebook</label>
                                <input type="url" value="{{ $profile_data->facebook }}" class="form-control" name="facebook" id="facebook" placeholder="Facebook Link" />
                            </div>

                            <div class="form-group mb-4">
                                <label for="instagram">Instagram</label>
                                <input type="url" value="{{ $profile_data->instagram }}" class="form-control" name="instagram" id="instagram" placeholder="Instagram Link" />
                            </div>

                            <div class="form-group mb-4">
                                <label for="linkdin">Linkdin</label>
                                <input type="url" value="{{ $profile_data->linkdin }}" class="form-control" name="linkdin" id="linkdin" placeholder="Linkdin Link" />
                            </div>

                            <div class="form-group mb-4">
                                <label for="twitter">Twitter</label>
                                <input type="url" value="{{ $profile_data->twitter }}" class="form-control" name="twitter" id="twitter" placeholder="Twitter Link" />
                            </div>

                            <div class="form-group mb-4">
                                <label for="youtube">YouTube</label>
                                <input type="url" value="{{ $profile_data->youtube }}" class="form-control" name="youtube" id="youtube" placeholder="YouTube Link" />
                            </div>

                            <div class="form-group mb-4">
                                <label for="gmail">Gmail Account</label>
                                <input type="email" value="{{ $profile_data->gmail }}" class="form-control" name="gmail" id="gmail" placeholder="Gmail Account" />
                            </div>

                            <div class="form-group mb-4">
                                <label for="telegram">Telegram</label>
                                <input type="url" value="{{ $profile_data->telegram }}" class="form-control" name="telegram" id="telegram" placeholder="Telegram Link" />
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
