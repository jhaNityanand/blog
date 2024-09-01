
@extends('layouts.app')

@section('css')
@endsection

@section('meta')
    <title>Category | {{ $category_data->name }}</title>
    <!-- ========== Meta Tags ========== -->
    <?php 
        $titless = 'Microshorts - Online Biology Study Notes';
        $descless = 'Microshorts is an educational niche website related to biology, useful for High School, B.Sc, M.Sc., M.Phil., and Ph.D.';
        $authorless = 'Vidyanand Jha';
    ?>
    <meta name="title" content="{{ $category_data->name ?? $titless }}">
    <meta name="description" content="{{ $category_data->description ?? $descless }}">
    <meta name="keywords" content="{{ metaCategory() }} {{ metaBlog() }}">
    <meta name="author" content="<?= $authorless; ?>">
    <meta name='pageKey' content="{{ metaCategory() }} {{ metaBlog() }}">
    <meta name='target' content='all, {{ metaCategory() }} {{ metaBlog() }}'>

    <meta name='url' content='<?= route('category', $category_data->url); ?>'>

    <meta name='topic' content="<?= $category_data->name ?? $titless; ?>">
    <meta name='summary' content="<?= strip_tags($category_data->description ?? $descless); ?>">
    <meta name='pagename' content="<?= $category_data->name ?? $titless; ?>" Reilly Media>
    <meta name='category' content="{{ metaCategory() }}">
    <meta name="subtitle" content="<?= $category_data->name ?? $titless; ?>">
    <meta name="news_keywords" content="<?= $category_data->name ?? $titless;; ?>">
    <meta name="tag" content="{{ metaBlog() }}">
    <meta name="blog" content="{{ metaBlog() }}">

    <meta property="og:site_name" content="<?= $category_data->name ?? $titless; ?>"/>
    <meta property="og:locale" content="en_US" />
    <meta property="og:title" content="<?= $category_data->name ?? $titless; ?>"/>
    <meta property="og:description" content="<?= strip_tags($category_data->description ?? $descless); ?>"/>
    <meta property="og:image" content="{{ asset($category_data->image) ?? url('public/assets/images/theme/favicon.svg') }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?= route('category', $category_data->url); ?>"/>
@endsection

@section('content')
<!-- Start Main content -->
<main>
    <div class="bg-grey pt-20 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="post-module-2">
                        <div class="widget-header-1 position-relative mb-30  wow fadeInUp animated">

                            <div class="carausel-12-columns-item d-flex bg-grey has-border p-25 transition-normal border-radius-5">
                                <div class="post-thumb post-thumb-64 d-flex mr-15 border-radius-5 overflow-hidden">
                                    <a class="color-white" href="#">
                                        <img src="{{ !empty($category_data->image) ? asset($category_data->image) : url('/').'/public/assets/images/question/question.jpg' }}" alt="Thumbnil">
                                    </a>
                                </div>
                                <div class="post-content media-body">
                                    <h2> <a href="#">{{ $category_data->name }}</a> </h2>
                                    <p class="text-muted font-small">{{ $category_data->description }}</p>
                                </div>
                            </div>

                        </div>
                        @if(count($blog_data) == 0)
                        <div class="row justify-content-center">
                            <div class="col-lg-12 text-center">
                                <h2>
                                    No Record Founds.
                                </h2>
                                <br>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="button button-contactForm">
                                    <a class="text-white" href="{{ route('/') }}">
                                        Home page
                                    </a>
                                </button>
                            </div>
                        </div>
                        @endif
                        <div class="loop-list loop-list-style-1">
                            <div class="row justify-content-center">
                                
                                @foreach($blog_data as $key => $value)
                                <article class="col-md-6 col-lg-4 mb-40 wow fadeInUp  animated">
                                    <div class="post-card-1 border-radius-10 hover-up">
                                        @if($category_data->type != 'question')
                                        <div class="post-thumb thumb-overlay img-hover-slide position-relative" style="background-image: url( {{ asset($value->image) }} )">
                                            <a class="img-link" href="{{ route('blog', $value->url) }}"></a>
                                        </div>
                                        @endif
                                        <div class="post-content p-30">
                                            <div class="entry-meta meta-0 font-small mb-10">
                                                <a href="#"><span class="post-cat text-info">{{ $category_data->name }}</span></a>
                                            </div>
                                            <div class="d-flex post-card-content">
                                                <h5 class="post-title mb-20 font-weight-900">
                                                    <a href="{{ ($category_data->type != 'question') ? route('blog', $value->url) : route('question', $value->url) }}">{{ substr($value->title, 0, 40) }} .....</a>
                                                </h5>
                                                <div class="post-excerpt mb-25 font-small text-muted">
                                                    <p>
                                                        {{ substr($value->meta_description, 0, 140) }} .......
                                                    </p>
                                                </div>
                                                <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                                    <span class="post-on"><b>{{ date('d M', strtotime($value->created_at)) }}</b></span>
                                                    <span class="time-reading has-dot"><b>{{ $value->comment }}</b> Comments</span>
                                                    <span class="post-by has-dot"><b>{{ $value->view }}</b> views</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- End Main content -->
@endsection
