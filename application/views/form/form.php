<?php include APPPATH . 'views/template/header.php' ?>
<?php include APPPATH . 'views/template/sidebar.php' ?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Form</h4>
                        <div id="yourDiv">
                            <input type="hidden" value="<?= $no_mform ?>" id="no_form">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-6 d-inline">
                                    <button type="button" class="btn btn-sm btn-primary" id="addNew"> <i class="fas fa-plus"></i> Budget Form</button>
                                </div>
                                <div class="col-md-12 text-center" style="margin-top: 25px;">
                                    <h4 class="mb-sm-0">List</h4>
                                </div>
                                <div class="col-md-12" style="margin-top: 25px;">
                                    <table class="table table-bordered" id="table_mform" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Form Number</th>
                                                <th class="text-center">Date Created</th>
                                                <th class="text-center">Approval</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add New-->
    <div class="modal fade" id="modal_new">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_new_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nomor">Input Form Number:</label>
                            <input type="text" class="form-control" name="nomor" id="nomorInput" value="<?= $no_mform ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="dateCreated">Date Created:</label>
                            <input type="text" class="form-control" name="nomor" id="dateCreated" value="<?= Date("Y-m-d H:i:s") ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="saveModalNewForm">Save changes</button>
                    <button type="button" id='btn-close' class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Add New-->

    <!-- Modal Edit -->
    <div class="modal fade" tabindex="-1" id="modal_edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_edit_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12" style="overflow:auto;">
                            <table class="table table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Budget (Rp.)</th>
                                        <th class="text-center">Save</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" id="description" placeholder="Input budget description...">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="budget" placeholder="Input budget nominal...">
                                        </td>
                                        <td>
                                            <button type="button" id="btn-details" class="btn btn-primary">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 text-center mt-5">
                            <h2>Item List</h2>
                        </div>
                        <div class="col-lg-12 p-4">
                            <table class="table table-hover" id="load_details" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Budget (Rp.)</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" id="icon">
                            <table class="table table-hover tablee" id="tableT">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Rp.</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr>
                                        <td class="text-center">Total</td>
                                        <td class="text-center" id="tfc1"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="dateModal">
                    <input type="hidden" id="id_mform">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Edit -->

    <!-- Modal Edit Modal -->
    <div class="modal fade" id="modal_edit_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_edit_title_modal"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="editDescription">Description: </label>
                            <input type="text" class="form-control" placeholder="e.g. 1234" name="editDescription" id="editDescription">
                        </div>
                        <div class="col-lg-3">
                            <label for="editOrder">Budget: </label>
                            <input type="text" class="form-control" name="editPrice" id="editPrice">
                        </div>
                        <div class="col-lg-1">
                            <button type="button" id="btn-save-modal-edit-modal" class="btn btn-primary" style="margin-top: 30px;">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                        <input type="hidden" id="vf">
                        <input type="hidden" id="idMform">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="closeModalEditModal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Edit Modal -->

    <?php include APPPATH . 'views/template/footer.php' ?>
</div>
<?php include APPPATH . 'views/template/script.php' ?>