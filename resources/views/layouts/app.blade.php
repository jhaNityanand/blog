
@php
    $blog_data_head = DB::table('blogs')
                ->where('blogs.status', 'Active')
                ->leftJoin('categories', 'blogs.category', '=', 'categories.id')
                ->select('categories.name as c_name', 'categories.url as c_url', 'blogs.*')
                ->orderBy('blogs.view', 'desc')->limit(3)->get();
        
    $category_data_head = DB::table('categories')
                ->leftJoin('blogs', 'categories.id', '=', 'blogs.category')
                ->select('categories.*', DB::raw('count(blogs.id) as no_of_post'))
                ->where('categories.status', 'Active')
                ->groupBy('categories.id')->inRandomOrder()
                ->limit(5)->get();
@endphp

<!DOCTYPE html>
<html class="no-js" lang="en">
<!-- Design by Examtube| © 2023All rights reserved -->

<head>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/assets/images/theme/favicon.svg') }}">
    
    @yield('meta')

    <meta name='date' content='<?= date('Y M d G:i:s'); ?>'>
    <meta name='search_date' content='<?= date('Y M d G:i:s'); ?>'>
    <meta name='identifier-URL' content='<?= url('/'); ?>'>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='HandheldFriendly' content='True'>
    <meta name='MobileOptimized' content='320'>
    <meta name='copyright' content='Examtube'>
    <meta name='language' content='ES'>
    <meta name='robots' content='follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large'>
    <meta name='directory' content='submission'>
    <meta name='coverage' content='Worldwide'>
    <meta name='distribution' content='Global'>
    <meta name='rating' content='General'>
    <meta name='revisit-after' content='7 days'>

    @yield('css')

    <!-- NewsBoard CSS  -->
    <link rel="canonical" href="{{ url('') }}" />
    <link rel="stylesheet" href="{{ url('public/f_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/f_assets/css/widgets.css') }}">
    <link rel="stylesheet" href="{{ url('public/f_assets/css/responsive.css') }}">
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-35TPDL6YPR"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-35TPDL6YPR');
    </script>
    
    <meta name="p:domain_verify" content="a970034f682bb9bbc89a7eb02ee49cfe"/>
    
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3495821309562824" crossorigin="anonymous"></script>
    
</head>

