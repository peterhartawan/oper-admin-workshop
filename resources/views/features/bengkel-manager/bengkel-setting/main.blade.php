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

@section('title', 'Bengkel Manager - Bengkel Setting')

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <select id="type" class="btn btn-primary">
                            <option value="bengkel_name">Bengkel Name</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" id="search" placeholder="Search">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" onclick="search()">
                            <i class="fa fa-search mr-1"></i>
                        </button>
                    </div>
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
                        <th>Bengkel Name</th>
                        <th>Bengkel Open</th>
                        <th>Bengkel Close</th>
                        <th>Minimal Order</th>
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
    @include('features.bengkel-manager.bengkel-setting.function.modal')
@endsection

@section('js_after')
    <script type="text/javascript" src="{{ asset('template/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>

    <script type='text/javascript'>

        //global
        let searchValue = "";
        let filter = "";

        $(function() {
            Dashmix.helpers(['masked-inputs']);
        });

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
                "url": "/bengkel-manager/bengkel-setting/pagination",
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
            "/bengkel-manager/bengkel-setting/pagination",
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
                        "size": perPage,
                        "key": filter,
                        "value": searchValue
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
                url: '/bengkel-manager/bengkel-setting/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(rspn) {
                    $('#view-form').find('[name="bengkel"]').val(rspn.workshop_bengkel.bengkel_name);
                    $('#view-form').find('[name="open"]').val(rspn.bengkel_open);
                    $('#view-form').find('[name="close"]').val(rspn.bengkel_close);
                    $('#view-form').find('[name="order"]').val(rspn.min_daily);
                    $('#view-form').find('[name="ordertime"]').val(rspn.min_order_time);
                    $('#view-form').find('[name="distance"]').val(rspn.maks_jarak);

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
                url: '/bengkel-manager/bengkel-setting/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(rspn) {
                    $('#update-form').find('[name="id"]').val(rspn.id);
                    $('#update-form').find('[name="bengkel"]').val(rspn.workshop_bengkel.bengkel_name);
                    $('#update-form').find('[name="open"]').val(rspn.bengkel_open);
                    $('#update-form').find('[name="close"]').val(rspn.bengkel_close);
                    $('#update-form').find('[name="order"]').val(rspn.min_daily);
                    $('#update-form').find('[name="ordertime"]').val(rspn.min_order_time);
                    $('#update-form').find('[name="distance"]').val(rspn.maks_jarak);

                    loaderOff();
                    $('#update-modal').modal('show');
                },
                error: function(err) {
                    loaderOff();
                },
            });
        }

    </script>
@endsection
