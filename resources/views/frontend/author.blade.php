
@extends('layouts.app')

@section('css')
@endsection

@section('meta')
    <title>Author | {{ $profile_data->name }}</title>
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
    <meta name="news_keywords" content="<?= $titless;; ?>">
    <meta name="tag" content="{{ metaBlog() }}">
    <meta name="blog" content="{{ metaBlog() }}">

    <meta property="og:site_name" content="<?= $titless; ?>"/>
    <meta property="og:locale" content="en_US" />
    <meta property="og:title" content="<?= $titless; ?>"/>
    <meta property="og:description" content="<?= strip_tags($descless); ?>"/>
    <meta property="og:image" content="{{ url('public/assets/images/theme/favicon.svg') }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ route('author', $profile_data->url) }}"/>
@endsection

@section('content')
<!-- Start Main content -->
<main class="bg-grey pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--author box-->
                <div class="author-bio mb-50 bg-white p-30 border-radius-10">
                    <div class="author-image mb-30">
                        <a href="author.html"><img src="{{ url($profile_data->image) }}" alt="" class="avatar"></a>
                    </div>
                    <div class="author-info">
                        <h3 class="font-weight-900">
                            <span class="vcard author">
                                <span class="fn">
                                    <a href="#" title="Posts by {{ $profile_data->name }}" rel="author">
                                        {{ $profile_data->name }}
                                    </a>
                                </span>
                            </span>
                        </h3>
                        <h5 class="text-muted">About author</h5>
                        <div class="author-description text-muted">
                            {{ $profile_data->message }}
                        </div>
                        <strong class="text-muted">Follow Me: </strong>
                        <ul class="header-social-network d-inline-block list-inline color-white mb-20">
                            <li class="list-inline-item"><a class="pt" href="{{ url($profile_data->youtube) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="YouTube"><i class="elegant-icon social_youtube"></i></a></li>
                            <li class="list-inline-item"><a class="tw" href="{{ url($profile_data->linkdin) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Linkedin"><i class="elegant-icon social_linkedin"></i></a></li>
                            <li class="list-inline-item"><a class="fb" href="{{ url($profile_data->instagram) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="elegant-icon social_instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- End Main content -->
@endsection

@section('scripts')
@endsection
