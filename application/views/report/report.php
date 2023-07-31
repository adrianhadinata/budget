<?php include APPPATH . 'views/template/header.php' ?>
<?php include APPPATH . 'views/template/sidebar.php' ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Report</h4>
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
                                    <table class="table table-bordered" id="table_mform" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Form Number</th>
                                                <th class="text-center">Date Created</th>
                                                <th class="text-center">Total (Rp.)</th>
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
    <?php include APPPATH . 'views/template/footer.php' ?>
</div>
<?php include APPPATH . 'views/template/report.php' ?>