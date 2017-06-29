<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title> {{ $title or 'Santana' }}</title>
        <meta name="description" content="{{ isset($metaDescription) ? $metaDescription : '' }}" />
        <meta name="keywords" content="{{ isset($keywords) ? $keywords : '' }}" />
        <meta name="robots" content="INDEX,FOLLOW" />

        <link rel="icon" href="#" type="image/x-icon" />
        <link rel="shortcut icon" href="#" type="image/x-icon" />

        <!-- CSS =====================================================================================-->
        <link href='http://fonts.googleapis.com/css?family=Telex' rel='stylesheet' type='text/css' />

        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/skin.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/cloud-zoom.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/light_box.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/mix.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/banner.css') }}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/magicat.css') }}" media="all" />
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}" media="all" />
        
        <!-- Scripts =====================================================================================-->
        <script type="text/javascript" src="{{ asset('js/prototype.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-1.6.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/menu.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/banner_pack.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/light_box.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/cloud-zoom.1.0.2.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.jcarousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.mix.js') }}"></script>
        
    </head>
    <body id="bg_color" class=" cms-index-index cms-home">
        <!--START OF WRAPPER-->
        <div class="wrapper">
            
            <div class="page"> 

                <!--START OF HEADER-->
                    @include('index.header')
                <!--END OF HEADER--> 

                <!--START OF MAIN CONTENT-->
                    @yield('content')
                <!--END OF MAIN CONTENT-->  

                <!--START OF FOOTER-->
                    @include('index.footer')
                <!--END OF FOOTER-->
                
            </div>
            
            <!--Minicart JS--> 
            <script type="text/javascript">
                var minicart_timer;
                jQuery(".trigger-minicart").hover(function () {
                    jQuery("#minicart").slideDown();
                });
                jQuery("#minicart").mouseleave(function () {
                    jQuery("#minicart").slideUp();
                });
                jQuery("#minicart").hover(function () {
                    clearTimeout(minicart_timer);
                });
                jQuery(document).ready(function () {
                    jQuery('.pagebox_btn').click(function () {
                        if (parseInt(jQuery('.page_pan').css('left')) < 0)
                        {
                            jQuery('.page_pan').animate({left: '0'}, 600, 'easeOutQuint');
                        } else {
                            jQuery('.page_pan').animate({left: '-100px'}, 600, 'easeOutQuint');
                        }
                    });
                });
            </script>
        </div>
        
        <!--pages box-->
            @include('index.pages_menu')
        <!--end pages box-->
        
        
        <div class="wrap_result"></div>

        
        <!--END OF WRAPPER-->
        
    </body>
</html>