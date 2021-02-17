<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Citra Shop Store</title>

        <meta name="description" content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content={{ csrf_token() }} />

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework">
        <meta property="og:site_name" content="Dashmix">
        <meta property="og:description" content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Stylesheets -->
        @yield('css_before')
        <!-- Fonts and Dashmix framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ asset('/template/css/dashmix.css') }}" />
        <link rel="stylesheet" href="{{ asset('/template/css/themes/xplay.css') }}" />
        <link rel="stylesheet" href="{{ asset('/template/css/loader.css') }}" />
        
        @yield('css_after')

        <!-- Scripts -->
        <script src="{{ asset('/template/js/dashmix.core.min.js') }}"></script>
        <script src="{{ asset('/template/js/dashmix.app.min.js') }}"></script>
        <script src="{{ asset('/template/js/pages/op_auth_signin.min.js') }}"></script>
        <script src="{{ asset('/template/js/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/template/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
        <script src="{{ asset('/template/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script>jQuery(function(){ Dashmix.helpers(['notify']); });</script>

        @yield('js_before')
        
        <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script>

    </head>
    <body>
        <!-- Loader -->
            @include('template.function.loader')
        <!-- End Loader -->

        <!-- Page Container -->
        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Hero -->
                <div class="bg-body-light border-top border-bottom">
                    <div class="content content-full py-1">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 class="flex-sm-fill font-size-sm text-uppercase font-w700 mt-2 mb-0 mb-sm-2">
                                <i class="fa fa-angle-right fa-fw text-primary"></i> @yield('title')
                            </h1>
                            <nav class="flex-sm-00-auto ml-sm-3 font-size-sm">
                                <!-- User Dropdown -->
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-fw fa-user-circle"></i>
                                        <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                        <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                                            <a href="javascript:void(0)" onclick="$('#view-profile-modal').modal('show')">    
                                                <img class="img-avatar img-avatar48 img-avatar-thumb" 
                                                    src="{{ asset("/template/media/avatars/avatar10.jpg") }}" 
                                                    alt="">
                                            </a>
                                            <div class="pt-2">
                                                <a class="text-white font-w600" 
                                                    href="javascript:void(0)"
                                                    onclick="$('#view-profile-modal').modal('show')">
                                                        {{ Session::get('user')->username }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="p-2">
                                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#edit-profile-modal">
                                                <i class="fa fa-fw fa-user-cog mr-1"></i> edit Profile
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#change-password-modal">
                                                <i class="fa fa-fw fa-user-edit mr-1"></i> Change Password
                                            </a>
                                            <div role="separator" class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/logout" onclick="loaderOn()">
                                                <i class="fa fa-fw fa-arrow-alt-circle-left mr-1"></i> Log Out
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END User Dropdown -->
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- END Hero -->

                <!-- Page Content -->
                <div class="content">
                    <!-- Quick Navigation -->
                    <a class="block block-bordered text-center d-sm-none" href="javascript:void(0)" data-toggle="class-toggle" data-target=".js-classic-nav" data-class="d-none d-sm-block">
                        <div class="block-content block-content-full text-center">
                            <div class="font-w600 text-uppercase">
                                <i class="fa fa-bars mr-1"></i> Navigation
                            </div>
                        </div>
                    </a>
                    <div class="block block-bordered js-classic-nav d-none d-sm-block">
                        <div class="block-content block-content-full">
                            <div class="row no-gutters border">
                                @foreach (Session::get('menus') as $menu)
                                    <div class="col-sm-6 col-xl-{{ floor(12/count(Session::get('menus'))) }} invisible" data-toggle="appear">
                                        <a class="block block-bordered block-link-pop text-center mb-0 @if ( strpos($menu->menu_link, Request::segment(1)) ) bg-gray-lighter @endif" href="{{ $menu->menu_link }}" onclick="loaderOn()">
                                            <div class="block-content block-content-full text-center">
                                                <i class="{{ $menu->menu_icon }} fa-2x text-primary d-none d-sm-inline-block mb-3"></i>
                                                <div class="font-w600 text-uppercase">{{ $menu->menu_name }}</div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="block block-bordered js-classic-nav d-none d-sm-block">
                        <div class="block-content block-content-full">
                            <div class="row no-gutters border">
                                @foreach (Session::get('menus') as $menu)
                                    @if (strpos($menu->menu_link, Request::segment(1)))
                                        @foreach ($menu->children_menus as $subMenu)
                                            <div class="col-sm-6 col-xl-{{ floor(12/count($menu->children_menus)) }} invisible" data-toggle="appear">
                                                <a class="block block-bordered block-link-pop text-center mb-0 @if ( strpos($subMenu->menu_link, Request::segment(2)) ) bg-gray-lighter @endif" href="{{ $subMenu->menu_link }}" onclick="loaderOn()">
                                                    <div class="block-content block-content-full text-center">
                                                        <i class="{{ $subMenu->menu_icon }} fa-2x text-primary d-none d-sm-inline-block mb-3"></i>
                                                        <div class="font-w600 text-uppercase">{{ $subMenu->menu_name }}</div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- END Quick Navigation -->

                    @yield('content')
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-body">
                <div class="content py-0">
                    <div class="row font-size-sm">
                        <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-right">
                            <p class="font-w600">Copyright Citra Shop</a> &copy; <span data-toggle="year-copy">2020</span> All Right Reserved
                        </div>
                        <div class="col-sm-6 order-sm-1 text-center text-sm-left"></div>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Modal -->
        @include('template.function.modal')
        @yield('modal')
        <!-- End Modal -->

        @yield('js_after')
        
    </body>
</html>