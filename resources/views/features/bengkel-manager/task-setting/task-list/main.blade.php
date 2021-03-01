@extends('template.layout')

@section('js_before')
    <script type="text/javascript" src="{{ asset('template/js/custom/infinity-scrolling.js') }}"></script> 
    <script type="text/javascript">
        //API Hit Setting
        var page = 1;
        var perPage = 5;
        var endOfRequest = false;

        var workshop_page = 1;
        var workshop_eor = false;
    </script>
@endsection

@section('css_before')

@endsection

@section('css_after')

@endsection

@section('title', 'Bengkel Manager - Detail Master Task')
    
@section('content')
    <div class="block block-rounded block-bordered">
        <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#tab-task-list">Task List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab-workshop-bengkel">Workshop Bengkel</a>
            </li>
        </ul>
        <div class="block-content tab-content">
            <div class="tab-pane active" id="tab-task-list" role="tabpanel">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select id="type" class="btn btn-primary">
                                <option value="list_name">List Name</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" id="search" placeholder="Search">
                        <div class="input-group-append mr-2">
                            <button type="button" class="btn btn-primary" onclick="search()">
                                <i class="fa fa-search mr-1"></i>
                            </button>
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-modal">
                            <i class="fa far-fw fa-plus mr-1"></i> Create Task List
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
                            <th>Sequence</th>
                            <th>Master Name</th>
                            <th>List Name</th>
                            <th>Final Task</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="content" class="text-center">
    
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
            <div class="tab-pane" id="tab-workshop-bengkel" role="tabpanel">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select id="workshop-type" class="btn btn-primary">
                                <option value="list_name">List Name</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" id="workshop-search" placeholder="Search">
                        <div class="input-group-append mr-2">
                            <button type="button" class="btn btn-primary" onclick="searchWorkshop()">
                                <i class="fa fa-search mr-1"></i>
                            </button>
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#workshop-create-modal">
                            <i class="fa far-fw fa-plus mr-1"></i> Create Workshop Bengkel
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
    
                <div id="workshop_wrapper" style="height: 300px; overflow-y: scroll;" class="table-responsive">
                    <table id="workshop-table" class="table table-bordered table-striped table-vcenter display nowrap ">
                        <thead class="text-center">
                            <th>Master Name</th>
                            <th>Bengkel Name</th>
                            <th>Bengkel Address</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="workshop_content" class="text-center">
    
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('features.bengkel-manager.task-setting.task-list.function.modal')
    @include('features.bengkel-manager.task-setting.task-list.function.workshop-modal')
@endsection

@section('js_after')
    <script type='text/javascript'>

        //global
        let searchValue = "";
        let filter = "";

        $(document).ready(function() {
            loadTable();
            loadTable("workshop_");
        });

        function loadTable(table = ""){
            var url = ""
            if(table == "") {
                page = 1;
                endOfRequest = false;
                url = "/bengkel-manager/task-setting/task-list/pagination";
            } else {
                workshop_page = 1;
                workshop_eor = false;
                url = "/bengkel-manager/task-setting/workshop-bengkel/pagination";
            }

            $('#'+table+'content').empty();

            loaderOn();

            $.ajax({
                "type": "GET",
                "url": url,
                "data": {
                    page: page,
                    size: perPage,
                    key: filter,
                    value: searchValue,
                    id: {{ $id }}
                },
                "dataType": "html",
                success: function(e) {
                    $('#'+table+'content').append(e);
                    loaderOff();
                },
                error: function(e){
                    alert("Connection to system is error! Please contact system administrator!");
                    loaderOff();
                }
            });
        }

        task_list = infinityScroll("wrapper", 
            "content", 
            "GET", 
            "/bengkel-manager/task-setting/task-list/pagination", 
            "html",
            {
                "page": page+1,
                "size": perPage,
                "key": filter,
                "value": searchValue,
                "id": {{ $id }}
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

        workshop_bengkel = infinityScroll("workshop_wrapper", 
            "workshop_content", 
            "GET", 
            "/bengkel-manager/task-setting/workshop-bengkel/pagination", 
            "html",
            {
                "page": workshop_page+1,
                "size": perPage,
                "key": filter,
                "value": searchValue,
                "id": {{ $id }}
            },
            function(){
                if(!$('#workshop_eor').length){
                    loaderOn();
                }
            },
            function(){
                page = workshop_page+1;
            },
            function(){
                return {
                    "param": {
                        "page": workshop_page+1,
                        "size": perPage
                    },
                    "endOfRequest": workshop_eor
                }
            },
            function(success){
                if(!$('#workshop_eor').length){
                    loaderOff();

                    $('#workshop_content').append(success);
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

        function updateView(id) {
            loaderOn();
            $.ajax({
                url: '/bengkel-manager/task-setting/task-list/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(rspn) {
                    $('#update-form').find('[name="id"]').val(rspn.id);
                    $('#update-form').find('[name="name"]').val(rspn.list_name);
                    $('#update-form').find('[name="sequence"]').val(rspn.list_sequence);

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

        function deleteViewWorkshop(id, name) {
            $('#workshop-delete-form').find('[name="workshop"]').val(id);
            $('#workshop-delete-name').text(name);
            $('#workshop-delete-modal').modal('show');
        }

    </script>
@endsection