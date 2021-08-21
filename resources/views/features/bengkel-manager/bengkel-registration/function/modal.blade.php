<!-- Create Modal -->
<div class="modal" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="far far-fw fa-eye mr-1"></i> Create Bengkel
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="create-form" action="/bengkel-manager/bengkel-registration" method="POST" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="name"
                                    id="create-name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control"
                                    name="address"
                                    id="create-address"
                                    rows="5"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input type="text"
                                    id="create-latitude"
                                    name="latitude"
                                    class="form-control"
                                    placeholder="Bengkel Latitude"
                                    pattern="[0-9-.]*"
                                    title="Latitude only use: 0-9 - ."
                                    value="-6.161287494589915"
                                    required>
                            </div>
                            <div class="col-6 form-group">
                                <input type="text"
                                    id="create-longitude"
                                    name="longitude"
                                    class="form-control"
                                    placeholder="Bengkel Longitude"
                                    pattern="[0-9-.]*"
                                    title="Longitude only use: 0-9 - ."
                                    value="106.762708119932597"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="create-maps" style="min-height: 65vh;width: 100%;"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Type</label>
                            <div class="col-sm-8">
                                <select class="form-control"
                                    id="create-type"
                                    name="type"
                                    required>
                                        <option value="">Please Select</option>
                                        <option value="1">Bengkel Resmi</option>
                                        <option value="2">Bengkel Umum</option>
                                </select>
                            </div>
                        </div>

                        {{--
                            Vehicle Type currently disabled due to request
                            --}}

                        <input type="hidden" name="vehicle-type" value="1" />

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Vehicle Type</label>
                            <div class="col-sm-8">
                                <select disabled class="form-control"
                                    id="vehicle-type"
                                    required>
                                        <option value="">Please Select</option>
                                        <option selected value="1">Mobil</option>
                                        <option value="2">Motor</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Workshop Image</label>
                            <div class="col-sm-8">
                                <input type="file"
                                    accept="image/*"
                                    class="form-control"
                                    name="otImage"
                                    id="create-otImage"
                                    required />
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task Pickup Template Id</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="otPickupId"
                                    id="create-otPickup"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task Delivery Template Id</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="otDeliveryId"
                                    id="create-otDelivery"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task Username</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="otUsername"
                                    id="create-otUsername"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task URI</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="otUri"
                                    id="create-otUri"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task Password</label>
                            <div class="col-sm-8">
                                <input type="password"
                                    class="form-control"
                                    name="otPassword"
                                    id="create-otPassword"
                                    required>
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
                        <i class="far far-fw fa-plus-square mr-1"></i> Update Bengkel
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="update-form" action="/bengkel-manager/bengkel-registration" method="POST" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="name"
                                    id="update-name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control"
                                    name="address"
                                    id="update-address"
                                    rows="5"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input type="text"
                                    id="update-latitude"
                                    name="latitude"
                                    class="form-control"
                                    placeholder="Bengkel Latitude"
                                    pattern="[0-9-.]*"
                                    title="Latitude only use: 0-9 - ."
                                    value="-6.161287494589915"
                                    required>
                            </div>
                            <div class="col-6 form-group">
                                <input type="text"
                                    id="update-longitude"
                                    name="longitude"
                                    class="form-control"
                                    placeholder="Bengkel Longitude"
                                    pattern="[0-9-.]*"
                                    title="Longitude only use: 0-9 - ."
                                    value="106.762708119932597"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="update-maps" style="min-height: 65vh;width: 100%;"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Type</label>
                            <div class="col-sm-8">
                                <select class="form-control"
                                    id="update-type"
                                    name="type"
                                    required>
                                        <option value="">Please Select</option>
                                        <option value="1">Bengkel Resmi</option>
                                        <option value="2">Bengkel Umum</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Workshop Image</label>
                            <div class="col-sm-8">
                                <input type="file"
                                    accept="image/*"
                                    class="form-control"
                                    name="otImage"
                                    id="create-otImage"
                                    />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task Pickup Template Id</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="otPickupId"
                                       id="create-otUsername" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task Delivery Template Id</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="otDeliveryId"
                                       id="create-otUsername" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task Username</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="otUsername"
                                    id="create-otUsername"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task URI</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="otUri"
                                    id="create-otUri"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task Password</label>
                            <div class="col-sm-8">
                                <input type="password"
                                    class="form-control"
                                    name="otPassword"
                                    id="update-otPassword">
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
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="far far-fw fa-eye mr-1"></i> View Bengkel
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
                            <label class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="name"
                                    id="view-name"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control"
                                    name="address"
                                    id="view-address"
                                    rows="5"
                                    disabled></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Type</label>
                            <div class="col-sm-8">
                                <select class="form-control"
                                    id="view-type"
                                    name="type"
                                    disabled>
                                        <option value="">Please Select</option>
                                        <option value="1">Bengkel Resmi</option>
                                        <option value="2">Bengkel Umum</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Workshop Image</label>
                            <div class="col-sm-8">
                                <img id="view-img" class="img-thumbnail w-100" src="#" alt="aaaa" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task Pickup Template Id</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="otPickupId"
                                       id="create-otUsername" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task Delivery Template Id</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="otDeliveryId"
                                       id="create-otUsername" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task Username</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="otUsername"
                                    id="create-otUsername" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Oper Task URI</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="otUri"
                                    id="create-otUri" disabled>
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
                    <form id="status-form" action="/bengkel-manager/bengkel-registration" method="POST">
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
                    <form id="delete-form" action="/bengkel-manager/bengkel-registration" method="POST">
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

<!-- Branch Modal -->
<div class="modal" id="brand-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="far far-fw fa-eye mr-1"></i> Create Brand
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="brand-form" action="/bengkel-manager/bengkel-registration/master-brand" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Brand Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    name="name"
                                    id="brand-name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Brand Type</label>
                            <div class="col-sm-8">
                                <select class="form-control"
                                    name="type"
                                    id="brand-type"
                                    required>
                                        <option value="">Please Select</option>
                                        <option value="1">Mobil</option>
                                        <option value="2">Motor</option>
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
