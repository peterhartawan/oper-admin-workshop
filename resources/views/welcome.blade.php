<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Oper Cms</title>

        <meta name="description" content="Oper Cms">
        <meta name="author" content="Oper">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Oper Cms">
        <meta property="og:site_name" content="Dashmix">
        <meta property="og:description" content="Oper Cms">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Fonts and Dashmix framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ asset('/template/css/dashmix.css') }}" />
        <link rel="stylesheet" href="{{ asset('/template/css/themes/xplay.css') }}" />
        <link rel="stylesheet" href="{{ asset('/template/css/loader.css') }}" />

        <!-- Scripts -->
        <script src="{{ asset('/template/js/dashmix.core.min.js') }}"></script>
        <script src="{{ asset('/template/js/dashmix.app.min.js') }}"></script>
        <script src="{{ asset('/template/js/pages/op_auth_signin.min.js') }}"></script>
        <script src="{{ asset('/template/js/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/template/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
        <script src="{{ asset('/template/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script>jQuery(function(){ Dashmix.helpers(['notify']); });</script>
    </head>
    <body>
        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-dark'                              Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header


        Footer

            ''                                          Static Footer if no class is added
            'page-footer-fixed'                         Fixed Footer (please have in mind that the footer has a specific height when is fixed)

        HEADER STYLE

            ''                                          Classic Header style if no class is added
            'page-header-dark'                          Dark themed Header
            'page-header-glass'                         Light themed Header with transparency by default
                                                        (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
            'page-header-glass page-header-dark'         Dark themed Header with transparency by default
                                                        (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->

        @include('template.function.loader')

        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('{{ asset('template/media/photos/photo15@2x.jpg') }}');">
                    <div class="row justify-content-center bg-primary-op">
                        <!-- Meta Info Section -->
                        <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
                            <div class="p-3">
                                <p class="display-4 font-w700 text-white mb-3">
                                    Welcome to the future
                                </p>
                                <p class="font-size-lg font-w600 text-white-75 mb-3">
                                    Copyright &copy; <span class="js-year-copy">2018</span>
                                </p>
                                <a href="/login">
                                    <button type="button" class="btn btn-block btn-light" onclick="loaderOn()">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Log In
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- END Meta Info Section -->
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
        
        @if(Session::get('error') != null)
            <script type="text/javascript">
                $(document).ready(function(){
                    Dashmix.helpers('notify', {
                        type: 'danger',
                        icon: 'fa fa-times mr-1',
                        message: "{{ Session::get('error') }}",
                        allow_dismiss: true,
                        timer: 15000
                    });
                });
            </script>
        @endif
    </body>
</html>