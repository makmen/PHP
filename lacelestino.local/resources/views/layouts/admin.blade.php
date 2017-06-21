<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie"lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html id="ie7"  class="ie"lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html id="ie8"  class="ie"lang="en-US">
<![endif]-->
<!--[if IE 9]>
<html id="ie9"  class="ie"lang="en-US">
<![endif]-->
<!--[if gt IE 9]>
<html class="ie"lang="en-US">
<![endif]-->
<!--[if !IE]>
<html lang="en-US">
<![endif]-->

<!-- START HEAD -->
<head>
    <meta charset="UTF-8" />

    <!-- this line will appear only if the website is visited with an iPad -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

    <title>{{ $title or 'Celestino' }}</title>
    <meta name="keywords" content="{{ isset($keywords) ? $keywords : '' }}" />
    <meta name="description" content="{{ isset($meta_desc) ? $meta_desc : '' }}" />

    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('style.css') }}" />
        
    <link rel='stylesheet' id='custom-css'  href='{{ asset('css/custom.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='google-fonts-css'  href='http://fonts.googleapis.com/css?family=Oswald%7CDroid+Sans%7CPlayfair+Display%7COpen+Sans+Condensed:300,400,800%3A300%7CRokkitt%7CShadows+Into+Light%7CMaven+Pro:400,700%7CAbel%7CMontez' type='text/css' media='all' />
    <link rel='stylesheet' id='responsive-css'  href='{{ asset('css/responsive.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='tipsy-css'  href='{{ asset('css/tipsy.css') }}' type='text/css' media='all' />

    <link rel='stylesheet' id='fonts-css'  href='{{ asset('css/font-awesome.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='full-descriptor-css'  href='{{ asset('css/styleportfolio.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='slide-details-css'  href='{{ asset('css/slide-detail.css') }}' type='text/css' media='all' />

    <link rel='stylesheet' id='flex-css'  href='{{ asset('css/sliders/slider.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='flexslider-css'  href='{{ asset('css/sliders/flexslider.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='flexslider-elegant-css'  href='{{ asset('css/sliders/flexsliderelegant.css') }}' type='text/css' media='all' />

    
    <link rel='stylesheet' id='shortcode-css'  href='{{ asset('css/shortcodes.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='colorbox-css'  href='{{ asset('css/colorbox.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='custom-button-mfast-3-css'  href='{{ asset('css/buttons/mfast-3.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='custom-button-mfast-3-css'  href='{{ asset('css/contact_form.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='custom-button-mfast-3-css'  href='{{ asset('css/blogstyle.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='custom-button-mfast-3-css'  href='{{ asset('css/comment.css') }}' type='text/css' media='all' />

    
    <!-- [favicon] begin -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <!-- [favicon] end -->

    <!-- Touch icons more info: http://mathiasbynens.be/notes/touch-icons -->
    <!-- For iPad3 with retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x.png" />
    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x.png" />
    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x.png">
    <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-57x.png" />
    

    <link rel='stylesheet' id='thickbox-css'  href='{{ asset('js/thickbox/thickbox.css') }}' type='text/css' media='all' />
    <script type='text/javascript' src='{{ asset('js/jquery/jquery.js') }}'></script>
    
    <script type="text/javascript" src="{{ asset( 'js/ckeditor/ckeditor.js') }}"></script>
    
</head>
<!-- END HEAD -->

<!-- START BODY -->
<body class="home page no_js responsive stretched">

    <!-- START BG SHADOW -->
    <div class="bg-shadow">

        <!-- START WRAPPER -->
        <div id="wrapper" class="container group">
            <!-- START TOP BAR -->

            <!-- START TOP BAR -->
            <div id="topbar">
                <div class="container">
                    <div class="row">
                        <div id="last-tweets-3" class="widget-first span6 widget last-tweets">
                            <h3>Last Tweets</h3>
                            <div class="list-tweets-3"></div>

                            <script type="text/javascript">
                                jQuery(function ($) {
                                    $('#last-tweets-3 .list-tweets-3').tweetable({
                                        listClass: 'tweets-widget-3',
                                        username: 'YIW',
                                        time: false,
                                        limit: 3,
                                        replies: false
                                    });
                                });
                            </script>

                        </div>

                        <div id="text-8" class=" widget-last span6 widget widget_text">
                            <div class="textwidget">
                                <a href="# " class="socials-small facebook-small" title="Facebook"  >facebook</a>

                                <a href="#" class="socials-small rss-small" title="Rss"  >rss</a>

                                <a href="#" class="socials-small twitter-small" title="Twitter"  >twitter</a>

                                <a href="#" class="socials-small google-small" title="Google"  >google</a>

                                <a href="#" class="socials-small linkedin-small" title="Linkedin"  >linkedin</a>

                                <a href="#" class="socials-small pinterest-small" title="Pinterest"  >pinterest</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                jQuery(function ($) {
                    var twitterSlider = function () {
                        $('#topbar .last-tweets ul').addClass('slides');
                        $('#topbar .last-tweets').flexslider({
                            animation: "fade",
                            slideshowSpeed: 5 * 1000,
                            animationDuration: 700,
                            directionNav: false,
                            controlNav: false,
                            keyboardNav: false
                        });
                    };
                    $('#topbar .last-tweets > div').bind('tweetable_loaded', function () {
                        twitterSlider();
                    });
                });
            </script>
            <!-- END TOP BAR -->

            <!-- START HEADER -->
            <div id="header" class="group">
                <div class="group container">
                    <div class="row">
                        <div class="span12">

                            <div class="row">
                                <!-- START LOGO -->
                                <div id="logo" class="span4 group">
                                    <a id="logo-img" href="{{ route('home') }}" title="celestino">
                                        <img src="{{ asset('images/celestino1.png') }}" title="celestino" alt="celestino" />
                                    </a>

                                    <p id="tagline">only for creative minds.</p>
                                </div>
                                <!-- END LOGO -->
                                <div id="menu" class="span8 group">
                                    
                                    <!-- START MAIN NAVIGATION -->
                                        @yield('navigation')
                                    <!-- END MAIN NAVIGATION -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="border-header"></div>
            </div>
            <!-- END HEADER -->

            <!-- START PAGE META -->
                @yield('adminNavigation')
            <!-- END PAGE META -->

            @if (session('status'))
                <div class="box success-box">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="box error-box">
                    {{ session('error') }}
                </div>
            @endif

            <!-- START PRIMARY -->
                @yield('content')
            <!-- END PRIMARY -->

            <!-- START COPYRIGHT -->
            <div id="copyright">
                <div class="container">
                    <div class="row">
                        <div class="left span6">
                            <a href="http://yithemes.com/?ddownload=60426&amp;ap_id=celestino-html"><strong>Download the free version for Wordpress</strong></a>
                        </div>
                        <div class="right span6">
                            <p>Powered by
                                <a href="http://yithemes.com/" title="free themes wordpress">
                                    <strong>Your Inspiration Themes</strong>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END COPYRIGHT -->

        </div>
        <!-- END WRAPPER -->

    </div>
    <!-- END BG SHADOW -->

    <script type='text/javascript' src='{{ asset('js/jquery.colorbox-min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/jquery.flexslider-min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/jquery.tweetable.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/jquery.superfish.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/jquery.filterable.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/jquery.tipsy.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/responsive.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/jquery.mobilemenu.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/shortcodes.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/jquery/jquery.masonry.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/jquery.custom.js') }}'></script>

</body>
<!-- END BODY -->
</html>