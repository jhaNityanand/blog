
@extends('layouts.app')

@section('css')
@endsection

@section('meta')
    <title>Post | {{ $blog_data->title }}</title>
    <!-- ========== Meta Tags ========== -->
    <?php 
        $titless = 'Microshorts - Online Biology Study Notes';
        $descless = 'Microshorts is an educational niche website related to biology, useful for High School, B.Sc, M.Sc., M.Phil., and Ph.D.';
        $authorless = 'Vidyanand Jha';
    ?>
    <meta name="title" content="{{ $blog_data->meta_title ?? $titless }}">
    <meta name="description" content="{{ $blog_data->meta_description ?? $descless }}">
    <meta name="keywords" content="<?= (!empty($blog_data->tags)) ? str_replace('.', '', $blog_data->tags).', '.$blog_data->url : $blog_data->url; ?>">
    <meta name="author" content="<?= (!empty($blog_data->meta_author)) ? $blog_data->meta_author : $authorless; ?>">
    <meta name='pageKey' content="<?= (!empty($blog_data->tags)) ? str_replace('.', '', $blog_data->tags).', '.$blog_data->url.', '.$blog_data->meta_title : $blog_data->url; ?>">
    <meta name='target' content='all, <?= (!empty($blog_data->tags)) ? str_replace('.', '', $blog_data->tags) : $blog_data->url; ?>'>

    <meta name='url' content='<?= route('blog', $blog_data->url); ?>'>

    <meta name='topic' content="<?= (!empty($blog_data->meta_title)) ? $blog_data->meta_title : $titless; ?>">
    <meta name='summary' content="<?= (!empty($blog_data->meta_description)) ? strip_tags($blog_data->meta_description) : $descless; ?>">
    <meta name='pagename' content="<?= (!empty($blog_data->meta_title)) ? $blog_data->meta_title : $blog_data->title ?>" Reilly Media>
    <meta name='category' content='<?= (!empty($blog_data->tags)) ? str_replace('.', '', $blog_data->tags).', '.$blog_data->url.', '.$blog_data->meta_title : $blog_data->url; ?>'>
    <meta name="subtitle" content="<?= (!empty($blog_data->meta_title)) ? $blog_data->meta_title : $titless; ?>">
    <meta name="news_keywords" content="<?= $blog_data->url; ?>">
    <meta name="tag" content="<?= (!empty($blog_data->tags)) ? str_replace('.', '', $blog_data->tags).', '.$blog_data->url.', '.$blog_data->meta_title : $blog_data->url; ?>">
    <meta name="blog" content="<?= (!empty($blog_data->tags)) ? str_replace('.', '', $blog_data->tags).', '.$blog_data->url.', '.$blog_data->meta_title : $blog_data->url; ?>">

    <meta property="og:site_name" content="<?= $titless; ?>"/>
    <meta property="og:locale" content="en_US" />
    <meta property="og:title" content="<?= (!empty($blog_data->meta_title)) ? $blog_data->meta_title : $titless; ?>"/>
    <meta property="og:description" content="<?= (!empty($blog_data->meta_description)) ? $blog_data->meta_description : $descless ?>"/>
    <meta property="og:image" content="{{ isset($blog_data->image) ? url($blog_data->image) : url('public/assets/images/theme/favicon.svg') }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?= route('blog', $blog_data->url); ?>"/>
@endsection

