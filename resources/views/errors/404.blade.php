
@extends('layouts.app')

@section('css')
@endsection

@section('meta')
    <title>404 | Microshorts</title>
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
<main class="bg-grey pt-20 pb-20">
    <div class="container">
        <div class="row pt-80">
            <div class="col-lg-6 col-md-12 d-lg-block d-none pr-50"><img src="{{ url('public/assets/images/banner/page-not-found.png') }}" alt="page-not-found"></div>
            <div class="col-lg-6 col-md-12 pl-50 text-md-center text-lg-left">
                <h1 class="mb-30 font-weight-900 page-404">404</h1>
                <form action="{{ route('search') }}" method="post" class="search-form d-lg-flex open-search mb-30">
                    @csrf
                    <i class="icon-search"></i>
                    <input class="form-control" name="name" id="name" type="text" placeholder="Search...">
                </form>
                <p class="">The link you clicked may be broken or the page may have been removed.<br> visit the <a href="{{ url('/') }}">Homepage</a> or <a href="#">Contact us</a> about the problem
                </p>
                <div class="form-group">
                    <button type="submit" class="button button-contactForm mt-30"><a class="text-white" href="{{ url('/') }}">Home page</a></button>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- End Main content -->
@endsection

@section('scripts')
@endsection