<body>
    <div class="scroll-progress primary-bg"></div>
    <!-- Start Preloader -->
    <!--<div class="preloader text-center">-->
    <!--    <div class="circle"></div>-->
    <!--</div>-->
    <!--Offcanvas sidebar-->
    <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar">
        <button class="off-canvas-close"><i class="elegant-icon icon_close"></i></button>
        <div class="sidebar-inner">
            <!--Categories-->
            <div class="sidebar-widget widget_categories mb-50 mt-30">
                <div class="widget-header-2 position-relative">
                    <h5 class="mt-5 mb-15">Hot topics</h5>
                </div>
                <div class="widget_nav_menu">
                    <ul>
                        @foreach($category_data_head as $key => $value)
                        <li class="cat-item cat-item-2"><a href="{{ route('category', $value->url) }}">{{ $value->name }}</a> <span class="post-count">{{ $value->no_of_post }}</span></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--Latest-->
            <div class="sidebar-widget widget-latest-posts mb-50">
                <div class="widget-header-2 position-relative mb-30">
                    <h5 class="mt-5 mb-30">Don't miss</h5>
                </div>
                <div class="post-block-list post-module-1 post-module-5">
                    <ul class="list-post">
                        @foreach($blog_data_head as $key => $value)
                        <li class="mb-30">
                            <div class="d-flex hover-up-2 transition-normal">
                                <div class="post-thumb post-thumb-80 d-flex mr-15 border-radius-5 img-hover-scale overflow-hidden">
                                    <a class="color-white" href="{{ route('blog', $value->url) }}">
                                        <img src="{{ url($value->image) }}" alt="{{ $value->title }}">
                                    </a>
                                </div>
                                <div class="post-content media-body">
                                    <h6 class="post-title mb-15 text-limit-2-row font-medium"><a href="{{ route('blog', $value->url) }}">
                                        {{ substr($value->title, 0, 50) }}.....
                                    </a></h6>
                                    <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                        <span class="post-on"><b>{{ date('d M', strtotime($value->created_at)) }}</b></span>
                                        <span class="post-by has-dot"><b>{{ $value->view }}</b> views</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--Ads-->
            <div class="sidebar-widget widget-ads">
                <div class="widget-header-2 position-relative mb-30">
                    <h5 class="mt-5 mb-30">Advertise banner</h5>
                </div>
                <a href="#" target="_blank">
                    <img class="advertise-img border-radius-5" src="{{ url('public/assets/images/ads/ads.jpg')}}" alt="">
                </a>
            </div>
        </div>
    </aside>
    <!-- Start Header -->
    <header class="main-header header-style-1 font-heading">
        <div class="header-top">
            <div class="container">
                <div class="row pt-20 pb-20">
                    <div class="col-md-3 col-xs-6">
                        <a href="{{ url('/') }}"><img class="logo" src="{{ url('public/assets/images/theme/logo.svg') }}" alt="Examtube Logo"></a>
                    </div>
                    <div class="col-md-9 col-xs-6 text-right header-top-right ">
                        <span class="vertical-divider mr-20 ml-20 d-none d-md-inline"></span>
                        <button class="search-icon d-none d-md-inline"><span class="mr-15 text-muted font-small"><i class="elegant-icon icon_search mr-5"></i>Search</span></button>
                        <button onclick="window.open( '{{ url('admin') }}')" class="btn btn-radius bg-primary text-white ml-15 font-small box-shadow">Join Us</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-sticky">
            <div class="container align-self-center">
                <div class="mobile_menu d-lg-none d-block"></div>
                <div class="main-nav d-none d-lg-block float-left">
                    <nav>
                         <!--Desktop menu-->
                        <ul class="main-menu d-none d-lg-inline font-medium">
                            <li class="menu-item-has-children">
                                <a href="{{ url('/') }}/category/biotechnology"> <i class="elegant-icon icon_tags_alt <!-- icon_house_alt --> mr-5"></i> Biotechnology</a>
                                <ul class="sub-menu text-muted font-medium">
                                    <li><a href="{{ url('/') }}/category/bioinformatics"><i class="elegant-icon icon_tag_alt mr-5"></i> Bioinformatics</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ url('/') }}/category/biotechnology"> <i class="elegant-icon icon_tags_alt mr-5"></i> Microbiology</a>
                                <ul class="sub-menu text-muted font-medium ">
                                    <li><a href="{{ url('/') }}/category/virology"><i class="elegant-icon icon_tag_alt mr-5"></i> Virology</a></li>
                                    <li><a href="{{ url('/') }}/category/bacteriology"><i class="elegant-icon icon_tag_alt mr-5"></i> Bacteriology</a></li>
                                    <li><a href="{{ url('/') }}/category/mycology"><i class="elegant-icon icon_tag_alt mr-5"></i> Mycology</a></li>
                                    <li><a href="{{ url('/') }}/category/phycology"><i class="elegant-icon icon_tag_alt mr-5"></i> Phycology</a></li>
                                    <li><a href="{{ url('/') }}/category/parasitology"><i class="elegant-icon icon_tag_alt mr-5"></i> Parasitology</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ url('/') }}/category/molecular-biology"> <i class="elegant-icon icon_tags_alt mr-5"></i> Molecular Biology</a>
                                <ul class="sub-menu text-muted font-medium ">
                                    <li><a href="{{ url('/') }}/category/biochemistry"><i class="elegant-icon icon_tag_alt mr-5"></i> Biochemistry</a></li>
                                    <li><a href="{{ url('/') }}/category/cell-biology"><i class="elegant-icon icon_tag_alt mr-5"></i> Cell Biology</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#"> <i class="elegant-icon icon_tags_alt mr-5"></i> Industrial Microbiology</a>
                                <ul class="sub-menu text-muted font-medium ">
                                    <li><a href="{{ url('/') }}/category/food-microbiology">Food Microbiology  </a></li>
                                    <li class="mr-5"><a href="{{ url('/') }}/category/environmental-microbiology">Environmental Microbiology   </a></li>
                                    <li><a href="{{ url('/') }}/category/agricultural-microbiology">Agricultural Microbiology </a></li>
                                </ul>
                            </li>
                            <li class="current-item"> <a href="{{ url('/') }}/questions">Question's</a></li>
                        </ul>
                        <!--Mobile menu-->
                        <ul id="mobile-menu" class="d-block d-lg-none text-muted">
                            <li>
                                <div>
                                    <form action="{{ route('search') }}" method="post" class="search-header">
                                        @csrf
                                        <div class="input-group w-100">
                                            <input type="text" class="form-control" name="search_text" id="search_text" placeholder="Search Your Thoughts......">
                                            <div class="input-group-append">
                                                <button class="btn btn-search bg-white" type="submit">
                                                    <i class="elegant-icon icon_search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ url('/') }}/category/biotechnology"> <i class="elegant-icon icon_tags_alt <!-- icon_house_alt --> mr-5"></i><b> Biotechnology</b></a>
                                <ul class="sub-menu text-muted font-medium">
                                    <li><a href="{{ url('/') }}/category/biotechnology"><i class="elegant-icon icon_tag_alt mr-5"></i><b> Biotechnology</b></a></li>
                                    <li><a href="{{ url('/') }}/category/bioinformatics"><i class="elegant-icon icon_tag_alt mr-5"></i><b> Bioinformatics</b></a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#"> <i class="elegant-icon icon_tags_alt mr-5"></i><b> Microbiology</b></a>
                                <ul class="sub-menu text-muted font-medium">
                                    <li><a href="{{ url('/') }}/category/virology"><i class="elegant-icon icon_tag_alt mr-5"></i><b> Virology</b></a></li>
                                    <li><a href="{{ url('/') }}/category/bacteriology"><i class="elegant-icon icon_tag_alt mr-5"></i><b> Bacteriology</b></a></li>
                                    <li><a href="{{ url('/') }}/category/mycology"><i class="elegant-icon icon_tag_alt mr-5"></i><b> Mycology</b></a></li>
                                    <li><a href="{{ url('/') }}/category/phycology"><i class="elegant-icon icon_tag_alt mr-5"></i><b> Phycology</b></a></li>
                                    <li><a href="{{ url('/') }}/category/parasitology"><i class="elegant-icon icon_tag_alt mr-5"></i><b> Parasitology</b></a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ url('/') }}category/molecular-biology"> <i class="elegant-icon icon_tags_alt mr-5"></i><b> Molecular Biology</b></a>
                                <ul class="sub-menu text-muted font-medium ">
                                    <li><a href="{{ url('/') }}/category/molecular-biology"> <i class="elegant-icon icon_tag_alt mr-5"></i><b> Molecular Biology</b></a></li>
                                    <li><a href="{{ url('/') }}/category/biochemistry"><i class="elegant-icon icon_tag_alt mr-5"></i><b> Biochemistry</b></a></li>
                                    <li><a href="{{ url('/') }}/category/cell-biology"><i class="elegant-icon icon_tag_alt mr-5"></i><b> Cell Biology</b></a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#"><b><i class="elegant-icon icon_tags_alt mr-5"></i> Industrial Microbiology</b></a>
                                <ul class="sub-menu text-muted font-medium ">
                                    <li><a href="{{ url('/') }}/category/food-microbiology"><i class="elegant-icon icon_tag_alt mr-5"></i><b>Food Microbiology </b></a></li>
                                    <li class="mr-5"><a href="{{ url('/') }}/category/environmental-microbiology"><i class="elegant-icon icon_tag_alt mr-5"></i><b>Environmental Microbiology </b></a></li>
                                    <li><a href="{{ url('/') }}/category/agricultural-microbiology"><i class="elegant-icon icon_tag_alt mr-5"></i><b>Agricultural Microbiology </b></a></li>
                                </ul>
                            </li>
                            <li> <a href="{{ url('/') }}/questions"><b><i class="elegant-icon icon_circle-slelected mr-5"></i> Question's</b></a></li>
                        </ul>
                    </nav>
                </div>
                <div class="float-right header-tools text-muted font-small">
                    <ul class="header-social-network d-inline-block list-inline mr-15">
                        <li class="list-inline-item"><a class="social-icon fb text-xs-center" target="_blank" href="#"><i class="elegant-icon social_facebook"></i></a></li>
                        <li class="list-inline-item"><a class="social-icon tw text-xs-center" target="_blank" href="#"><i class="elegant-icon social_twitter "></i></a></li>
                        <li class="list-inline-item"><a class="social-icon pt text-xs-center" target="_blank" href="#"><i class="elegant-icon social_pinterest "></i></a></li>
                    </ul>
                    <div class="off-canvas-toggle-cover d-inline-block">
                        <div class="off-canvas-toggle hidden d-inline-block" id="off-canvas-toggle">
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </header>
    <!--Start search form-->
    <div class="main-search-form">
        <div class="container">
            <div class=" pt-50 pb-50 ">
                <div class="row mb-20">
                    <div class="col-12 align-self-center main-search-form-cover m-auto">
                        <p class="text-center"><span class="search-text-bg">Search</span></p>
                        <form action="{{ route('search') }}" method="post" class="search-header">
                            @csrf
                            <div class="input-group w-100">
                                <input type="text" class="form-control" name="search_text" id="search_text" placeholder="Search Your Thoughts......">
                                <div class="input-group-append">
                                    <button class="btn btn-search bg-white" type="submit">
                                        <i class="elegant-icon icon_search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('error') }}
    </div>
    @endif

    @yield('content')

    <!-- Footer Start-->
    <footer class="pt-50 pb-20 bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="sidebar-widget wow fadeInUp animated mb-30">
                        <div class="widget-header-2 position-relative mb-30">
                            <h5 class="mt-5 mb-30">About me</h5>
                        </div>
                        <div class="textwidget">
                            <p>
                                If you are curious about the microscopic world or looking for a career in the field of life science, This website will be your most valuable resource to get answers to all your burning questions...
                            </p>
                            <p><strong class="color-black">Follow me</strong><br>
                                <ul class="header-social-network d-inline-block list-inline color-white mb-20">
                                    <li class="list-inline-item"><a class="fb" href="#" target="_blank" title="Facebook"><i class="elegant-icon social_facebook"></i></a></li>
                                    <li class="list-inline-item"><a class="tw" href="#" target="_blank" title="Tweet now"><i class="elegant-icon social_twitter"></i></a></li>
                                    <li class="list-inline-item"><a class="pt" href="#" target="_blank" title="Pin it"><i class="elegant-icon social_pinterest"></i></a></li>
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="sidebar-widget widget_categories wow fadeInUp animated mb-30" data-wow-delay="0.1s">
                        <div class="widget-header-2 position-relative mb-30">
                            <h5 class="mt-5 mb-30">Quick link</h5>
                        </div>
                        <ul class="font-small">
                            <li class="cat-item cat-item-2"><a href="{{ url('/') }}/category/diseases">Diseases</a></li>
                            <li class="cat-item cat-item-4"><a href="{{ url('/') }}/category/culture-media">Culture Media</a></li>
                            <li class="cat-item cat-item-5"><a href="{{ url('/') }}/category/biochemical-test">Biochemical Test</a></li>
                            <li class="cat-item cat-item-6"><a href="{{ url('/') }}/category/instrumentation">Instrumentations</a></li>
                            <li class="cat-item cat-item-7"><a href="{{ url('/') }}/category/microscopy">Microscopy</a></li>
                            <li class="cat-item cat-item-7"><a href="{{ url('/') }}/category/staining">Staining</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="sidebar-widget widget_tagcloud wow fadeInUp animated mb-30" data-wow-delay="0.2s">
                        <div class="widget-header-2 position-relative mb-30">
                            <h5 class="mt-5 mb-30">Tagcloud</h5>
                        </div>
                        <div class="tagcloud mt-50">
                            <a class="tag-cloud-link" href="{{ url('/') }}/category/staining">stain</a>
                            <a class="tag-cloud-link" href="{{ url('/') }}/category/microscopy">microscopy</a>
                            <a class="tag-cloud-link" href="{{ url('/') }}/category/virology">virus</a>
                            <a class="tag-cloud-link" href="{{ url('/') }}/category/biotechnology">biotech</a>
                            <a class="tag-cloud-link" href="{{ url('/') }}/category/diseases">diseases</a>
                            <a class="tag-cloud-link" href="{{ url('/') }}/category/cell-biology">cell</a>
                            <a class="tag-cloud-link" href="{{ url('/') }}/category/bacteriology">bacteria</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="sidebar-widget widget_newsletter wow fadeInUp animated mb-30" data-wow-delay="0.3s">
                        <div class="widget-header-2 position-relative mb-30">
                            <h5 class="mt-5 mb-30">Newsletter</h5>
                        </div>
                        <div class="newsletter">
                            <p class="font-medium">Subscribe to our newsletter and get our newest updates right on your inbox.</p>
                            <form action="{{ route('subscribe') }}" method="post" class="input-group form-subcriber mt-30 d-flex" autocomplete="off">
                                @csrf
                                <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror bg-white font-small" placeholder="Enter your email">
                                <button class="btn bg-primary text-white" type="submit">Subscribe</button>
                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <label class="mt-20"> <input class="mr-5" name="name" type="checkbox" value="1" required=""> I agree to the <a href="#" target="_blank">terms &amp; conditions</a> </label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copy-right pt-30 mt-20 wow fadeInUp animated">
                <p class="float-md-left font-small text-muted">© 2023, Examtube - Life Secience Notes </p>
                <p class="float-md-right font-small text-muted">
                    Design by <a href="#" target="_blank">Examtube</a> | All rights reserved
                </p>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <div class="dark-mark"></div>
    <!-- Vendor JS-->
    <script src="{{ url('public/f_assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/jquery.slicknav.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/wow.min.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/jquery.ticker.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/jquery.vticker-min.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/jquery.magnific-popup.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/jquery.sticky.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ url('public/f_assets/js/vendor/jquery.theia.sticky.js') }}"></script>
    <!-- NewsBoard JS -->
    <script src="{{ url('public/f_assets/js/main.js') }}"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('img').attr('loading', 'lazy');
        });
    </script>

    @yield('scripts')
    
</body>

<!-- Design by Examtube| © 2023All rights reserved -->

</html>