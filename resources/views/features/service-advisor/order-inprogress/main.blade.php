@extends('template.layout')

@section('js_before')

@endsection
@section('css_before')

@endsection
@section('css_after')

@endsection

@section('title', 'Service Advisor - Order InProgress')

@section('content')
    <!-- Statistics -->
    <div class="row">
        <!-- Wallet -->
        <div class="col-lg-6 invisible" data-toggle="appear">
            <div class="block block-bordered">
                <div class="block-content">
                    <div class="px-sm-3 pt-sm-3 clearfix" style="min-height: 260px;">
                        <i class="fa fa-chart-line fa-2x text-gray-light float-right"></i>
                        <p class="display-4 text-black font-w300 mb-2">
                            4.860 <span class="font-size-h5 font-w600 text-muted">USD</span>
                        </p>
                        <p class="text-muted w-75">
                            You had <strong>15</strong> orders today and <strong>12</strong> orders yesterday. You seem to be doing great, so keep it up!
                        </p>
                        <a class="btn btn-hero-sm btn-outline-primary btn-square mr-1 mb-1" href="javascript:void(0)">
                            <i class="far fa-money-bill-alt fa-fw mr-1"></i> Latest Orders
                        </a>
                        <a class="btn btn-hero-sm btn-outline-primary btn-square mr-1 mb-1" href="javascript:void(0)">
                            <i class="far fa-user fa-fw mr-1"></i> Account
                        </a>
                    </div>
                </div>
                <div class="block-content p-1 overflow-hidden">
                    <!-- Sparkline Container -->
                    <span class="js-sparkline" data-type="line"
                          data-points="[340,390,360,420,385,366,440,470]"
                          data-width="100%"
                          data-height="189px"
                          data-chart-range-min="320"
                          data-fill-color="rgba(6,101,208,.1)"
                          data-spot-color="transparent"
                          data-min-spot-color="transparent"
                          data-max-spot-color="transparent"
                          data-highlight-spot-color="#0665d0"
                          data-highlight-line-color="#0665d0"
                          data-tooltip-prefix="$"></span>
                </div>
            </div>
        </div>
        <!-- Wallet -->

        <!-- Various Stats -->
        <div class="col-lg-6 invisible" data-toggle="appear">
            <!-- Weekly Orders -->
            <div class="block block-bordered mb-lg-2">
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <div class="ml-3">
                        <p class="font-size-h2 font-w300 text-black mb-0">
                            160
                        </p>
                        <a class="link-fx font-size-sm font-w600 text-muted text-uppercase mb-0" href="javascript:void(0)">
                            Orders
                        </a>
                    </div>
                    <div>
                        <!-- Sparkline Container -->
                        <span class="js-sparkline" data-type="line"
                              data-points="[15,18,22,19,16,21,19]"
                              data-width="100px"
                              data-height="60px"
                              data-line-color="#3c90df"
                              data-fill-color="rgba(60,144,223,.1)"
                              data-spot-color="transparent"
                              data-min-spot-color="transparent"
                              data-max-spot-color="transparent"
                              data-highlight-spot-color="#3c90df"
                              data-highlight-line-color="#3c90df"
                              data-tooltip-suffix="Orders"></span>
                    </div>
                </div>
            </div>
            <!-- END Weekly Orders -->

            <!-- Weekly Visits -->
            <div class="block block-bordered mb-lg-2">
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <div class="ml-3">
                        <p class="font-size-h2 font-w300 text-black mb-0">
                            3.670
                        </p>
                        <a class="link-fx font-size-sm font-w600 text-muted text-uppercase mb-0" href="javascript:void(0)">
                            Visits
                        </a>
                    </div>
                    <div>
                        <!-- Sparkline Container -->
                        <span class="js-sparkline" data-type="line"
                              data-points="[352,480,698,758,523,625,780]"
                              data-width="100px"
                              data-height="60px"
                              data-line-color="#689550"
                              data-fill-color="rgba(104,149,80,.1)"
                              data-spot-color="transparent"
                              data-min-spot-color="transparent"
                              data-max-spot-color="transparent"
                              data-highlight-spot-color="#689550"
                              data-highlight-line-color="#689550"
                              data-tooltip-suffix="Visits"></span>
                    </div>
                </div>
            </div>
            <!-- END Weekly Visits -->

            <!-- Weekly Followers -->
            <div class="block block-bordered mb-lg-2">
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <div class="ml-3">
                        <p class="font-size-h2 font-w300 text-black mb-0">
                            630
                        </p>
                        <a class="link-fx font-size-sm font-w600 text-muted text-uppercase mb-0" href="javascript:void(0)">
                            Followers
                        </a>
                    </div>
                    <div>
                        <!-- Sparkline Container -->
                        <span class="js-sparkline" data-type="line"
                              data-points="[89,78,115,98,82,136,112]"
                              data-width="100px"
                              data-height="60px"
                              data-line-color="#ffb119"
                              data-fill-color="rgba(255,177,25,.1)"
                              data-spot-color="transparent"
                              data-min-spot-color="transparent"
                              data-max-spot-color="transparent"
                              data-highlight-spot-color="#ffb119"
                              data-highlight-line-color="#ffb119"
                              data-tooltip-suffix="Followers"></span>
                    </div>
                </div>
            </div>
            <!-- END Weekly Followers -->

            <!-- Weekly Tickets -->
            <div class="block block-bordered mb-lg-2">
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <div class="ml-3">
                        <p class="font-size-h2 font-w300 text-black mb-0">
                            32
                        </p>
                        <a class="link-fx font-size-sm font-w600 text-muted text-uppercase mb-0" href="javascript:void(0)">
                            Tickets
                        </a>
                    </div>
                    <div>
                        <!-- Sparkline Container -->
                        <span class="js-sparkline" data-type="line"
                              data-points="[1,6,3,5,4,8,2]"
                              data-width="100px"
                              data-height="60px"
                              data-line-color="#e04f1a"
                              data-fill-color="rgba(224,79,26,.1)"
                              data-spot-color="transparent"
                              data-min-spot-color="transparent"
                              data-max-spot-color="transparent"
                              data-highlight-spot-color="#e04f1a"
                              data-highlight-line-color="#e04f1a"
                              data-tooltip-suffix="Tickets"></span>
                    </div>
                </div>
            </div>
            <!-- END Weekly Tickets -->
        </div>
        <!-- END Various Stats -->
    </div>
    <!-- END Statistics -->
@endsection

@section('modal')

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('/template/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Page JS Helpers (jQuery Sparkline Plugin) -->
    <script>jQuery(function(){ Dashmix.helpers('sparkline'); });</script>
@endsection