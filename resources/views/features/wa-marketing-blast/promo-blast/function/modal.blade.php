<!-- Create Modal -->
<div class="modal" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="far far-fw fa-eye mr-1"></i> Create WA Promo
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="create-form" action="/wa-marketing-blast/promo-blast" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Promo Title</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="title" 
                                    id="create-title" 
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Promo Content</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" 
                                    name="content" 
                                    id="create-content" 
                                    rows="5"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Promo Image</label>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" 
                                        class="custom-file-input" 
                                        data-toggle="custom-file-input" 
                                        id="create-image" 
                                        name="image">
                                    <label class="custom-file-label" for="create-image">Choose image</label>
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

<!-- Update Modal -->
<div class="modal" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="far far-fw fa-plus-square mr-1"></i> Update WA Promo
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="update-form" action="/wa-marketing-blast/promo-blast" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Promo Title</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="title" 
                                    id="update-title" 
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Promo Content</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" 
                                    name="content" 
                                    id="update-content" 
                                    rows="5"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Promo Image</label>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" 
                                        class="custom-file-input" 
                                        data-toggle="custom-file-input" 
                                        id="update-image" 
                                        name="image">
                                    <label class="custom-file-label" for="update-image">Choose image</label>
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
                        <i class="far far-fw fa-eye mr-1"></i> View WA Promo
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="javascript:void(0)" id="view-form">
                        <input type="hidden" name="id">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Promo Title</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control" 
                                    name="title" 
                                    id="view-title" 
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Promo Content</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" 
                                    name="content" 
                                    id="view-content" 
                                    rows="5"
                                    disabled></textarea>
                            </div>
                        </div>
                    </form>
                    <div id="log_wrapper" style="height: 300px; overflow-y: scroll;" class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter display nowrap text-center">
                            <thead class="bg-white">
                                <tr>
                                    <th>Sent To</th>
                                    <th>Sent Time</th>
                                </tr>
                            </thead>
                            <tbody id="log_content">
                            </tbody>
                        </table>
                    </div>
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
                        <i class="far far-fw fa-trash-alt mr-1"></i> Delete WA Promo
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
                    <form id="delete-form" action="/wa-marketing-blast/promo-blast" method="POST">
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