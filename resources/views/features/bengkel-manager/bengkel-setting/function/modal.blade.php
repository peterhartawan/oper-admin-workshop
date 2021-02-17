<!-- Update Modal -->
<div class="modal" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="far far-fw fa-plus-square mr-1"></i> Update Bengkel Setting
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="update-form" action="/bengkel-manager/bengkel-setting" method="POST" onsubmit="loaderOn()">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Bengkel Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="bengkel" 
                                    id="update-bengkel" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Open Time</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="js-masked-time form-control" 
                                    name="open" 
                                    id="update-open" 
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Close Time</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="js-masked-time form-control" 
                                    name="close" 
                                    id="update-close" 
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Minimal Order</label>
                            <div class="col-sm-8">
                                <input type="input"
                                    maxlength="3"
                                    class="form-control" 
                                    name="order" 
                                    id="update-order" 
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Minimal Order Time</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="js-masked-time form-control" 
                                    name="ordertime" 
                                    id="update-ordertime" 
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Maximal Jarak</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="number"
                                        class="form-control" 
                                        name="distance" 
                                        id="update-distance" 
                                        required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            Meters
                                        </span>
                                    </div>
                                </div>
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
                        <i class="far far-fw fa-eye mr-1"></i> View Bengkel Setting
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
                            <label class="col-sm-4 col-form-label">Bengkel Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="bengkel" 
                                    id="view-bengkel" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Open Time</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="open" 
                                    id="view-open" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Close Time</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="close" 
                                    id="view-close" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Minimal Order</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="order" 
                                    id="view-order" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Minimal Order Time</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="ordertime" 
                                    id="view-ordertime" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Maximal Jarak</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control" 
                                        name="distance" 
                                        id="view-distance" 
                                        required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            Meters
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>