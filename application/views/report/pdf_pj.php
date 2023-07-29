<?php include APPPATH . 'views/template/plugin_top.php' ?>
<?php $items = $pj->result();
?>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2"><img src="<?= base_url() ?>assets/images/logo-kop.png"></td>
                    <td class="text-center">Voucher Number:</td>
                    <td class="text-center">Date Created:</td>
                    <td class="text-center">Date Approved:</td>
                </tr>
                <tr>
                    <td class="text-center" style="vertical-align:middle"><?= $items[0]->no_voc ?></td>
                    <td class="text-center" style="vertical-align:middle"><?= $pjs[0]->date_pj ?></td>
                    <td class="text-center" style="vertical-align:middle"><?= $pjs[0]->date_app ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-12 mt-5 text-center">
        <h3><?= $pjs[0]->pj_number ?></h3>
    </div>
    <div class="col-lg-12 p-2 mt-5">
        <table class="table table-hover" id="table_detail_pj" style="width:100%">
            <thead>
                <th class="text-center">No.</th> <!-- 1 -->
                <th class="text-center">Bill Date</th> <!-- 2 -->
                <th class="text-center">Item</th> <!-- 3 -->
                <th class="text-center">Voucher Order</th>
                <th class="text-center">Actual Order</th>
                <th class="text-center">Unit</th> <!-- 6 -->
                <th class="text-center">Voucher Price (Rp.)</th>
                <th class="text-center">Actual Price (Rp.)</th>
                <th class="text-center">Total Voucher (Rp.)</th>
                <th class="text-center">Total Actual (Rp.)</th>
                <th class="text-center">Balance(Rp.)</th>
                <th class="text-center">Department</th>
                <th class="text-center">Remarks</th>
                <th class="text-center">COA</th>
            </thead>
            <tbody>
                <?php $no = 0 ?>
                <?php foreach ($pj->result() as $item) { ?>
                    <?php $no++ ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td> <!-- 1 -->
                        <td><?= $item->date_bill ?></td> <!-- 2 -->
                        <td><?= $item->iname ?></td> <!-- 3 -->
                        <td class="text-center"><?= $item->budget_ord ?></td>
                        <td class="text-center"><?= $item->actual_ord ?></td>
                        <td class="text-center"><?= $item->unit ?></td> <!-- 6 -->
                        <td><?= number_format($item->budget_prc, 2, ',', '.') ?></td>
                        <td><?= number_format($item->actual_prc, 2, ',', '.') ?></td>
                        <td><?= number_format($item->budget_total, 2, ',', '.') ?></td>
                        <td><?= number_format($item->actual_total, 2, ',', '.') ?></td>
                        <td class="text-center"><?= number_format($item->diff, 2, ',', '.') ?></td>
                        <td><?= $item->dept_name ?></td>
                        <td><?= $item->remarks ?></td>
                        <td><?= $item->remarks_cashier ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>Total(Rp.):</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= number_format($items[0]->total_b_all, 2, ',', '.') ?></td>
                    <td><?= number_format($items[0]->total_a_all, 2, ',', '.') ?></td>
                    <td><?= number_format($items[0]->total_diff, 2, ',', '.') ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-12" style="margin-top: 15px;">
        <table class="table table-borderless" style="width:100%">
            <thead>
                <tr>
                    <th>Klaten, <?= date("d-m-Y") ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cashier,</td>
                    <td>Receiver,</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php include APPPATH . 'views/template/plugin_bottom.php' ?>
<script>
    $(document).ready(function() {
        print();
    })
</script>