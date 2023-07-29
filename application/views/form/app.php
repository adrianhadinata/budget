<?php include APPPATH . 'views/template/header.php' ?>
<?php include APPPATH . 'views/template/sidebar.php' ?>
<style>
    .btn .badge {
        position: absolute !important;
        top: -5px !important;
    }

    .dataTables_scroll {
        overflow: auto;
    }
</style>

<!-- Main Content-->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Approved Form</h4>
                        <input type="hidden" class="no_pj" value="<?= $no_pj ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-2">
                                    <h5 class="mb-sm-0">Items Ready</h5>
                                </div>
                                <div class="col-md-2" style="text-align:center;">
                                    <h5 class="mb-sm-0">Cash Receipt</h5>
                                </div>
                                <div class="col-md-3" style="text-align:center;">
                                    <h5 class="mb-sm-0">Summary Cash Receipt</h5>
                                </div>
                                <div class="col-md-3" style="text-align:center;">
                                    <h5 class="mb-sm-0">PO Receiptment</h5>
                                </div>
                                <div class="col-md-2" style="text-align:end;">
                                    <h5 class="mb-sm-0">Notification</h5>
                                </div>
                                <div class="col-md-2" style="margin-top: 10px;">
                                    <button class="btn btn-light" id="cashed">
                                        <i class="fas fa-money-check-alt"></i>
                                        Cash
                                    </button>
                                    <button class="btn btn-light" id="poed">
                                        <i class="fas fas fa-clipboard-check"></i>
                                        PO
                                    </button>
                                </div>
                                <div class="col-md-2 text-center" style="margin-top: 10px;">
                                    <button class="btn btn-light" id="kasbon">
                                        <i class="fas fa-money-check-alt"></i>
                                        List
                                    </button>
                                </div>
                                <div class="col-md-3 text-center" style="margin-top: 10px;">
                                    <button class="btn btn-light" id="pj">
                                        <i class="fas fa-check-double"></i>
                                        New
                                    </button>
                                    <button class="btn btn-light" id="eyepj">
                                        <i class="fas fa-eye"></i>
                                        Old
                                    </button>
                                </div>
                                <div class="col-md-3 text-center" style="margin-top: 10px;">
                                    <button class="btn btn-light" id="poReceipt">
                                        <i class="fas fa-check-double"></i>
                                        New
                                    </button>
                                    <button class="btn btn-light" id="listPoReceipt">
                                        <i class="fas fa-eye"></i>
                                        Old
                                    </button>
                                </div>
                                <div class="col-md-2" style="text-align:end; margin-top: 10px;">
                                    <button class="btn btn-light notif" id="notif">
                                        <i class="far fa-bell"></i>
                                        <div id="icon1">
                                            <span class="badge rounded-pill bg-danger float-end"><?= $tlall[0]->not_updated ?></span>
                                        </div>
                                        PO
                                    </button>
                                    <button class="btn btn-light cash" id="cash">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <div id="cashdiv">
                                            <span class="badge rounded-pill bg-danger float-end"><?= $tlall[0]->cash_nu ?></span>
                                        </div>
                                        Cash
                                    </button>
                                </div>
                                <div class="col-md-12 text-center" style="margin-top: 25px;">
                                    <h4 class="mb-sm-0">Approved Budget Form List</h4>
                                </div>
                                <div class="col-md-12" style="margin-top: 25px;">
                                    <table class="table table-bordered" id="table_mform" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Date Created</th>
                                                <th class="text-center">Label</th>
                                                <th class="text-center">Month</th>
                                                <th class="text-center">Department</th>
                                                <th class="text-center">Form Number</th>
                                                <th class="text-center">Approval Manager</th>
                                                <th class="text-center">Approval Accounting</th>
                                                <th class="text-center">Approval Factory Manager</th>
                                                <th class="text-center">Status</th>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_edit_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-hover" id="table_edit_header" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">Category:</th>
                                        <th style="text-align:center;">Department:</th>
                                        <th style="text-align:center;">Month:</th>
                                        <th style="text-align:center;">Date Created:</th>
                                        <th style="text-align:center;">Date Approved</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:center;" id="cc1"></td>
                                        <td style="text-align:center;" id="dc1"></td>
                                        <td style="text-align:center;" id="mc1"></td>
                                        <td style="text-align:center;" id="yc1"></td>
                                        <td style="text-align:center;" id="ya1"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 text-center">
                            <h2>Item List</h2>
                        </div>
                        <div class="col-lg-12">
                            <table class="table" id="load_details" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">PO Supplier</th>
                                        <th class="text-center">Stock</th>
                                        <th class="text-center">Order</th>
                                        <th class="text-center">Unit</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Payment</th>
                                        <th class="text-center">Remarks</th>
                                        <th class="text-center">Created</th>
                                        <th class="text-center">Modified</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <img src="<?= base_url() ?>assets/images/logo.png" style="width: 100%;margin-left: 1%;height: 70%;align-self: center; margin-top:3%;">
                        </div>
                        <div class="col-lg-6" style="overflow:auto">
                            <table class="table table-hover tablee" id="tableT">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Cash </th>
                                        <th class="text-center">PO</th>
                                        <th class="text-center">All in</th>
                                        <th class="text-center">$</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                            <label for="editNopo">PO number: </label>
                            <select class="form-control" id="editNopo" name="editNopo">
                                <option>Coba</option>
                            </select>
                            <!-- <input type="text" class="form-control" placeholder="e.g. 1234" name="editNopo" id="editNopo"> -->
                        </div>
                        <div class="col-lg-3">
                            <label for="editOrder">Order: </label>
                            <input type="number" class="form-control" name="editOrder" id="editOrder" placeholder="e.g. 10" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="editPrice">Price (Rp.): </label>
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
                        <div class="col-lg-6">
                            <label for="editRemarks">Remarks: </label>
                            <input type="text" name="editRemarks" id="editRemarks" class="form-control" placeholder="e.g. For scanning operators in this department" disabled>
                        </div>
                        <div class="col-lg-3">
                            <label for="editTotal">Total (Rp.): </label>
                            <input type="text" readonly name="editTotal" id="editTotal" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label for="dateee">Cash Date: </label>
                            <input type="date" id="dateee" name="dateee" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="cashRemarks">Remarks for Cashier: </label>
                            <input type="text" name="cashRemarks" id="cashRemarks" class="form-control" placeholder="e.g. Very Important for Repairing" required>
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
    </div>
    <!-- End Modal Edit Modal -->

    <!-- Modal Summary -->
    <div class="modal fade" id="modal_sum">
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
                        <div class="col-lg-12 text-center">
                            <h2>Item List</h2>
                        </div>
                        <div class="col-lg-12"">
                            <table class=" table table-hover table-striped tablee" id="orr" style="width:100%">
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
                                    <th rowspan="2" style="text-align:center;">Currency</th>
                                    <th rowspan="2" style="text-align:center;vertical-align:middle;">Payment</th>
                                    <th rowspan="2" style="vertical-align : middle;text-align:center;">Remarks</th>
                                </tr>
                                <tr>
                                    <!-- order -->
                                    <th style="text-align:center;">First</th>
                                    <th style="text-align:center;">Final</th>
                                    <!-- price -->
                                    <th style="text-align:center;">First</th>
                                    <th style="text-align:center;">Final</th>
                                    <!-- total -->
                                    <th style="text-align:center;">First</th>
                                    <th style="text-align:center;">Final</th>
                                </tr>
                            </thead>
                            <tbody id="teer">
                            </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="overflow:auto">
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
                        <div class="col-lg-6" style="overflow:auto">
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
    </div>
    <!-- End Modal Summary -->

    <!-- Modal Notif -->
    <div class="modal fade" id="modal_notif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_notif_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12" style="overflow:auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">
                                            Total Approved Items
                                        </th>
                                        <th style="text-align:center;">
                                            Cash</th>
                                        <th style="text-align:center;">
                                            PO Not Yet Updated
                                        </th>
                                        <th style="text-align:center;">
                                            PO Updated
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:center;" class="bg-primary text-white"><?= $tlall[0]->total ?></td>
                                        <td style="text-align:center;" class="bg-info text-white"><?= $tlall[0]->cash ?></td>
                                        <td style="text-align:center;" class="bg-danger text-white"><span><?= $tlall[0]->not_updated ?></td></span>
                                        <td style="text-align:center;" class="bg-success text-white"><span><?= $tlall[0]->updated ?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 text-center">
                            <h2>Item List</h2>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-hover" id="table_n" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No.
                                        </th>
                                        <th class="text-center">
                                            Category
                                        </th>
                                        <th class="text-center">
                                            Department
                                        </th>
                                        <th class="text-center">
                                            Date Approved
                                        </th>
                                        <th class="text-center">
                                            Item
                                        </th>
                                        <th class="text-center">
                                            Form Number
                                        </th>
                                        <th class="text-center">
                                            Remarks
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
    <!-- End Modal Notif -->

    <!-- Modal Cash -->
    <div class="modal fade" id="modal_cash">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_cash_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12" style="overflow:auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">Total Approved Items</th>
                                        <th style="text-align:center;">
                                            Total Cash Items
                                        </th>
                                        <th style="text-align:center;">
                                            Sub Date Updated</th>
                                        <th style="text-align:center;">
                                            Not Yet Updated
                                        </th>
                                        <th style="text-align:center;">Sub Date Approved</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:center;" class="bg-primary text-white"><?= $tlall[0]->total ?></td>
                                        <td style="text-align:center;" class="bg-info text-white"><?= $tlall[0]->cash ?></td>
                                        <td style="text-align:center;" class="bg-success text-white"><span><?= $tlall[0]->cash_up ?></td></span>
                                        <td style="text-align:center;" class="bg-danger text-white"><span><?= $tlall[0]->cash_nu ?></span></td>
                                        <td style="text-align:center;" class="bg-info text-white"><span><?= $tlall[0]->cashier_ok ?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 text-center">
                            <h2>Item List</h2>
                        </div>
                        <div class="col-lg-12" style="overflow:auto;">
                            <table class="table table-hover" id="table_c" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Category
                                        </th>
                                        <th>
                                            Department
                                        </th>
                                        <th>
                                            Date Approved
                                        </th>
                                        <th>
                                            Item
                                        </th>
                                        <th>
                                            Form Number
                                        </th>
                                        <th>
                                            Remarks
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
    </div>
    <!-- End Modal Cash -->

    <!-- Modal Cash Ready -->
    <div class="modal fade" id="modal_cash_ready">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_cash_ready_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="months">Begin Date: </label>
                                    <input id='dpfrom' class="form-control" />
                                    <select hidden readonly name="months" id="months" class="form-control">
                                        <option value="">-- Select Month --</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="years">End Date: </label>
                                    <input id='dpto' class="form-control" />
                                    <select hidden readonly name="years" id="years" class="form-control">
                                        <option value="">-- Select Year --</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                                <div class="col-lg-4" style="text-align: left">
                                    <button class="btn btn-primary" id="btnFilter" style="margin-top: 12%;"><i class="fa fa-filter fa-lg"></i> Filter</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center" style="margin-top: 5%;">
                            <h2>Item List</h2>
                        </div>
                        <div class="col-lg-12" style="overflow:auto;">
                            <table class="table table-hover" id="table_cr" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Items
                                        </th>
                                        <th>
                                            Order
                                        </th>
                                        <th>
                                            Unit
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            Amount
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Department
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3" style="overflow:auto">
                            <table class="table table-hover" id="table_tr">
                                <thead>
                                    <tr>
                                        <th>Total</th>
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
    </div>
    <!-- End Modal Cash Ready-->

    <!-- Modal Cash Ready -->
    <div class="modal fade" id="modal_po_ready">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_po_ready_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="monthss">Begin Date: </label>
                                    <input id='dpfromm' class="form-control" />
                                    <select name="monthss" hidden readonly id="monthss" class="form-control">
                                        <option value="">-- Select Month --</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="yearss">End Date: </label>
                                    <input id='dptoo' class="form-control" />
                                    <select name="yearss" hidden readonly id="yearss" class="form-control">
                                        <option value="">-- Select Year --</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                                <div class="col-lg-4" style="text-align: left">
                                    <button class="btn btn-primary" id="btnFilterr" style="margin-top: 12%;"><i class="fa fa-filter fa-lg"></i> Filter</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center" style="margin-top: 5%;">
                            <h2>Item List</h2>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-hover" id="table_tf" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Items
                                        </th>
                                        <th>
                                            Order
                                        </th>
                                        <th>
                                            Unit
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            Amount
                                        </th>
                                        <th>
                                            Department
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <table class="table table-hover" id="table_tt">
                                <thead>
                                    <tr>
                                        <th>Total</th>
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
    </div>
    <!-- End Modal Cash Ready-->

    <!-- Modal Cash Receipt-->
    <div class="modal fade" id="modal_cash_receipt">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_cash_receipt_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-hover table-striped" id="table_voc" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Voucher Number</th>
                                        <th class="text-center">Date Created</th>
                                        <th class="text-center">Date Delivered</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Voucher Number</th>
                                        <th class="text-center">Date Created</th>
                                        <th class="text-center">Date Delivered</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-lg-9"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Cash Receipt-->

    <!-- Modal View -->
    <div class="modal fade" id="modal_load_d">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="modal-header" class="modal-header">
                    <h2 class="modal-title" id="modal_load_d_title"></h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-hover" id="table_edit_header" style="overflow:auto;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">Date Created:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:center;" id="cc2"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 text-center">
                            <h2>Item List</h2>
                        </div>
                        <div class="col-lg-12" style="overflow:auto;">
                            <table class="table table-hover" style="width:100%;" id="load_detailss">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Form Number</th>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Item</th>
                                        <th class="text-center">Order</th>
                                        <th class="text-center">Unit</th>
                                        <th class="text-center">Price (Rp.)</th>
                                        <th class="text-center">Total (Rp.)</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <img src="<?= base_url() ?>assets/images/logo.png" style="width: 100%;margin-left: 1%;height: 70%;align-self: center; margin-top:3%;">
                        </div>
                        <div class="col-lg-6" id="icon">
                            <table class="table table-hover tablee">
                                <thead>
                                    <tr>
                                        <td class="text-center">Total (Rp.)</td>
                                        <td class="text-center" id="tall"></td>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
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
    <!-- End Modal View -->

    <!-- Modal Select PJ -->
    <div class="modal fade" id="modal_select_mvoc" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_select_mvoc"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="p-5">
                        <tr>
                            <th class="text-bold p-2">
                                <label for="styleModal">Cash Receipt</label>
                            </th>
                            <td>
                                <div id="crselect">
                                    <select class="form-control" id="styleModal" name="styleModal" required>
                                        <option value="">-- Select Cash Receipt --</option>
                                        <?php foreach ($mvoc->result() as $i) { ?>
                                            <option value="<?= $i->id ?>"><?= $i->no_voc ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btnC" class="btn btn-primary">Continue</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Select PJ-->

    <!-- Modal Select PO -->
    <div class="modal fade" id="modal_select_po" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_select_po"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="p-5">
                        <tr>
                            <th class="text-bold p-2">
                                <label>PO Number</label>
                            </th>
                            <td>
                                <div id="poselect">
                                    <select class="form-control" id="poModal" name="poModal" required>
                                        <option value="">-- Select PO Number --</option>
                                        <?php foreach ($poNumber->result() as $i) { ?>
                                            <option value="<?= $i->id ?>"><?= $i->po_number ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btnNextPO" class="btn btn-primary">Continue</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Select PJ-->

    <!-- Modal Summary PJ-->
    <div class="modal fade" id="modal_summary_pj" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_summary_pj"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open('Form_accounting/save_pj') ?>
                    <div class="col-lg-12">
                        <div class="col-md-4">
                            <label for="pj_number">Summary Number:</label>
                            <input type="text" class="form-control" name="pj_number" value="<?= $no_pj ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12 p-2 mt-5">
                        <table class="table table-hover" id="table_pj" style="width:150%">
                            <thead>
                                <th>Bill Date</th>
                                <th>Department</th>
                                <th>Item</th>
                                <th>Order</th>
                                <th>Actual Buy</th>
                                <th>Unit</th>
                                <th>Actual Price</th>
                                <th>Total</th>
                                <th>Store</th>
                                <th>Remarks</th>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <th>Bill Date</th>
                                <th>Department</th>
                                <th>Item</th>
                                <th>Order</th>
                                <th>Actual Buy</th>
                                <th>Unit</th>
                                <th>Actual Price</th>
                                <th>Total</th>
                                <th>Store</th>
                                <th>Remarks</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary">Save</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <!-- End of Modal Summary PJ-->

    <!-- Modal PO -->
    <div class="modal fade" id="modal_poo" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_poo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open('Form_accounting/save_arr') ?>
                    <div class="col-lg-12">
                        <div class="col-md-4">
                            <label for="arr_number">Form Number:</label>
                            <input type="hidden" name="id_po" id="idPo">
                            <input type="text" class="form-control" name="arr_number" value="<?= $no_form ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12 p-2 mt-5">
                        <table class="table table-hover" id="table_arr" style="width:100%">
                            <thead>
                                <th>No.</th>
                                <th>Item Name</th>
                                <th>Order Qty.</th>
                                <th>Arrived Qty.</th>
                                <th>Invoice</th>
                                <th>BBM</th>
                                <th>BBK</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="saveArr" class="btn btn-primary">Save</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <!-- End of Modal Summary PJ-->

    <!-- Modal List PJ-->
    <div class="modal fade" id="modal_list_pj" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_list_pj"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 p-2 mt-5">
                        <table class="table table-hover" id="table_list_pj" style="width:100%">
                            <thead>
                                <th class="text-center">No.</th>
                                <th class="text-center">Summary Number</th>
                                <th class="text-center">Date Created</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal List PJ-->

    <!-- Modal List PJ-->
    <div class="modal fade" id="modal_list_arr" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_list_arr"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 p-2 mt-5">
                        <table class="table table-hover" id="table_list_arr" style="width:100%">
                            <thead>
                                <th class="text-center">No.</th>
                                <th class="text-center">Form Number</th>
                                <th class="text-center">PO Number</th>
                                <!-- <th class="text-center">Purchasing</th>
                                <th class="text-center">Admin</th> -->
                                <th class="text-center">Action</th>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal List PJ-->

    <!-- Modal Detail PJ-->
    <div class="modal fade" id="modal_summary_detail_pj" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_summary_detail_pj"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="pj_num">Summary Number:</label>
                            <input type="text" class="form-control" name="pj_num" id="pj_num" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="pj_crt">Date Created:</label>
                            <input type="text" class="form-control" name="pj_crt" id="pj_crt" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="pj_app">Date Approved:</label>
                            <input type="text" class="form-control" name="pj_app" id="pj_app" readonly>
                        </div>
                        <div class="col-lg-12 p-2 mt-5"">
                            <table class=" table table-hover" id="table_detail_pj" style="width:100%">
                            <thead>
                                <th class="text-center">No.</th>
                                <th class="text-center">Bill Date</th>
                                <th class="text-center">Item</th>
                                <th class="text-center">Budget Order</th>
                                <th class="text-center">Actual Order</th>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Budget Price (Rp.)</th>
                                <th class="text-center">Actual Price (Rp.)</th>
                                <th class="text-center">Budget Total (Rp.)</th>
                                <th class="text-center">Actual Total (Rp.)</th>
                                <th class="text-center">Department</th>
                                <th class="text-center">Remarks</th>
                                <th class="text-center">Store</th>
                                <th class="text-center">Action</th>
                            </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Detail PJ-->

    <!-- Modal Detail PJ-->
    <div class="modal fade" id="modal_detail_arr" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_detail_arr"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 p-2 mt-5">
                            <table class=" table table-hover" id="table_detail_marr" style="width:100%">
                                <thead>
                                    <th>No.</th>
                                    <th>Id</th>
                                    <th>Item Name</th>
                                    <th>Order Qty.</th>
                                    <th>Arrived Qty.</th>
                                    <th>Invoice</th>
                                    <th>BBM</th>
                                    <th>BBK</th>
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
    </div>
    <!-- End of Modal Detail PJ-->

    <!-- Modal Edit Detail PJ -->
    <div class="modal fade" id="modal_edit_detail_pj" tabindex="-1" aria-labelledby="modal_edit_detail_pj" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_edit_detail_pj_title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="bill_date">Bill Date:</label>
                            <input class="form-control" type="date" name="bill_date" id="edit_bill_date">
                        </div>
                        <div class="col-md-3">
                            <label for="edit_order">Budget Order:</label>
                            <input class="form-control" type="number" name="edit_order" id="edit_order" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="edit_unit">Unit</label>
                            <input class="form-control" type="text" name="edit_unit" id="edit_unit" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="edit_">Department</label>
                            <input class="form-control" type="text" name="edit_dept" id="edit_dept" readonly>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="edit_price">Budget Price (Rp.)</label>
                            <input class="form-control" type="text" name="edit_price" id="edit_price" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="edit_actual_price">Actual Order</label>
                            <input class="form-control" type="text" name="edit_actual_order" id="edit_actual_order">
                        </div>
                        <div class="col-md-3">
                            <label for="edit_actual_price">Actual Price (Rp.)</label>
                            <input class="form-control" type="text" name="edit_actual_price" id="edit_actual_price">
                        </div>
                        <div class="col-md-3">
                            <label for="edit_id_store">Store</label>
                            <select class="form-control" name="edit_id_store" id="edit_id_store">
                                <option value="">-- Select Store --</option>
                                <?php foreach ($stores->result() as $store) { ?>
                                    <option value="<?= $store->id ?>"><?= $store->store_name ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="edit_approved_price">Total Budget Price (Rp.)</label>
                            <input class="form-control" type="text" name="edit_approved_price" id="edit_approved_price" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="edit_actual_total">Total Actual Price (Rp.)</label>
                            <input class="form-control" type="text" name="edit_actual_total" id="edit_actual_total" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_remarks">Remarks</label>
                            <input class="form-control" type="text" name="edit_remarks" id="edit_remarks">
                            <input class="form-control" type="hidden" name="edit_id" id="edit_id">
                            <input class="form-control" type="hidden" name="edit_id_pjs" id="edit_id_pjs">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_detail" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Edit Detail PJ -->


    <?php include APPPATH . 'views/template/footer.php' ?>
</div>
<?php include APPPATH . 'views/template/sc.php' ?>