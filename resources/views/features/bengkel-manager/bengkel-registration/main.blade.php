@extends('template.layout')

@section('js_before')
<!-- This API Google must be loaded first -->
<script defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_APP_KEY') }}&libraries=places&callback=initMap"></script>
    <script type="text/javascript" src="{{ asset('template/js/custom/infinity-scrolling.js') }}"></script>
    <script type="text/javascript">
        //API Hit Setting
        var page = 1;
        var perPage = 10;
        var endOfRequest = false;
    </script>
@endsection

@section('css_before')

@endsection

@section('css_after')

@endsection

@section('title', 'Bengkel Manager - Bengkel Registration')

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <select id="type" class="btn btn-primary" onchange="changeType(this.value)">
                            <option value="bengkel_name">Name</option>
                            <option value="bengkel_tipe">Type</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" id="search" placeholder="Search">
                    <select class="form-control d-none" id="search-select">
                        <option value="">Please Select</option>
                        <option value="1">Bengkel Resmi</option>
                        <option value="2">Bengkel Umum</option>
                    </select>
                    <div class="input-group-append mr-2">
                        <button type="button" class="btn btn-primary" onclick="search()">
                            <i class="fa fa-search mr-1"></i>
                        </button>
                    </div>
                    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#brand-modal">
                        <i class="fa far-fw fa-plus mr-1"></i> Create Brand
                    </button>
                    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#create-modal">
                        <i class="fa far-fw fa-plus mr-1"></i> Create Bengkel
                    </button>
                </div>
            </div>

            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="mb-0">{{Session::get('success')}}</p>
                </div>
            @elseif (Session::has('error'))
                <div class="alert alert-danger alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="mb-0">{{Session::get('error')}}</p>
                </div>
            @endif

            <div id="wrapper" style="height: 300px; overflow-y: scroll;" class="table-responsive">
                <table id="allowance-table" class="table table-bordered table-striped table-vcenter display nowrap ">
                    <thead class="text-center">
                        <th>Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="content" class="text-center">

                    </tbody>
                </table>
            </div>
            <br>
        </div>
    </div>
@endsection

@section('modal')
    @include('features.bengkel-manager.bengkel-registration.function.modal')
@endsection