@section('content')
<!-- Start Main content -->
<main class="bg-grey pt-20 pb-20">
    <div class="pb-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 card">
                    <div class="single-content2">
                        <div class="entry-header mb-50">
                            <h1 class="entry-title mb-30 mt-30 text-center bold">
                                {{ $blog_data->title }}
                            </h1>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="entry-meta align-items-center meta-2 font-small color-muted">
                                        <p class="mb-5">
                                            <a class="author-avatar" href="{{ route('author', $profile_data->url) }}" target="_blank"><img class="img-circle" src="{{ url($profile_data->image) }}" alt=""></a>
                                            By <a href="{{ route('author', $profile_data->url) }}" target="_blank"><span class="author-name font-weight-bold">{{ $blog_data->author }}</span></a>
                                        </p>
                                        <span class="mr-10"> <b>{{ date('d M Y', strtotime($blog_data->created_at)) }}</b></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end single header-->
                        @if(isset($blog_data->image))
                        <figure class="image mb-30 m-auto text-center border-radius-10">
                            <img class="border-radius-10" src="{{ isset($blog_data->image) ? url($blog_data->image): '' }}" alt="post-title">
                        </figure>
                        @endif
                        <!--figure-->
                        <article class="entry-wraper mb-50">
                            <div class="entry-main-content wow fadeIn animated">
                                {!! $blog_data->content !!}
                            </div>
                            
                            <div class="single-social-share clearfix wow fadeIn animated">
                                <div class="entry-meta meta-1 font-small color-grey float-left mt-10">
                                    <span class="hit-count mr-15"><i class="elegant-icon icon_comment_alt mr-5"></i>{{ $blog_data->comment }} <b>Comments</b></span>
                                    <span class="hit-count mr-15"><i class="elegant-icon icon_like mr-5"></i>{{ $blog_data->view }} <b>Likes</b></span>
                                </div>
                                <ul class="header-social-network d-inline-block list-inline float-md-right mt-md-0 mt-4">
                                    <li class="list-inline-item text-muted"><span>Share this: </span></li>
                                    <li class="list-inline-item"><a class="social-icon fb text-xs-center" href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog', $blog_data->url) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="elegant-icon social_facebook"></i></a></li>
                                    <li class="list-inline-item"><a class="social-icon tw text-xs-center" href="http://www.twitter.com/share?url={{ route('blog', $blog_data->url) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="elegant-icon social_twitter"></i></a></li>
                                    <li class="list-inline-item"><a class="social-icon pt text-xs-center" href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('blog', $blog_data->url) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Linkedin"><i class="elegant-icon social_linkedin"></i></a></li>
                                </ul>
                            </div>
                            <!--More posts-->
                            <div class="single-more-articles border-radius-5">
                                <div class="widget-header-2 position-relative mb-30">
                                    <h5 class="mt-5 mb-30">You might be interested in</h5>
                                    <button class="single-more-articles-close"><i class="elegant-icon icon_close"></i></button>
                                </div>
                                <div class="post-block-list post-module-1 post-module-5">
                                    <ul class="list-post">
                                        @foreach($blog_popup as $key => $value)
                                        <li class="mb-30">
                                            <div class="d-flex hover-up-2 transition-normal">
                                                <div class="post-thumb post-thumb-80 d-flex mr-15 border-radius-5 img-hover-scale overflow-hidden">
                                                    <a class="color-white" href="{{ route('blog', $value->url) }}">
                                                        <img src="{{ url($value->image) }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-content media-body">
                                                    <h6 class="post-title mb-15 text-limit-2-row font-medium"><a href="{{ route('blog', $value->url) }}">{{ substr($value->title, 0, 60) }} ....</a></h6>
                                                    <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                                        <span class="post-on"><b>{{ date('d M Y', strtotime($value->created_at)) }}</b></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <a href="#comment"></a>
                            <!--Comments-->
                            <div class="comments-area" id="comment">
                                <div class="widget-header-2 position-relative mb-30">
                                    <h5 class="mt-5 mb-30">Comments</h5>
                                </div>
                                @foreach($comment_data as $key => $value)
                                <div class="comment-list wow fadeIn animated">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="{{ url('public/assets/images/users/user.png') }}" alt="">
                                            </div>
                                            <div class="desc">
                                                <p class="comment">
                                                    @if(strlen($value->message) < 60)
                                                        {{ $value->message }}
                                                        @for($count = 0; $count <= (60 - strlen($value->message)); $count++)
                                                            &nbsp;
                                                        @endfor
                                                    @else
                                                        {{ $value->message }}
                                                    @endif
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <h5>
                                                            <a href="#">{{ $value->name }}</a>
                                                        </h5>
                                                        <p class="date">{{ date('d M Y', strtotime($value->created_at)) }}</p>
                                                    </div>
                                                    <div class="reply-btn">
                                                        <a href="#" onclick="reply('{{ $value->id }}', '{{ $value->blog_id }}')" class="btn-reply">Reply</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $reply_datas = reply($value->id, $value->blog_id);                                        
                                    @endphp
                                    @foreach($reply_datas as $keys => $values)
                                    <div class="single-comment depth-2 justify-content-between d-flex mt-50">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="{{ url('public/assets/images/users/users.png') }}" alt="">
                                            </div>
                                            <div class="desc">
                                                <p class="comment">
                                                    @if(strlen($values->message) < 50)
                                                        {{ $values->message }}
                                                        @for($count = 0; $count <= (50 - strlen($values->message)); $count++)
                                                            &nbsp;
                                                        @endfor
                                                    @else
                                                        {{ $values->message }}
                                                    @endif
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <h5>
                                                            <a href="#">{{ $values->name }}</a>
                                                        </h5>
                                                        <p class="date">{{ date('d M Y', strtotime($value->created_at)) }}</p>
                                                    </div>
                                                    <div class="reply-btn">
                                                        <a href="#" onclick="reply('{{ $values->id }}', '{{ $values->blog_id }}')" class="btn-reply">Reply</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                            <!--comment form-->
                            <div class="comment-form wow fadeIn animated" id="">
                                <div class="widget-header-2 position-relative mb-30">
                                    <h5 class="mt-5 mb-30">Leave a Reply</h5>
                                </div>
                                <form class="form-contact comment_form" method="post" action="{{ route('comment') }}" autocomplete="off" id="commentForm">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ $blog_data->id }}">
                                    <input type="hidden" name="type" id="type" value="{{ $type }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <textarea class="form-control w-100 @error('message') is-invalid @enderror" name="message" id="message" cols="30" rows="3" placeholder="Write Comment">{{ old('message') }}</textarea>
                                                @if($errors->has('message'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('message') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" type="text" placeholder="Name">
                                                @if($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" type="email" placeholder="Email">
                                                @if($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn button button-contactForm">Post Comment</button>
                                    </div>
                                </form>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-4 primary-sidebar sticky-sidebar">
                    <div class="widget-area">
                        <div class="sidebar-widget widget-about mb-50 pt-30 pr-20 pb-30 pl-20 bg-white border-radius-5 has-border  wow fadeInUp animated">
                            <a href="{{ route('author', $profile_data->url) }}" target="_blank">
                                <img class="about-author-img mb-25" src="{{ url($profile_data->image) }}" alt="{{ $profile_data->name }}">
                            </a>
                            <a class="text-dark" href="{{ route('author', $profile_data->url) }}" target="_blank">
                                <h5 class="mb-20">Hello, I'm {{ $profile_data->name }}</h5>
                            </a>
                            <p class="font-medium text-muted">
                                {{ substr($profile_data->message, 0, 200) }} ......
                            </p>
                            <strong>Follow Us: </strong>
                            <ul class="header-social-network d-inline-block list-inline color-white mb-20">
                                <li class="list-inline-item"><a class="pt" href="{{ url($profile_data->youtube) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="YouTube"><i class="elegant-icon social_youtube"></i></a></li>
                                <li class="list-inline-item"><a class="tw" href="{{ url($profile_data->linkdin) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Linkedin"><i class="elegant-icon social_linkedin"></i></a></li>
                                <li class="list-inline-item"><a class="fb" href="{{ url($profile_data->instagram) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="elegant-icon social_instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="sidebar-widget widget-latest-posts mb-50 wow fadeInUp animated">
                            <div class="widget-header-1 position-relative mb-30">
                                <h5 class="mt-5 mb-30">Most popular</h5>
                            </div>
                            <div class="post-block-list post-module-1">
                                <ul class="list-post">
                                    @foreach($blog_side as $key => $value)
                                    <li class="mb-15 wow fadeInUp animated">
                                        <div class="d-flex bg-white has-border p-10 hover-up transition-normal border-radius-5">
                                            <div class="post-content media-body">
                                                <h6 class="post-title mb-15 text-limit-2-row font-medium"><a href="{{ route('blog', $value->url) }}">{{ substr($value->title, 0, 50) }} ....</a></h6>
                                                <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                                    <span class="post-on"><b>{{ date('d M Y', strtotime($value->created_at)) }}</b></span>
                                                </div>
                                            </div>
                                            <div class="post-thumb post-thumb-80 d-flex ml-15 border-radius-5 img-hover-scale overflow-hidden">
                                                <a class="color-white" href="{{ route('blog', $value->url) }}">
                                                    <img src="{{ url($value->image) }}" alt="{{ $value->title }}">
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- End Main content -->

@php
    function reply($user_id, $blog_id)
    {
        $reply_data = [];
        $return = DB::table('comments')->where('blog_id', $blog_id)
                ->where('status', 'Active')->where('reply', $user_id)
                ->orderBy('id', 'asc')->get();

        foreach($return as $key => $value)
        {
            $reply_data[] = $value;
            if(!empty($value->reply)) 
            {
                $returns = reply($value->id, $value->blog_id);
                foreach($returns as $key => $values)
                {
                    $reply_data[] = $values;
                }
            }
        }
        return $reply_data;
    }
@endphp

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Leave a Reply</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-contact comment_form" method="post" action="{{ route('comment') }}" autocomplete="off" id="commentForm">
        @csrf
        <div class="modal-body">
                <input type="hidden" name="blog_id" id="blog_id" value="">
                <input type="hidden" name="reply" id="reply" value="">
                <input type="hidden" name="type" id="type" value="{{ $type }}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control w-100" name="message" id="message" cols="30" rows="3" required placeholder="Write Comment"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control" name="name" id="name" type="text" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control" name="email" id="email" type="email" placeholder="Email" required>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <div class="form-group">
                <button type="button" class="btn btn-secondary button" data-dismiss="modal">Close</button>
                <button type="submit" class="btn button button-contactForm">Post Comment</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
    function reply(id, blog_id)
    {
        $('#exampleModal').modal('show');
        $('#blog_id').val(blog_id);
        $('#reply').val(id);
    }
</script>
@endsection
