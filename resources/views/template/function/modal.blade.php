<!-- View Profile Modal -->
    <div class="modal" id="view-profile-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="far far-fw fa-eye mr-1"></i> View Profile
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="javascript:void(0)" id="view-profile-form">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Role</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ Session::get('user')->role->role_name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ Session::get('user')->username }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ Session::get('user')->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="{{ Session::get('user')->phone }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    @if (Session::get('user')->status)
                                        <span class="badge badge-pill badge-success">Actived</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Suspended</span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Edit Profile Modal -->
    <div class="modal" id="edit-profile-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-user-cog mr-1"></i> Edit Profile
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="/profile" id="edit-profile-form" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ Session::get('user')->id }}">

                        <div class="block-content">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" 
                                        class="form-control" 
                                        name="username" 
                                        value="{{ Session::get('user')->username }}"
                                        placeholder="Input Username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" 
                                        class="form-control" 
                                        name="email" 
                                        value="{{ Session::get('user')->email }}"
                                        placeholder="Input Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" 
                                        class="form-control" 
                                        name="phone" 
                                        value="{{ Session::get('user')->phone }}"
                                        placeholder="Input Phone">
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-right bg-light">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa far-fw fa-check mr-1"></i> Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Change Password Modal -->
    <div class="modal" id="change-password-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-user-edit mr-1"></i> Change Password
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="/profile/password" id="change-password-form" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ Session::get('user')->id }}">

                        <div class="block-content">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Current Password</label>
                                <div class="col-sm-8">
                                    <input type="password" 
                                        class="form-control" 
                                        name="current" 
                                        id="current"
                                        placeholder="Input Password"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">New Password</label>
                                <div class="col-sm-8">
                                    <input type="password" 
                                        class="form-control" 
                                        name="password" 
                                        id="password"
                                        placeholder="Input Password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Confirm New Password</label>
                                <div class="col-sm-8">
                                    <input type="password" 
                                        class="form-control" 
                                        name="confirm"
                                        id="confirm"
                                        placeholder="Input Confirmation Password">
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-right bg-light">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="change-password-btn">
                                <i class="fa far-fw fa-check mr-1"></i> Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Change Picture Modal -->
    <div class="modal" id="change-picture-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-user-edit mr-1"></i> Change Picture
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="/profile/picture" id="change-picture-form" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ Session::get('user')->id }}">

                        <div class="block-content">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Profile Picture</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" 
                                            class="custom-file-input" 
                                            data-toggle="custom-file-input" 
                                            id="image" 
                                            name="image">
                                        <label class="custom-file-label" for="image">Choose Image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-right bg-light">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="change-picture-btn">
                                <i class="fa far-fw fa-check mr-1"></i> Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>