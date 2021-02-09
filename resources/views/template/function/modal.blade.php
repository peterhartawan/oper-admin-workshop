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
                    <form action="/store/auth/update-user" id="edit-profile-form" method="POST">
                        @method('PUT')
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
                    <form action="/store/auth/change-password" id="change-password-form" method="POST">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id" value="{{ Session::get('user')->id }}">

                        <div class="block-content">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Current Password</label>
                                <div class="col-sm-8">
                                    <input type="password" 
                                        class="form-control" 
                                        name="current-password" 
                                        id="current-password"
                                        placeholder="Input Password">
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
                                        name="confirm-password"
                                        id="confirm-password"
                                        placeholder="Input Confirmation Password">
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-right bg-light">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="change-password-btn" disabled>
                                <i class="fa far-fw fa-check mr-1"></i> Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#edit-profile-form').validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 5
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        phoneID: true
                    }
                },
                messages: {
                    username: {
                        required: "Please enter a username",
                        minlength: "Please enter minimal 5 characters"
                    },
                    email: "Please enter a valid email address",
                    phone: "Please enter a phone number!"
                },
                submitHandler: function(form) {
                    loaderOn();
                    form.submit();
                }
            });
        });

        changePasswordForm = $('#change-password-form');
        changePasswordButton = $('#change-password-btn');
        newPassword = $('#password');
        confirmPassword = $('#confirm-password');
        currentPasswordTextbox = $('#current-password');

        newPassword.keyup(function(e){ if(e.keyCode === 13) changePasswordButton.click(); });
        confirmPassword.keyup(function(e){ if(e.keyCode === 13) changePasswordButton.click(); });
        currentPasswordTextbox.keyup(function(e){ if(e.keyCode === 13) newPassword.focus(); });

        currentPasswordTextbox.change(function(e){
            loaderOn();
            $(this).popover('dispose');
            $(this).removeClass('is-invalid');

            $.ajax({
                type: "POST",
                url: "/cms/admin/user/check-current-password",
                data: {
                    "current-password": $(this).val()
                },
                dataType: 'json',
                success: function(data){
                    loaderOff();

                    if(data.match == false){
                        changePasswordButton.prop('disabled', true);
                        currentPasswordTextbox.popover({
                            content: "Password is incorrect",
                            trigger: 'focus',
                            placement: 'right'
                        }).popover('show');

                        currentPasswordTextbox.addClass('is-invalid');


                    }else 
                        changePasswordButton.removeAttr('disabled');
                },
                error: function(xhr, status, error){
                    loaderOff();
                    if(xhr.status === 404){
                        customSwal(xhr.status+ " - " + xhr.statusText, 'Requested URL is not found!');
                    }else{
                        customSwal(xhr.status+ " - " + xhr.statusText, "Connection to system is error! Please contact system administrator!");
                    }
                }
            });
        });

        changePasswordButton.click(function(e){
            newPassword.popover('dispose');
            confirmPassword.popover('dispose');
            passFlag = 0;

            if(newPassword.val() == ""){
                newPassword.popover({
                    content: "Fill the new password!",
                    trigger: 'focus',
                    placement: 'right'
                }).popover('show');
                newPassword.addClass('is-invalid');
                passFlag++;
            }


            if(confirmPassword.val() == ""){
                confirmPassword.popover({
                    content: "This form must be fill!",
                    trigger: 'focus',
                    placement: 'right'
                }).popover('show');
                confirmPassword.addClass('is-invalid');
                passFlag++;
            }

            if(confirmPassword.val() != newPassword.val()){
                confirmPassword.popover({
                    content: "Confirm password must be same as password!",
                    trigger: 'focus',
                    placement: 'right'
                }).popover('show');
                confirmPassword.addClass('is-invalid');
                passFlag++;
            }

            if(newPassword.val().length < 8){
                newPassword.popover({
                    content: "A password must contain 8 characters!",
                    trigger: 'focus',
                    placement: 'right'
                }).popover('show');
                newPassword.addClass('is-invalid');
                passFlag++;
            }

            if(passFlag == 0)
                changePasswordForm.submit();
        });

    </script>