
@extends('layouts.app')

@section('css')
@endsection

@section('meta')
    <title>Home | Microshorts</title>
    <!-- ========== Meta Tags ========== -->
    <?php 
        $titless = 'Microshorts - Online Biology Study Notes';
        $descless = 'Microshorts is an educational niche website related to biology, useful for High School, B.Sc, M.Sc., M.Phil., and Ph.D.';
        $authorless = 'Vidyanand Jha';
    ?>
    <meta name="title" content="{{ $titless }}">
    <meta name="description" content="{{ $descless }}">
    <meta name="keywords" content="{{ metaCategory() }} {{ metaBlog() }}">
    <meta name="author" content="<?= $authorless; ?>">
    <meta name='pageKey' content="{{ metaCategory() }} {{ metaBlog() }}">
    <meta name='target' content='all, {{ metaCategory() }} {{ metaBlog() }}'>

    <meta name='url' content='<?= url('/'); ?>'>

    <meta name='topic' content="<?= $titless; ?>">
    <meta name='summary' content="<?= strip_tags($descless); ?>">
    <meta name='pagename' content="<?= $titless; ?>" Reilly Media>
    <meta name='category' content="{{ metaCategory() }}">
    <meta name="subtitle" content="<?= $titless; ?>">
    <meta name="news_keywords" content="<?= $titless; ?>">
    <meta name="tag" content="{{ metaBlog() }}">
    <meta name="blog" content="{{ metaBlog() }}">

    <meta property="og:site_name" content="<?= $titless; ?>"/>
    <meta property="og:locale" content="en_US" />
    <meta property="og:title" content="<?= $titless; ?>"/>
    <meta property="og:description" content="<?= strip_tags($descless); ?>"/>
    <meta property="og:image" content="{{ url('public/assets/images/theme/favicon.svg') }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?= route('/', ''); ?>"/>
@endsection

