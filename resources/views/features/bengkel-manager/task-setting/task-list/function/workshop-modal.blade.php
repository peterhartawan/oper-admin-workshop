<!-- Create Modal -->
<div class="modal" id="workshop-create-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="far far-fw fa-eye mr-1"></i> Create Task List
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="workshop-create-form" action="/bengkel-manager/task-setting/workshop-bengkel" method="POST" onsubmit="loaderOn()">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Master Task</label>
                            <div class="col-sm-8">
                                <select class="form-control" 
                                    id="workshop-create-master"
                                    name="master"
                                    required>
                                        <option selected value="{{ $master->id }}">{{ $master->task_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Workshop Bengkel</label>
                            <div class="col-sm-8">
                                <select class="form-control" 
                                    id="workshop-create-workshop"
                                    name="workshop"
                                    required>
                                        <option value="">Please Select</option>
                                        @foreach ($workshops as $workshop)
                                            <option value="{{ $workshop->id }}">{{ $workshop->bengkel_name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal" id="workshop-delete-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-danger">
                    <h3 class="block-title">
                        <i class="far far-fw fa-trash-alt mr-1"></i> Delete Task List
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Are you sure for delete relation <strong id="workshop-delete-name"></strong> and <strong>{{ $master->task_name }}</strong>?</p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <form id="workshop-delete-form" action="/bengkel-manager/task-setting/workshop-bengkel" method="POST" onsubmit="loaderOn()">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="workshop">
                        <input type="hidden" name="master" value="{{ $master->id }}">
                        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                        <input type="submit" class="btn btn-danger" value="Yes, delete it">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>