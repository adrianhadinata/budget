</div>
<?php include APPPATH . 'views/template/plugin_bottom.php' ?>

<script>
    $(document).ready(function() {
        $('#loading').hide();

        $('#vertical-menu-btn').on('click', function() {
            tabelMForm.columns.adjust().draw();
        });

        let tabelMForm;
        let tableT;

        tableT = $('#tableT').DataTable({
            searching: false,
            info: false,
            paging: false
        });

        tabelMForm = $('#table_mform').DataTable({
            autoWidth: false,
            info: true,
            paging: true,
            scrollX: true,
            ajax: {
                url: '<?= site_url('Form/getDataM') ?>',
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
                    'data': 'category',
                    render: function(data, type, row) {
                        if (data == 'Urgent') {
                            return `<span class="btn btn-danger btn-sm urg">${data}</label>`
                        } else if (data == 'Monthly') {
                            return `<span class="btn btn-info btn-sm inf">${data}</label>`
                        }

                    }
                },
                {
                    targets: 3,
                    'data': 'month'
                },
                {
                    targets: 4,
                    'data': 'idDept',
                    render: function(data) {
                        if (data == 1) {
                            return 'PRODUCTION'
                        } else if (data == 2) {
                            return 'FINANCE & ACCOUNTING'
                        } else if (data == 3) {
                            return 'MIS'
                        } else if (data == 4) {
                            return 'PPIC'
                        } else if (data == 5) {
                            return 'INDUSTRIAL ENGINEERING'
                        } else if (data == 6) {
                            return 'GENERAL AFFAIRS'
                        } else if (data == 7) {
                            return 'WAREHOUSE'
                        } else if (data == 8) {
                            return 'SAMPLE'
                        } else if (data == 9) {
                            return 'QUALITY CONTROL'
                        } else if (data == 10) {
                            return 'CUTTING'
                        } else if (data == 11) {
                            return 'MOLDING'
                        } else if (data == 12) {
                            return 'PACKING'
                        } else if (data == 13) {
                            return 'HUMAN RESOURCES'
                        } else if (data == 14) {
                            return 'EXIM'
                        } else if (data == 15) {
                            return 'MECHANIC'
                        } else if (data == 16) {
                            return 'TROUBLESHOOTING'
                        } else if (data == 17) {
                            return 'CADCAM'
                        }
                    }
                },
                {
                    targets: 5,
                    'data': 'nf'
                },
                {
                    targets: 6,
                    'data': null,
                    'className': 'text-center',
                    render: function(data, type, row) {
                        return `<label class='btn btn-sm btn-info' id="btn-edit"><i class="fas fa-pencil-alt"></i></label>`
                    }
                },
                {
                    targets: 7,
                    'data': null,
                    'className': 'text-center',
                    render: function(data, type, row) {
                        return `<label class='btn btn-sm btn-success' id="btnAcc"><i class="fas fa-check"></i></label> <label class='btn btn-sm btn-danger' id="btnDec"><i class="fas fa-times"></i></label>`
                    }
                }
            ],
            order: [
                [2, 'desc']
            ]
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

            let wadah_c = $('#cc1');
            let wadah_d = $('#dc1');
            let wadah_n = $('#mc1');
            let wadah_y = $('#yc1');

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
                autoWidth: true,
                info: false,
                paging: false,
                scrollX: true,
                destroy: true,
                scrollY: 300,
                scrollCollapse: true,
                fixedColumns: {
                    left: 0,
                    right: 1
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
                            return data.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
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
                            return `<label class='btn btn-sm btn-info' id="editDetails"><i class="fas fa-pencil-alt"></i></label> <!-- <label class='btn btn-sm btn-danger' id="delDetails"><i class="fas fa-trash-alt"></i></label> -->`
                        }
                    },
                ],
                order: [
                    [11, 'asc']
                ],
                initComplete: function() {
                    setTimeout(function() {
                        tableLD.columns.adjust().draw();
                    }, 1000);
                }
            });
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
        })

        $('#table_mform tbody').on('click', '#btnAcc', function() {
            let id = tabelMForm.row($(this).parents('tr')).data().id;
            let nf = tabelMForm.row($(this).parents('tr')).data().nf;
            let date = new Date();
            let month = date.getMonth() + 1;
            let today = date.getFullYear() + "-" + month + "-" + 0 + date.getDate();
            let now = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
            let timeNow = today + " " + now;

            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: "You're about to Accept this form",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No!',
            }).then(function(result) {
                if (result.value) {
                    let date = new Date();
                    let now = date.getHours();
                    let regards;
                    if (now > 3 && now <= 10) {
                        regards = 'Good Morning,'
                    } else if (now > 10 && now <= 18) {
                        regards = 'Good Afternoon,'
                    } else {
                        regards = 'Good Evening'
                    }
                    let name = '<?= $this->session->userdata('purc_name') ?>';
                    let number = '<?= $this->session->userdata('purc_number') ?>';
                    let message = regards + ' ' + name + ' you have new budget form waiting to be checked (' + nf + '). Please check at E-BUDGETING Website with your Account. Thank You';
                    // let success_send = 'Budget Form Approved & Successfully Send WhatsApp Message to ' + name;
                    let success_send = 'Budget Form Approved';
                    let appMan = 2;
                    let appAccp = 1;
                    let appGm = 1;
                    let active = 1;
                    sendWa(nf, name, number, id, timeNow, message, success_send, appMan, appAccp, appGm, active);
                }
            })
        });

        $('#table_mform tbody').on('click', '#btnDec', function() {
            let id = tabelMForm.row($(this).parents('tr')).data().id;
            let nf = tabelMForm.row($(this).parents('tr')).data().nf;
            let date = new Date();
            let month = date.getMonth() + 1;
            let today = date.getFullYear() + "-" + month + "-" + 0 + date.getDate();
            let now = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
            let timeNow = today + " " + now;

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
                    let appMan = 3;
                    let appAccp = 4;
                    let appGm = 4;
                    let active = 3;


                    let date = new Date();
                    let now = date.getHours();
                    let regards;
                    if (now > 3 && now <= 10) {
                        regards = 'Good Morning,'
                    } else if (now > 10 && now <= 18) {
                        regards = 'Good Afternoon,'
                    } else {
                        regards = 'Good Evening'
                    }
                    let name = '<?= $this->session->userdata('input_name') ?>';
                    let number = '<?= $this->session->userdata('input_phone') ?>';

                    let message = regards + ' ' + name + ' your department budget form number ' + nf + ' has been declied by your manager department. Please check at E-BUDGETING Website with your Account for the details. Thank You';
                    // let success_send = 'Budget Form Declined & Successfully Send WhatsApp Message to ' + name;
                    let success_send = 'Budget Form Declined';

                    sendWa(nf, name, number, id, timeNow, message, success_send, appMan, appAccp, appGm, active);
                }
            })
        });


        $('#load_details tbody').on('click', '#editDetails', function() {
            let id_vform = tableLD.row($(this).parents('tr')).data().id;
            let description = tableLD.row($(this).parents('tr')).data().description;
            let order = tableLD.row($(this).parents('tr')).data().order;
            let unit = tableLD.row($(this).parents('tr')).data().unit;
            let payment = tableLD.row($(this).parents('tr')).data().payment;
            let remarks = tableLD.row($(this).parents('tr')).data().remarks;
            let price = tableLD.row($(this).parents('tr')).data().price;
            let defaultOpt = `<option id="default1" value="${payment}">-- Payment Methods --</option>`

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
            $('#editTotal').val(parseFloat(p * order).toFixed(2));

            $('#editOrder').on('keyup', function() {
                let totalEmodal = $('#editTotal');
                let f = parseFloat(price);
                let o = parseInt($(this).val());
                totalEmodal.val((f * o).toFixed(2));
            });
        });

        $('#btn-save-modal-edit-modal').on('click', function() {
            let date = new Date();
            let month = date.getMonth() + 1;
            let today = date.getFullYear() + "-" + month + "-" + 0 + date.getDate();
            let now = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
            let timeNow = today + " " + now;
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
                        price: prc,
                        payment: pym
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Data Has Been Saved!',
                            icon: 'success'
                        });
                        tableLD.ajax.reload();
                        tabelMForm.ajax.reload();
                        tableT.ajax.reload();
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

        function sendWa(nf, name, number, id, timeNow, message, success_send, appMan, appAccp, appGm, active) {
            $('#loading').show();
            $('#vertical-menu-btn').click();

            $.ajax({
                url: "http://192.168.10.3:8080/send-message",
                type: "POST",
                data: {
                    'number': number,
                    'message': message,
                },
            success: function(data) {
            $.ajax({
                url: '<?= base_url('Form_manager/acc') ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    appMan: appMan,
                    appAccp: appAccp,
                    appGm: appGm,
                    active: active,
                    date_modified: timeNow,
                    role: "<?= $this->session->userdata("id_role") ?>"
                },
                success: function(data) {
                    let first = 0;
                    let second = 1;
                    let final = 0;
                    if (active == 3) {
                        Swal.fire({
                            title: 'Success!',
                            text: success_send,
                            icon: 'success',
                            timer: 2000,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        }).then(function(data) {
                            tabelMForm.ajax.reload();
                            $('#loading').hide();
                            $('#vertical-menu-btn').click();
                        })
                    } else {
                        $.ajax({
                            url: "<?= base_url('Form/counting') ?>",
                            type: "POST",
                            data: {
                                id: id,
                                first: first,
                                second: second,
                                final: final,
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: success_send,
                                    icon: 'success',
                                    timer: 2000,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                }).then(function(data) {
                                    tabelMForm.ajax.reload();
                                    $('#loading').hide();
                                    $('#vertical-menu-btn').click();
                                })
                            }
                        })
                    }


                }
            })
            },
            error: function(request, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: "Server Offline, Please contact administator",
                    icon: 'error',
                    timer: 2000,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                }).then(function(data) {
                    tabelMForm.ajax.reload();
                    $('#loading').hide();
                    $('#vertical-menu-btn').click();
                })
            }
            });
        };
    })
</script>
</body>

</html>