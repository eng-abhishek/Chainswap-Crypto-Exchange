<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     @yield('meta_detail')
    <link rel="shortcut icon" href="{{asset('assets/frontend/images/logo/favicon.ico')}}" type="image/png">
        <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    @yield('extra_meta')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/vendors/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/partner-slider.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/how_it_works.css')}}">
    <script type="text/javascript" src="https://widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
    <script type="text/javascript"> window.$crisp=[];window.CRISP_WEBSITE_ID="22e97f86-a60c-4053-9ae9-f43400add888";(function(){ d=document;s=d.createElement("script"); s.src="https://client.crisp.chat/l.js"; s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})(); </script>
</head>
<body class="bg-main">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-main bg-theme">
                        <div class="row justify-content-center align-items-center">        
                            <div class="col-lg-2 col-6">
                                <div class="brand-logo">
                                    <a href="{{route('home')}}" title="Logo">
                                        <img src="{{asset('assets/frontend/images/logo/chainswap.png')}}" class="img-fluid" alt="Logo">
                                    {{--<strong style="color: white;">ChainSwap</strong>--}}
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-10 col-6">
                                <input type="checkbox" id="main_nav" class="d-none">
                                <label for="main_nav" class="nav-toggle d-lg-none d-block">
                                    <span class="menu-bar menu-bar1"></span>
                                    <span class="menu-bar menu-bar2"></span>
                                    <span class="menu-bar menu-bar3"></span>
                                </label>
                                <ul class="nav justify-content-lg-end flex-lg-row flex-column main-nav">
                                    
                                    <li class="nav-item">
                                        <a class="nav-link {{(Route::currentRouteName() == 'home')?'active':''}}" href="{{route('home')}}" title="{{__('Home')}}">{{__('Home')}}</a>
                                    </li>
                                     <li class="nav-item">
                                        <a class="nav-link {{(Route::currentRouteName() == 'exchange')?'active':''}}" href="{{route('exchange')}}" title="{{__('Exchange')}}">{{__('Exchange')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{(Route::currentRouteName() == 'about')?'active':''}}" href="{{route('about')}}" title="{{__('About Us')}}">{{__('About Us')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{(Route::currentRouteName() == 'history')?'active':''}}" href="{{route('history')}}" title="{{__('History')}}">{{__('History')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{(Route::currentRouteName() == 'contact-us')?'active':''}}" href="{{route('contact-us')}}" title="{{__('Contact')}}">{{__('Contact')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{(Route::currentRouteName() == 'how-it-works')?'active':''}}" href="{{route('how-it-works')}}" title="{{__('How it works')}}">{{__('How it works')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{(Route::currentRouteName() == 'affiliate')?'active':''}}" href="{{route('affiliate')}}" title="Affiliate Program">Affiliate Program</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>