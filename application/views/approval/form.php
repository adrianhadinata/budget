<?php include APPPATH . 'views/template/header.php' ?>
<?php include APPPATH . 'views/template/sidebar.php' ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Approval</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-12 text-center" style="margin-top: 25px;">
                                    <h4 class="mb-sm-0">List</h4>
                                </div>
                                <div class="col-md-12" style="margin-top: 25px;">
                                    <table class="table table-bordered" id="table_mform">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Form Number</th>
                                                <th class="text-center">Date Created</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_edit_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2>Budget List</h2>
                        </div>
                        <div class="col-lg-12" style="overflow:auto;">
                            <table class="table" id="load_details" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
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
    <!-- <div class="modal fade" id="modal_edit_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_edit_title_modal"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="editNopo">PO number: </label>
                            <input type="text" class="form-control" placeholder="e.g. 1234" name="editNopo" id="editNopo" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="editOrder">Order: </label>
                            <input type="number" class="form-control" name="editOrder" id="editOrder" placeholder="e.g. 10">
                        </div>
                        <div class="col-lg-3">
                            <label for="editOrder">Price: </label>
                            <input type="text" class="form-control" name="editPrice" id="editPrice" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="editUnit">Unit: </label>
                            <input type="text" readonly class="form-control" name="editUnit" id="editUnit">
                        </div>
                        <div class="col-lg-3">
                            <label for="editPayment">Payment: </label>
                            <select name="editPayment" id="editPayment" class="form-control" disabled></select>
                        </div>
                        <div class="col-lg-5">
                            <label for="editRemarks">Remarks: </label>
                            <input type="text" name="editRemarks" id="editRemarks" class="form-control" placeholder="e.g. For scanning operators in this department" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="editTotal">Total: </label>
                            <input type="text" readonly name="editTotal" id="editTotal" class="form-control">
                        </div>
                        <div class="col-lg-1">
                            <button type="button" id="btn-save-modal-edit-modal" class="btn btn-primary" style="margin-top: 30px;">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                        <input type="hidden" id="dmf">
                        <input type="hidden" id="vf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="closeModalEditModal">Close</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Modal Edit Modal -->

    <?php include APPPATH . 'views/template/footer.php' ?>
</div>
<?php include APPPATH . 'views/template/scriptm.php' ?>