@section('content')
<!-- Start Main content -->
<main>
    <div class="featured-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <p class="text-muted"><span class="typewrite d-inline" data-period="2000" data-type='[ "Bioinformatics. ", "Recombinant DNA technology. ", "Genetic engineering", "Molecular Biology. " ]'></span></p>
                    <h2>Hello, I'm <span>Vidyanand</span></h2>
                    <h3 class="mb-20"> Welcome to our website</h3>
                    <h5><span class="typewrite d-inline" data-period="2000" data-type='[ "Microshorts is an educational website related to biology, useful for life science students....." ]'></span></h5>
                    <form action="{{ route('subscribe') }}" method="post" class="input-group form-subcriber mt-30 d-flex" autocomplete="off">
                        @csrf
                        <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror bg-white font-small" placeholder="Enter your email">
                        <button class="btn bg-primary text-white" type="submit">Subscribe</button>
                        @if($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </form>
                </div>
                <div class="col-lg-6 text-right d-none d-lg-block">
                    <img src="{{ url('public/assets/images/banner/banner.svg') }}" alt="banner.svg">
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="hot-tags pt-30 pb-30 font-small align-self-center">
            <div class="widget-header-3">
                <div class="row align-self-center">
                    <div class="col-md-4 align-self-center">
                        <h5 class="widget-title">Featured posts</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="loop-grid mb-30">
            <div class="row">
                <div class="col-lg-8 mb-30">
                    <div class="carausel-post-1 hover-up border-radius-10 overflow-hidden transition-normal position-relative wow fadeInUp animated">
                        <div class="arrow-cover"></div>
                        <div class="slide-fade">
                            @foreach($blog_data as $key => $value)
                            <div class="position-relative post-thumb">
                                <div class="thumb-overlay img-hover-slide position-relative" style="background-image: url({{ url($value->image) }})">
                                    <a class="img-link" href="{{ route('blog', $value->url) }}"></a>
                                    <div class="post-content-overlay text-white ml-30 mr-30 pb-30">
                                        <div class="entry-meta meta-0 font-small mb-20">
                                            <a href="{{ route('category', $value->c_url) }}"><span class="post-cat text-info text-uppercase">{{ $value->c_name }}</span></a>
                                        </div>
                                        <h3 class="post-title font-weight-900 mb-20">
                                            <a class="text-white" href="{{ route('blog', $value->url) }}"> {{ $value->title }} </a>
                                        </h3>
                                        <div class="entry-meta meta-1 font-small text-white mt-10 pr-5 pl-5">
                                            <span class="post-on"><b>{{ date('d M Y', strtotime($value->created_at)) }}</b></span>
                                            <span class="hit-count has-dot"><b>{{ $value->comment }}</b> Comments</span>
                                            <span class="hit-count has-dot"><b>{{ $value->view }}</b> Views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <article class="col-lg-4 col-md-6 mb-30 wow fadeInUp animated" data-wow-delay="0.2s">
                    <div class="post-card-1 border-radius-10 hover-up">
                        <div class="post-thumb thumb-overlay img-hover-slide position-relative" style="background-image: url({{ url($blog_single->image) }})">
                            <a class="img-link" href="{{ route('blog', $blog_single->url) }}"></a>
                        </div>
                        <div class="post-content p-30">
                            <div class="entry-meta meta-0 font-small mb-10">
                                <a href="{{ route('category', $blog_single->c_url) }}"><span class="post-cat text-info">{{ $blog_single->c_name }}</span></a>
                            </div>
                            <div class="d-flex post-card-content">
                                <h5 class="post-title mb-20 font-weight-900">
                                    <a href="{{ route('blog', $blog_single->url) }}"> {{ $blog_single->title }} </a>
                                </h5>
                                <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                    <span class="post-on"><b>{{ date('d M Y', strtotime($blog_single->created_at)) }}</b></span>
                                    <span class="post-by has-dot"><b>{{ $blog_single->view }}</b> views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>

    <div class="bg-grey pt-30 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="post-module-2">
                        <div class="loop-list loop-list-style-1">
                            <div class="row">
                                @foreach($blog_data as $key => $value)
                                @if($key > 5 && $key < 10)
                                <article class="col-md-6 mb-40 wow fadeInUp  animated">
                                    <div class="post-card-1 border-radius-10 hover-up">
                                        <div class="post-thumb thumb-overlay img-hover-slide position-relative" style="background-image: url({{ url($value->image) }})">
                                            <a class="img-link" href="{{ route('blog', $value->url) }}"></a>
                                        </div>
                                        <div class="post-content p-30">
                                            <div class="entry-meta meta-0 font-small mb-10">
                                                <a href="category.html.htm"><span class="post-cat text-info">{{ $value->c_name }}</span></a>
                                            </div>
                                            <div class="d-flex post-card-content">
                                                <h5 class="post-title mb-20 font-weight-900">
                                                    <a href="{{ route('blog', $value->url) }}">{{ substr($value->title, 0, 40) }} .....</a>
                                                </h5>
                                                <div class="post-excerpt mb-25 font-small text-muted">
                                                    <p>
                                                        {{ substr($value->meta_description, 0, 150) }} .......
                                                    </p>
                                                </div>
                                                <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                                    <span class="post-on"><b>{{ date('d M Y', strtotime($value->created_at)) }}</b></span>
                                                    <span class="post-by has-dot"><b>{{ $value->view }}</b> Views</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="sidebar-widget widget-about mb-50 pt-30 pr-30 pb-30 pl-30 bg-white border-radius-5 has-border  wow fadeInUp animated">
                            <a href="{{ route('author', $profile_data->url) }}" target="_blank">
                                <img class="about-author-img mb-25" src="{{ url($profile_data->image) }}" alt="{{ $profile_data->name }}">
                            </a>
                            <a class="text-dark" href="{{ route('author', $profile_data->url) }}" target="_blank">
                                <h5 class="mb-20">Hello, I'm {{ $profile_data->name }}</h5>
                            </a>
                            <p class="font-medium text-muted">
                                {{ substr($profile_data->message, 0, 200) }} ......
                            </p>
                            <strong>Follow me: </strong>
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
                                    @foreach($blog_data as $key => $value)
                                    @if($key < 4)
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
                                    @endif
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
<!--site-bottom-->
<div class="site-bottom pt-30 pb-30">
    <div class="container">
        <div class="sidebar-widget widget-latest-posts mb-30 mt-20 wow fadeInUp animated">
            <div class="widget-header-2 position-relative mb-30">
                <h5 class="mt-5 mb-30">Categories</h5>
            </div>
            <div class="carausel-3-columns">
                @foreach($category_data as $key => $value)
                <div class="carausel-3-columns-item d-flex bg-grey has-border p-25 hover-up-2 transition-normal border-radius-5">
                    <div class="post-thumb post-thumb-64 d-flex mr-15 border-radius-5 img-hover-scale overflow-hidden">
                        <a class="color-white" href="{{ route('category', $value->url) }}">
                            <img src="{{ asset($value->image) }}" alt="Thumbnil">
                        </a>
                    </div>
                    <div class="post-content media-body">
                        <h5> <a href="{{ route('category', $value->url) }}">{{ $value->name }} <!-- <b>({{ $value->no_of_post }})</b> --></a> </h5>
                        <p class="text-muted font-small">{{ substr($value->description, 0, 50) }}.....</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--container-->
</div>
<!--end site-bottom-->
@endsection
