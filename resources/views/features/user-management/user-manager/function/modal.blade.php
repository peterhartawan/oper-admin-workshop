<!-- Create Modal -->
<div class="modal" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="far far-fw fa-eye mr-1"></i> Create User
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="create-form" action="/user-management/user-manager" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <select class="form-control"
                                    id="create-role"
                                    name="role"
                                    required
                                    onchange="changeRole('create')">
                                        <option value="">Please Select</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Workshop Bengkel</label>
                            <div class="col-sm-8">
                                <select class="form-control"
                                    id="create-workshop"
                                    name="workshop"
                                    required>
                                        <option value="">Please Select</option>
                                        @foreach ($bengkels as $bengkel)
                                            <option value="{{ $bengkel->id }}">{{ $bengkel->bengkel_name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="username"
                                    id="create-username"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                    title="Please follow email format example@domain.com"
                                    name="email"
                                    id="create-email"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    pattern="^[0]\d{8,14}$"
                                    title="Please enter valid phone number."
                                    name="phone"
                                    id="create-phone"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label class="col-sm-4 col-form-label">User Image</label>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input"
                                        data-toggle="custom-file-input"
                                        id="create-image"
                                        name="image">
                                    <label class="custom-file-label" for="create-image">Choose Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label class="col-sm-4 col-form-label">Zoom Key</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="zoom_key"
                                       id="create-zoom-key">
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label class="col-sm-4 col-form-label">Zoom Secret</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="zoom_secret"
                                       id="create-zoom-secret">
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

<!-- Update Modal -->
<div class="modal" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="far far-fw fa-plus-square mr-1"></i> Update User
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="update-form" action="/user-management/user-manager" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <select class="form-control"
                                    id="update-role"
                                    name="role"
                                    required
                                    onchange="changeRole('update')">
                                        <option value="">Please Select</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="username"
                                    id="update-username"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                    title="Please follow email format example@domain.com"
                                    name="email"
                                    id="update-email"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    pattern="^[0]\d{8,14}$"
                                    title="Please enter valid phone number."
                                    name="phone"
                                    id="update-phone"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label class="col-sm-4 col-form-label">User Image</label>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input"
                                        data-toggle="custom-file-input"
                                        id="update-image"
                                        name="image">
                                    <label class="custom-file-label" for="update-image">Choose Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label class="col-sm-4 col-form-label">Zoom Key</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="zoom_key"
                                       id="update-zoom-key">
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label class="col-sm-4 col-form-label">Zoom Secret</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="zoom_secret"
                                       id="update-zoom-secret">
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

<!-- View Modal -->
<div class="modal" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="far far-fw fa-eye mr-1"></i> View User
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="javascript:void(0)" id="view-form">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <select class="form-control"
                                    id="view-role"
                                    name="role"
                                    disabled>
                                        <option value="">Please Select</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="username"
                                    id="view-username"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                    title="Please follow email format example@domain.com"
                                    name="email"
                                    id="view-email"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="phone"
                                    pattern="^[0]\d{8,14}$"
                                    title="Please enter valid phone number."
                                    id="view-phone"
                                    disabled>
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label class="col-sm-4 col-form-label">User Image</label>
                            <div class="col-sm-8">
                                <a id="download-image" href="javascript:void(0);">
                                    <button type="button" class="btn btn-block btn-primary mr-1 mb-3">
                                        <i class="fa fa-fw fa-file mr-1"></i> Download Image
                                    </button>
                                </a>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">User Image</label>
                            <div class="col-sm-8">
                                <img class="img-fluid"
                                    id="view-image"
                                    src=""
                                    alt="">
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label class="col-sm-4 col-form-label">Zoom Key</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="zoom_key"
                                       id="view-zoom-key"
                                       disabled>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label class="col-sm-4 col-form-label">Zoom Secret</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="zoom_secret"
                                       id="view-zoom-secret"
                                       disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <span id="status-active" class="badge badge-pill badge-success">active</span>
                                <span id="status-suspend" class="badge badge-pill badge-danger">suspend</span>
                            </div>
                        </div>
                    </form>
                    <form id="status-form" action="/user-management/user-manager" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <input id="update-status-active" type="submit" class="btn btn-block btn-success" value="Active">
                            <input id="update-status-suspend" type="submit" class="btn btn-block btn-danger" value="Suspend">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-danger">
                    <h3 class="block-title">
                        <i class="far far-fw fa-trash-alt mr-1"></i> Delete Modal
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Are you sure for delete <strong id="delete-name"></strong>?</p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <form id="delete-form" action="/user-management/user-manager" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id">
                        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                        <input type="submit" class="btn btn-danger" value="Yes, delete it">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
