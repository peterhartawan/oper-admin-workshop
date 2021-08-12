@extends('template.layout')

@section('js_before')
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

@section('title', 'User Management - User Manager')

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <select id="type" class="btn btn-primary" onchange="changeType(this.value)">
                            <option value="username">Username</option>
                            <option value="email">Email</option>
                            <option value="phone">Phone Number</option>
                            <option value="role_id">Role</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" id="search" placeholder="Search">
                    <select class="form-control d-none" id="search-select">
                        <option value="">Please Select</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append mr-2">
                        <button type="button" class="btn btn-primary" onclick="search()">
                            <i class="fa fa-search mr-1"></i>
                        </button>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-modal">
                        <i class="fa far-fw fa-plus mr-1"></i> Create User
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
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
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
    @include('features.user-management.user-manager.function.modal')
@endsection

@section('js_after')
    <script type='text/javascript'>

        //global
        let searchValue = "";
        let filter = "";

        const ROLE_SUPER_ADVISOR = 2;
        const ROLE_FOREMAN = 3;

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
                "url": "/user-management/user-manager/pagination",
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
            "/user-management/user-manager/pagination",
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
                case "username":
                    $('#search').removeClass('d-none');
                    $('#search-select').addClass('d-none');
                    searchField = $('#search');
                    break;

                case "email":
                    $('#search').removeClass('d-none');
                    $('#search-select').addClass('d-none');
                    searchField = $('#search');
                    break;

                case "phone":
                    $('#search').removeClass('d-none');
                    $('#search-select').addClass('d-none');
                    searchField = $('#search');
                    break;

                case "role_id":
                    $('#search').addClass('d-none');
                    $('#search-select').removeClass('d-none');
                    searchField = $('#search-select');
                    break;
            }
        }

        function search() {
            filter = $("#type").val();
            if(filter == "role_id") {
                searchValue = $("#search-select").val();
            } else {
                searchValue = $("#search").val();
            }

            loadTable();
        }

        function detailView(id) {
            loaderOn();
            $.ajax({
                url: '/user-management/user-manager/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(rspn) {
                    $('#view-form').find('[name="username"]').val(rspn.username);
                    $('#view-form').find('[name="email"]').val(rspn.email);
                    $('#view-form').find('[name="phone"]').val(rspn.phone);
                    $('#view-form').find('[name="role"]').val(rspn.role_id);
                    $('#status-form').find('[name="id"]').val(rspn.id);
                    // $('#download-image').prop('href', rspn.url_image);
                    $('#view-image').prop('src', rspn.image);
                    $('#view-zoom-key').val(rspn.zoom_key);
                    $('#view-zoom-secret').val(rspn.zoom_secret);

                    if (rspn.role_id == ROLE_SUPER_ADVISOR) {
                        $('#view-zoom-key').parents('.form-group').removeClass("d-none");
                        $('#view-zoom-secret').parents('.form-group').removeClass("d-none");
                    } else if (rspn.role_id == ROLE_FOREMAN) {
                        $('#view-zoom-key').parents('.form-group').addClass("d-none");
                        $('#view-zoom-secret').parents('.form-group').addClass("d-none");
                    }

                    if (rspn.status) {
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
                url: '/user-management/user-manager/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(rspn) {
                    $('#update-form').find('[name="id"]').val(rspn.id);
                    $('#update-form').find('[name="username"]').val(rspn.username);
                    $('#update-form').find('[name="email"]').val(rspn.email);
                    $('#update-form').find('[name="phone"]').val(rspn.phone);
                    $('#update-form').find('[name="role"]').val(rspn.role_id).trigger("change");

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

        /**
        *@param action : what will use to this function create or update
        */
        function changeRole(action) {
            var roleElement = $('#' + action + '-form').find('[name="role"] option:selected');
            switch (roleElement.text().toLowerCase().replace(" ", "")) {
                case 'serviceadvisor':
                    if (action == "create") {
                        $('#' + action + '-form')
                            .find('[name="image"]')
                            .prop('required', true);

                        $('#' + action + '-form')
                            .find('[name="zoom_key"]')
                            .prop('required', true);

                        $('#' + action + '-form')
                            .find('[name="zoom_secret"]')
                            .prop('required', true);
                    }
                    $('#' + action + '-form')
                        .find('[name="image"]')
                        .parents('.form-group')
                        .removeClass("d-none");
                    $('#' + action + '-zoom-key')
                        .parents('.form-group')
                        .removeClass("d-none");
                    $('#' + action + '-zoom-secret')
                        .parents('.form-group')
                        .removeClass("d-none");
                    break;

                default:
                    if (action == "create") {
                        $('#' + action + '-form')
                            .find('[name="image"]')
                            .prop('required', false);

                        $('#' + action + '-form')
                            .find('[name="zoom_key"]')
                            .prop('required', false);

                        $('#' + action + '-form')
                            .find('[name="zoom_secret"]')
                            .prop('required', false);
                    }
                    $('#' + action + '-form')
                        .find('[name="image"]')
                        .parents('.form-group')
                        .addClass("d-none");
                    $('#' + action + '-zoom-key')
                        .parents('.form-group')
                        .addClass("d-none");
                    $('#' + action + '-zoom-secret')
                        .parents('.form-group')
                        .addClass("d-none");
                    break;
            }
        }

    </script>
@endsection
