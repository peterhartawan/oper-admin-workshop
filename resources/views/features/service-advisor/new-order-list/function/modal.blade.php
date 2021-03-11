<!-- Update Status Modal -->
<div class="modal" id="update-status-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">
                        <i class="far far-fw fa-trash-alt mr-1"></i> Update Status Modal
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Are you sure for update status to open order <strong id="update-status-name"></strong>?</p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <form id="update-status-form" action="/service-advisor/new-order-list" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="id">
                        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                        <input type="submit" class="btn btn-danger" value="Yes, update it">
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
                        <i class="far far-fw fa-eye mr-1"></i> View Order
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
                            <label class="col-sm-4 col-form-label">Customer Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="cName" 
                                    id="view-cName" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Customer HP</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="cHp" 
                                    id="view-cHp" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Customer Email</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="cEmail" 
                                    id="view-cEmail" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Customer Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" 
                                    name="cAddress" 
                                    id="view-cAddres" 
                                    rows="5"
                                    disabled></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Order Type</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="oType" 
                                    id="view-oType" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Vehicle Brand</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="vBrand" 
                                    id="view-vBrand" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Vehicle Type</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="vType" 
                                    id="view-vType" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Vehicle Plat</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="vPlat" 
                                    id="view-vPlat" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Bengkel Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="bName" 
                                    id="view-bName" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">PKB Nomer</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="pkbNomer" 
                                    id="view-pkbNomer" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">PKB Estimation</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="pkbEstimation" 
                                    id="view-pkbEstimation" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Booking Number</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="bNumber" 
                                    id="view-bNumber" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Booking Time</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="bTime" 
                                    id="view-bTime" 
                                    disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        
<script type="text/javascript">    
    $("#update-status-form").validate({
        errorClass: "is-invalid text-danger",
        submitHandler: function(form) {
            loaderOn();
            form.submit();
        }
    });
</script>