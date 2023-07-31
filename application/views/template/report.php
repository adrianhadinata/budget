</div>
<?php include APPPATH . 'views/template/plugin_bottom.php' ?>

<script>
    $(document).ready(function() {
        $('#vertical-menu-btn').on('click', function() {
            setTimeout(function() {
                tabelMForm.columns.adjust().draw();
            }, 100);
        });

        let tabelMForm;

        tabelMForm = $('#table_mform').DataTable({
            scrollY: 500,
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
            ],
            ajax: {
                url: '<?= site_url('Form/getDataAcc') ?>',
                type: 'GET'
            },
            columnDefs: [{
                    targets: 0,
                    'data': null,
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    targets: 1,
                    'data': 'detail_created'
                },
                {
                    targets: 2,
                    'data': 'nf'
                },
                {
                    targets: 3,
                    'data': 'total'
                },
                {
                    targets: 4,
                    'data': null,
                    'className': 'text-center',
                    render: function(data, type, row) {
                        return `<button class='btn btn-sm btn-info' id="btn-edit" title="Add/Edit Budget"><i class="fas fa-pencil-alt"></i></button>`
                    }
                }
            ],
        });

        let tableLD;

        $('#table_mform tbody').on('click', '#btn-edit', function() {
            $('#load_details').DataTable().destroy();
            $('#tableT').DataTable().destroy();
            id = tabelMForm.row($(this).parents('tr')).data().id;
            nf = tabelMForm.row($(this).parents('tr')).data().nf;

            let m = tabelMForm.row($(this).parents('tr')).data().month;
            let d = tabelMForm.row($(this).parents('tr')).data().idDept;
            let c = tabelMForm.row($(this).parents('tr')).data().category;
            let y = tabelMForm.row($(this).parents('tr')).data().detail_created;

            let wadah_c = $('#cc');
            let wadah_d = $('#dc');
            let wadah_n = $('#mc');
            let wadah_y = $('#yc');

            if (c == 'Urgent') {
                wadah_c.html(`<span class="btn btn-danger btn-sm urg">${c}</span>`)
            } else {
                wadah_c.html(`<span class="btn btn-info btn-sm inf">${c}</span>`)
            };

            if (d == 1) {
                wadah_d.text('PRODUCTION')
            } else if (d == 2) {
                wadah_d.text('FINANCE & ACCOUNTING')
            } else if (d == 3) {
                wadah_d.text('MIS')
            } else if (d == 4) {
                wadah_d.text('PPIC')
            } else if (d == 5) {
                wadah_d.text('INDUSTRIAL ENGINEERING')
            } else if (d == 6) {
                wadah_d.text('GENERAL AFFAIRS')
            } else if (d == 7) {
                wadah_d.text('WAREHOUSE')
            } else if (d == 8) {
                wadah_d.text('SAMPLE')
            } else if (d == 9) {
                wadah_d.text('QUALITY CONTROL')
            } else if (d == 10) {
                wadah_d.text('CUTTING')
            } else if (d == 11) {
                wadah_d.text('MOLDING')
            } else if (d == 12) {
                wadah_d.text('PACKING')
            } else if (d == 13) {
                wadah_d.text('HUMAN RESOURCES')
            } else if (d == 14) {
                wadah_d.text('EXIM')
            } else if (d == 15) {
                wadah_d.text('MECHANIC')
            } else if (d == 16) {
                wadah_d.text('TROUBLESHOOTING')
            } else if (d == 17) {
                wadah_d.text('CADCAM')
            }


            wadah_n.text(m);
            wadah_y.text(y);

            tableLD = $('#load_details').DataTable({
                scrollY: 500,
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    left: 1,
                    right: 1
                },
                fixedHeader: {
                    header: true,
                    footer: false
                },
                ajax: {
                    url: '<?= site_url('Form/getDetailss') ?>',
                    type: 'GET',
                    data: {
                        'id_mform': id
                    }
                },
                columnDefs: [{
                        targets: 0,
                        'data': null,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        targets: 1,
                        'data': 'description'
                    },
                    {
                        targets: 2,
                        'data': 'no_po'
                    },
                    {
                        targets: 3,
                        className: 'text-center',
                        'data': 'stok'
                    },
                    {
                        targets: 4,
                        className: 'text-center',
                        'data': 'order'
                    },
                    {
                        targets: 5,
                        className: 'text-center',
                        'data': 'unit'
                    },
                    {
                        targets: 6,
                        className: 'text-center',
                        'data': 'price',
                        render: function(data, type, row) {
                            return parseFloat(data).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                        }
                    },
                    {
                        targets: 7,
                        'data': null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            let ord = row['order'];
                            let prc = row['price'];
                            return (prc * ord).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                        }
                    },
                    {
                        targets: 8,
                        'data': 'currency',
                        className: 'text-center'
                    },
                    {
                        targets: 9,
                        'data': 'payment',
                        render: function(data) {
                            if (data == 'T') {
                                return 'PO'
                            } else if (data == 'C') {
                                return 'Cash'
                            } else {
                                return ''
                            }
                        }
                    },
                    {
                        targets: 10,
                        'data': 'remarks'
                    },
                    {
                        targets: 11,
                        'data': 'detail_created'
                    },
                    {
                        targets: 12,
                        'data': 'date_modified'
                    },
                    {
                        targets: 13,
                        'data': null,
                        render: function(data, type, row) {
                            return `<label class='btn btn-sm btn-info' id="editDetails"><i class="fas fa-pencil-alt"></i></label>`
                        }
                    },
                ],
                order: [
                    [11, 'asc']
                ],
            });

            setTimeout(function() {
                tableLD.columns.adjust().draw();
            }, 500);

            tableT = $('#tableT').DataTable({
                searching: false,
                info: false,
                paging: false,
                autoWidth: false,
                ajax: {
                    url: '<?= site_url('Form/gtll') ?>',
                    data: {
                        id: id
                    },
                    type: 'POST',
                    dataType: 'json'
                },
                columnDefs: [{
                        targets: 0,
                        data: null,
                        render: function(data, type, row) {
                            return 'Total (Rp.)'
                        }
                    },
                    {
                        targets: 1,
                        data: 'end_c',
                        render: function(data, type, row) {
                            return 'Rp. ' + parseFloat(data).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                        }
                    },
                    {
                        targets: 2,
                        data: 'end_tf',
                        render: function(data, type, row) {
                            return 'Rp. ' + parseFloat(data).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                        }
                    },
                    {
                        targets: 3,
                        data: 'tf',
                        render: function(data, type, row) {
                            return 'Rp. ' + parseFloat(data).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                        }
                    },
                    {
                        targets: 4,
                        data: 'usd_final',
                        render: function(data, type, row) {
                            return '$ ' + parseFloat(data).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                        }
                    },
                ]
            });

            $('#modal_edit_title').text('Details form ' + nf);
            $('#id_mform').val(id);
            $('#modal_edit').prependTo("body").modal("show");
        });

        let showModalR = (description) => {
            $('#modal_add_remarks_label').text('Add ' + description + ' Remarks')
            $('#modal_add_remarks').appendTo("body").modal("show");
        }

        $('#button_status').on('click', function() {
            let timeNow = curTime();
            let ree = $('#app_remarks').val();
            $.ajax({
                url: '<?= base_url('Form_manager/acc') ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: $('#id_mform').val(),
                    appMan: $('#appMan').val(),
                    appAccp: $('#appAccp').val(),
                    appGm: $('#appGm').val(),
                    active: $('#active').val(),
                    status: $('#ss').val(),
                    date_modified: timeNow,
                    remarks_gm: ree,
                    role: "<?= $this->session->userdata("id_role") ?>"
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Budget Approved',
                        icon: 'success',
                        timer: 2000,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(function(data) {
                        tabelMForm.ajax.reload();
                        $('#app_remarks').val("");
                        $('#btn-close-detail-nup').click();
                    })
                }
            })
        });

        $('#table_mform tbody').on('click', '#btnAcc', function() {
            let id = tabelMForm.row($(this).parents('tr')).data().id;
            $('#statusR').val('2');
            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: "You're about to Accept this form",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No!'
            }).then(function(result) {
                if (result.value) {
                    let desc = $('#statusR').val();
                    if (desc == '2') {
                        desc = 'Approved';
                    } else if (desc == '3') {
                        desc = 'Declined';
                    }
                    $('#appMan').val(2);
                    $('#appAccp').val(2);
                    $('#appGm').val(2);
                    $('#active').val(2);
                    $('#id_mform').val(id);
                    $('#ss').val('Approved');
                    showModalR(desc);
                }
            })
        });

        $('#table_mform tbody').on('click', '#btnDec', function() {
            let id = tabelMForm.row($(this).parents('tr')).data().id;
            $('#statusR').val('3');
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: "You're about to Decline this form",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No!'
            }).then(function(result) {
                if (result.value) {
                    let desc = $('#statusR').val();
                    if (desc == '2') {
                        desc = 'Approved';
                    } else if (desc == '3') {
                        desc = 'Declined';
                    }
                    $('#appMan').val(2);
                    $('#appAccp').val(2);
                    $('#appGm').val(3);
                    $('#active').val(3);
                    $('#id_mform').val(id);
                    $('#ss').val('Declined');
                    showModalR(desc);
                }
            })
        });

        $('#load_details tbody').on('click', '#editDetails', function() {
            let id_vform = tableLD.row($(this).parents('tr')).data().id;
            console.log(id_vform)
            let description = tableLD.row($(this).parents('tr')).data().description;
            let order = tableLD.row($(this).parents('tr')).data().order;
            let unit = tableLD.row($(this).parents('tr')).data().unit;
            let payment = tableLD.row($(this).parents('tr')).data().payment;
            let remarks = tableLD.row($(this).parents('tr')).data().remarks;
            let price = tableLD.row($(this).parents('tr')).data().price;
            let defaultOpt = `<option id="default1" value="${payment}"></option><option id="opt1" value="T">PO</option><option id="opt2" value="C">Cash</option>`
            $('#modal_edit_title_modal').text('Edit ' + description)
            $('#modal_edit_modal').appendTo("body").modal("show");
            backdrop = $('<div class="modal-backdrop fade show" id="cobaModal"></div>');
            $('#modal_edit').prepend(backdrop);
            $('#editOrder').val(order);
            $('#vf').val(id_vform);
            $('#editUnit').val(unit);
            $('#editPayment').append(defaultOpt);
            $('#editRemarks').val(remarks);
            $('#editPrice').val(price);
            VIEW_INPUT_EDIT_PRICE.val(parseFloat(price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
            let def = $('#default1').val();
            $('#modal_edit_modal').on('hidden.bs.modal', function() {
                $("#cobaModal").remove();
                $("#default1").remove();
                $("#opt1").remove();
                $("#opt2").remove();
            });
            if (def == 'T') {
                $('#default1').text('PO');
            } else if (def == 'C') {
                $('#default1').text('Cash');
            };
            let p = parseFloat($('#editPrice').val());
            let totalBeforeKeyUp = parseFloat(p * order).toFixed(2);
            $('#editTotal').val(totalBeforeKeyUp);
            VIEW_INPUT_EDIT_TOTAL.val(totalBeforeKeyUp.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
            $('#editTotal').val(parseFloat(price * order).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
            $('#editOrder').on('keyup', function() {
                let totalEmodal = $('#editTotal');
                let f = parseFloat(price);
                let o = parseInt($(this).val());
                let totalHarga = (f * o).toFixed(2);
                totalEmodal.val(totalHarga);
                VIEW_INPUT_EDIT_TOTAL.val(totalHarga.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                VIEW_INPUT_EDIT_PRICE.val(parseFloat(f).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                console.log(f, o, totalEmodal.val());
                console.log(VIEW_INPUT_EDIT_TOTAL.val(), VIEW_INPUT_EDIT_PRICE.val());
            });
        });

        $('#btn-save-modal-edit-modal').on('click', function() {
            let timeNow = curTime();
            let dmf = $('#dmf');
            dmf.val(timeNow);

            let ord = $('#editOrder').val();
            let rmrks = $('#editRemarks').val();
            let dmfi = $('#dmf').val();
            let id_m = $('#id_mform').val();
            let no_po = $('#editNopo').val();
            let idvf = $('#vf').val();
            let uni = $('#editUnit').val();
            let prc = $('#editPrice').val();
            let pym = $('#editPayment').val();
            let priceDouble = $('#editPrice').val();

            if (ord == "") {
                Swal.fire(
                    'Warning!',
                    "Please input order",
                    "warning"
                )
            } else if (rmrks == "") {
                Swal.fire(
                    'Warning!',
                    "Please input remarks",
                    "warning"
                )
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('Form/u_modals') ?>",
                    dataType: 'JSON',
                    data: {
                        id_mform: id_m,
                        id: idvf,
                        order: ord,
                        remarks: rmrks,
                        date_modified: dmfi,
                        no_po: no_po,
                        unit: uni,
                        price: priceDouble,
                        payment: pym
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Data Has Been Saved!',
                            icon: 'success'
                        });
                        tableLD.ajax.reload(null, false);
                        tabelMForm.ajax.reload(null, false);
                        tableT.ajax.reload(null, false);
                        $('#closeModalEditModal').click();
                    }
                })
            }
        })

        $('#table_mform tbody').on('click', '.acc', function() {
            Swal.fire({
                icon: 'success',
                text: 'Has been accepted!',
                title: 'Accepted!'
            })
        });

        $('#table_mform tbody').on('click', '.inf', function() {
            Swal.fire({
                icon: 'info',
                text: "This form priority position is below than Urgent",
                title: 'Second'
            })
        });

        $('#table_mform tbody').on('click', '.urg', function() {
            Swal.fire({
                icon: 'info',
                text: "This form will get first priority",
                title: 'First'
            })
        });

        let curTime = () => {
            let date = new Date();
            let month = date.getMonth() + 1;
            let today = date.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + date.getDate()).slice(-2);
            let now = ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2) + ":" + ("0" + date.getSeconds()).slice(-2);
            return today + " " + now;
        }
    });
</script>
</body>

</html>