@section('js_after')
    <script type='text/javascript'>

        //global
        let searchValue = "";
        let filter = "";

        $(document).ready(function() {
            loadTable();
        });

        function loadTable(){
            page = 1;
            endOfRequest = false;

            $('#content').empty();

            loaderOn();

            $.ajax({
                "type": "GET",
                "url": "/bengkel-manager/bengkel-registration/pagination",
                "data": {
                    page: page,
                    size: perPage,
                    key: filter,
                    value: searchValue
                },
                "dataType": "html",
                success: function(e) {
                    $('#content').append(e);
                    loaderOff();
                },
                error: function(e){
                    alert("Connection to system is error! Please contact system administrator!");
                    loaderOff();
                }
            });
        }

        infinityScroll("wrapper",
            "content",
            "GET",
            "/bengkel-manager/bengkel-registration/pagination",
            "html",
            {
                "page": page+1,
                "size": perPage,
                "key": filter,
                "value": searchValue
            },
            function(){
                if(!$('#end-of-content').length){
                    loaderOn();
                }
            },
            function(){
                page = page+1;
            },
            function(){
                return {
                    "param": {
                        "page": page+1,
                        "size": perPage
                    },
                    "endOfRequest": endOfRequest
                }
            },
            function(success){
                if(!$('#end-of-content').length){
                    loaderOff();

                    $('#content').append(success);
                }
            },
            function(xhr, status, error){
                loaderOff();

                if(xhr.status === 404){
                    customSwal(xhr.status+ " - " + xhr.statusText, 'Requested URL is not found!');
                }else{
                    customSwal(xhr.status+ " - " + xhr.statusText, "Connection to system is error! Please contact system administrator!");
                }
            },
            endOfRequest
        );

        function changeType(val) {
            $('#search').val('');
            $('#search-select').val('');
            switch (val) {
                case "bengkel_name":
                    $('#search').removeClass('d-none');
                    $('#search-select').addClass('d-none');
                    searchField = $('#search');
                    break;

                case "bengkel_tipe":
                    $('#search').addClass('d-none');
                    $('#search-select').removeClass('d-none');
                    searchField = $('#search-select');
                    break;
            }
        }

        function search() {
            filter = $("#type").val();
            if(filter == "bengkel_tipe") {
                searchValue = $("#search-select").val();
            } else {
                searchValue = $("#search").val();
            }

            loadTable();
        }

        function detailView(id) {
            loaderOn();
            $.ajax({
                url: '/bengkel-manager/bengkel-registration/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(rspn) {
                    $('#view-form').find('[name="name"]').val(rspn.bengkel_name);
                    $('#view-form').find('[name="address"]').val(rspn.bengkel_alamat);
                    $('#view-form').find('[name="type"]').val(rspn.bengkel_tipe);
                    $('#view-form').find('[name="otUsername"]').val(rspn.oper_task_username);
                    $('#status-form').find('[name="id"]').val(rspn.id);
                    $('#view-form').find('[name="otUri"]').val(rspn.oper_task_uri);
                    $('#view-img').attr('src', rspn.workshop_picture);
                    $('#view-form').find('[name="otPickupId"]').val(rspn.pickup_template_id);
                    $('#view-form').find('[name="otDeliveryId"]').val(rspn.delivery_template_id);

                    if (rspn.bengkel_status) {
                        $('#status-active').removeClass('d-none');
                        $('#status-suspend').addClass('d-none');
                        $('#update-status-active').addClass('d-none');
                        $('#update-status-suspend').removeClass('d-none');
                    } else {
                        $('#status-active').addClass('d-none');
                        $('#status-suspend').removeClass('d-none');
                        $('#update-status-active').removeClass('d-none');
                        $('#update-status-suspend').addClass('d-none');
                    }

                    loaderOff();
                    $('#view-modal').modal('show');
                },
                error: function(err) {
                    loaderOff();
                },
            });
        }

        function updateView(id) {
            loaderOn();
            $.ajax({
                url: '/bengkel-manager/bengkel-registration/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(rspn) {
                    $('#update-form').find('[name="name"]').val(rspn.bengkel_name);
                    $('#update-form').find('[name="address"]').val(rspn.bengkel_alamat);
                    $('#update-form').find('[name="type"]').val(rspn.bengkel_tipe);
                    $('#update-form').find('[name="id"]').val(rspn.id);
                    $('#update-form').find('[name="longitude"]').val(rspn.bengkel_long);
                    $('#update-form').find('[name="latitude"]').val(rspn.bengkel_lat);
                    $('#update-form').find('[name="otUsername"]').val(rspn.oper_task_username);
                    $('#update-form').find('[name="otUri"]').val(rspn.oper_task_uri);
                    $('#update-form').find('[name="otPassword"]').val("");
                    $('#update-form').find('[name="otPickupId"]').val(rspn.pickup_template_id);
                    $('#update-form').find('[name="otDeliveryId"]').val(rspn.delivery_template_id);
                    $('#update-longitude').trigger( "change" );

                    loaderOff();
                    $('#update-modal').modal('show');
                },
                error: function(err) {
                    loaderOff();
                },
            });
        }

        function deleteView(id, name) {
            $('#delete-form').find('[name="id"]').val(id);
            $('#delete-name').text(name);
            $('#delete-modal').modal('show');
        }

        function defineMaps(marker_poi, map_poi, latElement, longElement) {
            google.maps.event.addListener(map_poi, "click", function(event) {
                // get lat/lon of click
                var clickLat = event.latLng.lat();
                var clickLon = event.latLng.lng();

                $('#'+latElement).val(clickLat.toFixed(15));
                $('#'+latElement).valid();
                $('#'+longElement).val(clickLon.toFixed(15));
                $('#'+longElement).valid();

                marker_poi.setPosition(event.latLng);
            });

            google.maps.event.addListener(marker_poi, "dragend", function(event) {
                // get lat/lon of click
                var clickLat = event.latLng.lat();
                var clickLon = event.latLng.lng();

                $('#'+latElement).val(clickLat.toFixed(15));
                $('#'+latElement).valid();
                $('#'+longElement).val(clickLon.toFixed(15));
                $('#'+longElement).valid();
            });
        }

    </script>

    <script type="text/javascript">
        // Global Variable
            // for data maps
            var create_marker_poi;
            var create_map_poi;
            var update_marker_poi;
            var update_map_poi;

        $(function() {
            // Initialize Maps For Create
            var create_myLatlng = new google.maps.LatLng(-6.161287494589915, 106.762708119932597);
            var myOptions = {
                zoom:17,
                center: create_myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            create_map_poi = new google.maps.Map(document.getElementById("create-maps"), myOptions);

            create_marker_poi = new google.maps.Marker({
                position: create_myLatlng,
                draggable: true,
                map: create_map_poi
            });

            defineMaps(create_marker_poi, create_map_poi, 'create-latitude', 'create-longitude');

            $('#create-longitude, #create-latitude').on('change', function() {
                var lat = $('#create-latitude');
                var lng = $('#create-longitude');
                lat.val(lat.val());
                lng.val(lng.val());

                var latLngValue = {
                    lat: parseFloat(lat.val()),
                    lng: parseFloat(lng.val())
                };

                create_map_poi.setCenter(latLngValue);
                create_marker_poi.setPosition(latLngValue);
            });

            // Initialize Maps For Update
            var update_myLatlng = new google.maps.LatLng(-6.161287494589915, 106.762708119932597);
            var myOptions = {
                zoom:17,
                center: update_myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            update_map_poi = new google.maps.Map(document.getElementById("update-maps"), myOptions);

            update_marker_poi = new google.maps.Marker({
                position: update_myLatlng,
                draggable: true,
                map: update_map_poi
            });

            defineMaps(update_marker_poi, update_map_poi, 'update-latitude', 'update-longitude');

            $('#update-longitude, #update-latitude').on('change', function() {
                var lat = $('#update-latitude');
                var lng = $('#update-longitude');
                lat.val(lat.val());
                lng.val(lng.val());

                var latLngValue = {
                    lat: parseFloat(lat.val()),
                    lng: parseFloat(lng.val())
                };

                update_map_poi.setCenter(latLngValue);
                update_marker_poi.setPosition(latLngValue);
            });
        });
    </script>
@endsection
