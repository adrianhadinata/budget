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
                            <input type="text" class="form-control" placeholder="e.g. 1234" name="editNopo" id="editNopo" disabled>
                        </div>
                        <div class="col-lg-3">
                            <label for="editOrder">Order: </label>
                            <input type="number" class="form-control" name="editOrder" id="editOrder" placeholder="e.g. 10">
                        </div>
                        <div class="col-lg-3">
                            <label for="editOrder">Price: </label>
                            <input type="hidden" class="form-control" name="editPrice" id="editPrice" readonly>
                            <input type="text" class="form-control" name="editPrice" id="editPriceView" readonly>
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
                            <input type="text" name="editRemarks" id="editRemarks" class="form-control" placeholder="e.g. For scanning operators in this department">
                        </div>
                        <div class="col-lg-3">
                            <label for="editTotal">Total: </label>
                            <input type="hidden" readonly name="editTotal" id="editTotal" class="form-control">
                            <input type="text" readonly name="editTotal" id="editTotalView" class="form-control">
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

    <!-- Modal Summary -->
    <!-- <div class="modal fade" id="modal_sum">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_sum_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-hover" id="table_modal_header">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">Category:</th>
                                        <th style="text-align:center;">Department:</th>
                                        <th style="text-align:center;">Month:</th>
                                        <th style="text-align:center;">Date Created:</th>
                                        <th style="text-align:center;">Date Approved:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="cc" style="text-align:center;"></td>
                                        <td id="dc" style="text-align:center;"></td>
                                        <td id="mc" style="text-align:center;"></td>
                                        <td id="yc" style="text-align:center;"></td>
                                        <td id="ya" style="text-align:center;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-success" id="exportExcel">
                                <span class="mdi mdi-microsoft-excel mdi-24px"></span>
                            </button>
                            <button class="btn btn-danger" id="exportPdf">
                                <span class="mdi mdi-file-pdf-outline mdi-24px"></span>
                            </button>
                        </div>
                        <div class="col-lg-12 text-center">
                            <h2>Item List</h2>
                        </div>
                        <div class="col-lg-12" style="overflow:auto;">
                            <input type="hidden" id="mform_id">
                            <table class="table table-hover table-striped tablee" id="orr">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;"><strong>No.</strong></th>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Description</th>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">PO Supplier</th>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Stock</th>
                                        <th colspan="2" style="text-align:center;">Order</th>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Unit</th>
                                        <th colspan="2" style="vertical-align : middle;text-align:center;">Price</th>
                                        <th colspan="2" style="text-align:center;">Total</th>
                                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Currency</th>
                                        <th rowspan="2" style="text-align:center;vertical-align : middle;">Payment</th>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Remarks</th>
                                    </tr>
                                    
                                </thead>
                                <tbody id="teer">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th colspan="3" style="text-align:center;">Approval</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center;">Manager</th>
                                        <th style="text-align:center;">Purchasing</th>
                                        <th style="text-align:center;">Factory Manager</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:center;">
                                            <span class='btn btn-success acc btn-sm'><i class="fas fa-check"></i></span>
                                        </td>
                                        <td style="text-align:center;">
                                            <span class='btn btn-success acc btn-sm'><i class="fas fa-check"></i></span>
                                        </td>
                                        <td style="text-align:center;">
                                            <span class='btn btn-success acc btn-sm'><i class="fas fa-check"></i></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-hover tablee">
                                <tr>
                                    <th class="text-center">Total</th>
                                    <td class="text-center">Cash </td>
                                    <td class="text-center">PO</td>
                                    <td class="text-center">All in</td>
                                    <td class="text-center">$</td>
                                </tr>
                                <tr>
                                    <th class="text-center">First</th>
                                    <td class="text-center" id="tfc"></td>
                                    <td class="text-center" id="tft"></td>
                                    <td class="text-center" id="ttl"></td>
                                    <td class="text-center" id="usd"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Final</th>
                                    <td class="text-center" id="tfic"></td>
                                    <td class="text-center" id="tfit"></td>
                                    <td class="text-center" id="ttli"></td>
                                    <td class="text-center" id="usdi"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Modal Summary -->

    <!-- Modal Cash Ready -->
    <!-- <div class="modal fade" id="modal_cash_ready">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_cash_ready_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 text-center" style="margin-top: 2%;">
                            <h2>Items List</h2>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-hover" id="table_cr" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Form Number
                                        </th>
                                        <th>
                                            Item Description
                                        </th>
                                        <th>
                                            Final Order
                                        </th>
                                        <th>
                                            Unit
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Modal Cash Ready-->

    <?php include APPPATH . 'views/template/footer.php' ?>
</div>
<?php include APPPATH . 'views/template/script.php' ?>