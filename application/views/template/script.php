</div>
<?php include APPPATH . 'views/template/plugin_bottom.php' ?>

<script>
    $(document).ready(function() {
        let tabelMForm;
        tabelMForm = $('#table_mform').DataTable({
            autoWidth: true,
            info: true,
            paging: true,
            scrollX: true,
            fixedColumns: {
                left: 0,
                right: 1
            },
            ajax: {
                url: '<?= site_url('Form/getData') ?>',
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
                    'data': 'nf'
                },
                {
                    targets: 2,
                    'data': 'detail_created'
                },
                {
                    targets: 3,
                    'data': 'app',
                    'className': 'text-center',
                    render: function(data, type, row) {
                        if (data == "1") {
                            return `<label class='btn btn-sm btn-success acc'>${(row.app1) ? row.app1 : "0000-00-00 00:00:00"}</label>`
                        }
                        return `<label class='btn btn-sm btn-primary waiting'><i class="fas fa-minus"></i></label>`
                    }

                },
                {
                    targets: 4,
                    'data': null,
                    width: '10%',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (row['app'] == "1") {
                            return `<span class="btn btn-sm btn-success" id="btnApp">Approved</span>`
                        } else {
                            return `<button class='btn btn-sm btn-info' id="btn-edit" title="Add/Edit Budget"><i class="fas fa-pencil-alt"></i></button>`
                        }
                    }
                },
            ]
        });

        $('#addNew').on('click', function() {
            $('#modal_new_title').text('Input New Form');
            $('#modal_new').prependTo("body").modal("show");
        });

        $('#saveModalNewForm').on('click', function() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Form/getDataSave') ?>",
                dataType: "JSON",
                data: {
                    nf: $("#nomorInput").val(),
                    detail_created: $("#dateCreated").val(),
                    date_modified: $("#dateCreated").val(),
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Data Has Been Saved!',
                        icon: 'success'
                    }).then(function() {
                        window.location.reload();
                    });
                }
            })
        });

        $('#table_mform tbody').on('click', '#btn-edit', function() {

            let id = tabelMForm.row($(this).parents('tr')).data().id;
            let nf = tabelMForm.row($(this).parents('tr')).data().nf;
            let y = tabelMForm.row($(this).parents('tr')).data().detail_created;

            $('#load_details').DataTable().destroy();
            $('#tableT').DataTable().destroy();

            tableLD = $('#load_details').DataTable({
                autoWidth: false,
                info: false,
                paging: false,
                scrollX: true,
                scrollY: 300,
                scrollCollapse: true,
                destroy: true,
                fixedColumns: {
                    left: 0,
                    right: 1
                },
                ajax: {
                    url: '<?= site_url('Form/getDetails') ?>',
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
                        'data': 'description',
                    },
                    {
                        targets: 2,
                        className: 'text-center',
                        'data': 'budget',
                        render: function(data, type, row) {
                            return parseFloat(data).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                        }
                    },
                    {
                        targets: 3,
                        'data': null,
                        render: function(data, type, row) {
                            return `<label class='btn btn-sm btn-info' id="editDetails"><i class="fas fa-pencil-alt"></i></label> <label class='btn btn-sm btn-danger' id="delDetails"><i class="fas fa-trash-alt"></i></label>`
                        }
                    },
                ],
            });

            setTimeout(function() {
                tableLD.columns.adjust().draw();
            }, 1000);

            tableT = $('#tableT').DataTable({
                searching: false,
                info: false,
                paging: false,
                autoWidth: false,
                ajax: {
                    url: '<?= site_url('Form/getTotal') ?>',
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
                            return 'Total'
                        }
                    },
                    {
                        targets: 1,
                        data: 'total_budget',
                        render: function(data, type, row) {
                            return 'Rp. ' + parseFloat(data).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                        }
                    },
                ]
            });

            $('#modal_edit_title').text('Details form ' + nf);
            $('#id_mform').val(id);
            $('#modal_edit').prependTo("body").modal("show");
        });

        $('#btn-details').on('click', function() {
            let description = $('#description').val();
            let budget = $('#budget').val();
            let id_mform = $('#id_mform').val();

            if (description == "") {
                Swal.fire(
                    'Warning!',
                    "Please input item",
                    "warning"
                )
            } else if (budget == "") {
                Swal.fire(
                    'Warning!',
                    "Please input order",
                    "warning"
                )
            } else {
                $.ajax({
                    url: '<?= base_url('Form/getDataSaveModal') ?>',
                    data: {
                        description: description,
                        budget: budget,
                        id_mform: id_mform,
                        detail_created: "<?= Date('Y-m-d H:i:s') ?>",
                        date_modified: "<?= Date('Y-m-d H:i:s') ?>",
                        app: 0,
                        app1: "<?= Date('Y-m-d H:i:s') ?>"
                    },
                    type: "POST",
                    dataType: 'JSON',
                    success: function(data) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Data Has Been Saved!',
                            icon: 'success',
                            timer: 1500
                        });

                        $("#description").val("");
                        $('#budget').val("");

                        tableLD.ajax.reload();
                        tabelMForm.ajax.reload();
                        tableT.ajax.reload();
                    }
                })
            }
        })

        // $('#tabletotal tfoot th').each(function() {
        //     let title = $(this).text();
        //     $(this).html('<input class="form-control" type="text" id="' + title + '" />');
        // });

        // let table_total = $('#tabletotal').DataTable({
        //     autoWidth: false,
        //     info: false,
        //     paging: false,
        //     scrollX: false,
        //     serverSide: false,
        //     ajax: {
        //         url: '<?= base_url('Home/table') ?>',
        //         dataType: 'json'
        //     },
        //     columnDefs: [{
        //             targets: 0,
        //             'data': null,
        //             className: 'text-center',
        //             render: function(data, type, row, meta) {
        //                 return meta.row + meta.settings._iDisplayStart + 1;
        //             }
        //         },
        //         {
        //             targets: 1,
        //             data: 'nf'
        //         },
        //         {
        //             targets: 2,
        //             data: 'detail_created'
        //         },
        //         {
        //             targets: 3,
        //             data: 'name'
        //         },
        //         {
        //             targets: 4,
        //             data: 'month'

        //         },
        //         {
        //             targets: 5,
        //             data: 'category',
        //             name: 'category',
        //             render: function(data, type, row) {
        //                 if (data == 'Urgent') {
        //                     return `<button class="btn btn-danger">Urgent</button>`
        //                 } else {
        //                     return `<button class="btn btn-primary">Monthly</button>`
        //                 }
        //             }

        //         },
        //         {
        //             targets: 6,
        //             data: 'active',
        //             render: function(data, type, row) {
        //                 if (data == 1) {
        //                     return `<button class="btn btn-primary">Waiting</button>`
        //                 } else if (data == 2) {
        //                     return `<button class="btn btn-success">Approved</button>`
        //                 } else {
        //                     return `<button class="btn btn-danger">Declined</button>`
        //                 }
        //             }
        //         },
        //     ],
        //     initComplete: function() {
        //         this.api()
        //             .columns()
        //             .every(function() {
        //                 var that = this;
        //                 $('input', this.footer()).on('keyup change clear', function() {
        //                     if (that.search() !== this.value) {
        //                         that.search(this.value).draw();
        //                     }
        //                 });
        //             });
        //     },
        // });


        // let tableT;
        // tableT = $('#tableT').DataTable({
        //     searching: false,
        //     info: false,
        //     paging: false
        // });

        // let tableLD;
        // $('#table_mform tbody').on('click', '#btn-sum', function() {
        //     nf = tabelMForm.row($(this).parents('tr')).data().nf;
        //     let id = tabelMForm.row($(this).parents('tr')).data().id;
        //     let m = tabelMForm.row($(this).parents('tr')).data().month;
        //     let d = tabelMForm.row($(this).parents('tr')).data().idDept;
        //     let c = tabelMForm.row($(this).parents('tr')).data().category;
        //     let y = tabelMForm.row($(this).parents('tr')).data().detail_created;
        //     let f = tabelMForm.row($(this).parents('tr')).data().date_modified;
        //     $('#mform_id').val(id);
        //     $('#printable_title').text('Budget Form ' + nf);
        //     let wadah_c = $('#cc');
        //     let wadah_c2 = $('#cc2');
        //     let wadah_d = $('#dc');
        //     let wadah_d2 = $('#dc2');
        //     let wadah_n = $('#mc');
        //     let wadah_n2 = $('#mc2');
        //     let wadah_y = $('#yc');
        //     let wadah_y2 = $('#yc2');
        //     let wadah_f = $('#ya');
        //     let wadah_f2 = $('#ya2');
        //     if (c == 'Urgent') {
        //         wadah_c.html(`<span class="btn btn-danger btn-sm urg">${c}</span>`)
        //         wadah_c2.html(`<span class="btn btn-danger btn-sm urg">${c}</span>`)
        //     } else {
        //         wadah_c.html(`<span class="btn btn-info btn-sm inf">${c}</span>`)
        //         wadah_c2.html(`<span class="btn btn-info btn-sm inf">${c}</span>`)
        //     };
        //     if (d == 1) {
        //         wadah_d.text('PRODUCTION')
        //         wadah_d2.text('PRODUCTION')
        //     } else if (d == 2) {
        //         wadah_d.text('FINANCE & ACCOUNTING')
        //         wadah_d2.text('FINANCE & ACCOUNTING')
        //     } else if (d == 3) {
        //         wadah_d.text('MIS')
        //         wadah_d2.text('MIS')
        //     } else if (d == 4) {
        //         wadah_d.text('PPIC')
        //         wadah_d2.text('PPIC')
        //     } else if (d == 5) {
        //         wadah_d.text('INDUSTRIAL ENGINEERING')
        //         wadah_d2.text('INDUSTRIAL ENGINEERING')
        //     } else if (d == 6) {
        //         wadah_d.text('GENERAL AFFAIRS')
        //         wadah_d2.text('GENERAL AFFAIRS')
        //     } else if (d == 7) {
        //         wadah_d.text('WAREHOUSE')
        //         wadah_d2.text('WAREHOUSE')
        //     } else if (d == 8) {
        //         wadah_d.text('SAMPLE')
        //         wadah_d2.text('SAMPLE')
        //     } else if (d == 9) {
        //         wadah_d.text('QUALITY CONTROL')
        //         wadah_d2.text('QUALITY CONTROL')
        //     } else if (d == 10) {
        //         wadah_d.text('CUTTING')
        //         wadah_d2.text('CUTTING')
        //     } else if (d == 11) {
        //         wadah_d.text('MOLDING')
        //         wadah_d2.text('MOLDING')
        //     } else if (d == 12) {
        //         wadah_d.text('PACKING')
        //         wadah_d2.text('PACKING')
        //     } else if (d == 13) {
        //         wadah_d.text('HUMAN RESOURCES')
        //         wadah_d2.text('HUMAN RESOURCES')
        //     } else if (d == 14) {
        //         wadah_d.text('EXIM')
        //         wadah_d2.text('EXIM')
        //     } else if (d == 15) {
        //         wadah_d.text('MECHANIC')
        //         wadah_d2.text('MECHANIC')
        //     } else if (d == 16) {
        //         wadah_d.text('TROUBLESHOOTING')
        //         wadah_d2.text('TROUBLESHOOTING')
        //     } else if (d == 17) {
        //         wadah_d.text('CADCAM')
        //         wadah_d2.text('CADCAM')
        //     }
        //     wadah_n.text(m);
        //     wadah_n2.text(m);
        //     wadah_y.text(y);
        //     wadah_y2.text(y);
        //     wadah_f.html(`<span class="text-white bg-success">${f}</span>`);
        //     wadah_f2.html(`<span class="text-white bg-success">${f}</span>`);
        //     let ld = $.ajax({
        //         url: '<?= site_url('Form/call') ?>',
        //         data: {
        //             id: id
        //         },
        //         type: 'POST',
        //         dataType: 'json'
        //     });
        //     $.when(ld).done(function(ldm) {
        //         $('#modal_sum_title').text('Detail Form ' + nf);
        //         $('#modal_sum').prependTo("body").modal("show");
        //         let increment = 0;
        //         $('#teer').empty();
        //         $('#teer1').empty();
        //         $.each(ldm, function(i, item) {
        //             increment++
        //             $('#teer').append(`<tr>
        //             <td>${increment}</td>
        //             <td>${item.descr}</td>
        //             <td>${item.final_no_po}</td>
        //             <td>${item.stok}</td>
        //             <td>${item.order}</td>
        //             <td>${item.final_o}</td>
        //             <td>${item.unit}</td>
        //             <td>${parseFloat(item.price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</td>
        //             <td>${parseFloat(item.final_price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</td>
        //             <td>${parseFloat(item.tfi).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</td>
        //             <td>${parseFloat(item.tf).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</td>
        //             <td style="text-align:center;">${item.currency}</td>
        //             <td>${item.final_p}</td>
        //             <td>${item.remarks}</td>
        //             </tr>`);
        //             $('#teer1').append(`<tr>
        //             <td>${increment}</td>
        //             <td>${item.descr}</td>
        //             <td>${item.final_no_po}</td>
        //             <td>${item.stok}</td>
        //             <td>${item.order}</td>
        //             <td>${item.final_o}</td>
        //             <td>${item.unit}</td>
        //             <td>${parseFloat(item.price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</td>
        //             <td>${parseFloat(item.final_price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</td>
        //             <td>${parseFloat(item.tfi).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</td>
        //             <td>${parseFloat(item.tf).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</td>
        //             <td style="text-align:center;">${item.currency}</td>
        //             <td>${item.final_p}</td>
        //             <td>${item.remarks}</td>
        //             </tr>`);
        //         });
        //         let tl = $.ajax({
        //             url: '<?= site_url('Form/gtl') ?>',
        //             data: {
        //                 id: id
        //             },
        //             type: 'POST',
        //             dataType: 'json'
        //         });
        //         $.when(tl).done(function(tlv) {
        //             $('#tfc').text('Rp. ' + parseFloat(tlv.data[0].ori_c).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#tft').text('Rp. ' + parseFloat(tlv.data[0].ori_tf).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#ttl').text('Rp. ' + parseFloat(tlv.data[0].tfi).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#tfic').text('Rp. ' + parseFloat(tlv.data[0].end_c).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#tfit').text('Rp. ' + parseFloat(tlv.data[0].end_tf).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#ttli').text('Rp. ' + parseFloat(tlv.data[0].tf).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#usd').text('$ ' + parseFloat(tlv.data[0].usd_first).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#usdi').text('$ ' + parseFloat(tlv.data[0].usd_final).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));

        //             $('#tfc11').text('Rp. ' + parseFloat(tlv.data[0].ori_c).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#tft11').text('Rp. ' + parseFloat(tlv.data[0].ori_tf).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#ttl11').text('Rp. ' + parseFloat(tlv.data[0].tfi).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#tfic1').text('Rp. ' + parseFloat(tlv.data[0].end_c).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#tfit1').text('Rp. ' + parseFloat(tlv.data[0].end_tf).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#ttli1').text('Rp. ' + parseFloat(tlv.data[0].tf).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#usd1').text('$ ' + parseFloat(tlv.data[0].usd_first).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //             $('#usdi11').text('$ ' + parseFloat(tlv.data[0].usd_final).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //         })
        //     })
        // });

        // $('#table_mform tbody').on('click', '#btnDel', function() {
        //     id = tabelMForm.row($(this).parents('tr')).data().id;
        //     Swal.fire({
        //         icon: 'warning',
        //         title: 'Warning!',
        //         html: '<p>' + 'Are you sure?' + '<br>' + "this action can't be undo" + '</p>',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, Delete!',
        //         cancelButtonText: 'No',
        //     }).then(function(result) {
        //         if (result.value) {
        //             $.ajax({
        //                 url: '<?= base_url('Form/del') ?>',
        //                 type: 'POST',
        //                 data: {
        //                     id: id
        //                 },
        //                 success: function(data) {
        //                     Swal.fire('Success!', 'Data Deleted', 'success').then(function() {
        //                         window.location.reload()
        //                     })
        //                 }
        //             })
        //         }
        //     })
        // });

        // $('#table_mform tbody').on('click', '#btnApp', function() {
        //     let remarksGm = tabelMForm.row($(this).parents('tr')).data().remarks_gm;
        //     Swal.fire({
        //         title: 'Remarks From Factory Manager',
        //         icon: 'info',
        //         text: remarksGm
        //     })
        // })

        // $('#vertical-menu-btn').on('click', function() {
        //     tabelMForm.columns.adjust().draw();
        // });

        // $('#load_details tbody').on('click', '#editDetails', function() {
        //     let id_vform = tableLD.row($(this).parents('tr')).data().id;
        //     let description = tableLD.row($(this).parents('tr')).data().description;
        //     let order = tableLD.row($(this).parents('tr')).data().order;
        //     let unit = tableLD.row($(this).parents('tr')).data().unit;
        //     let payment = tableLD.row($(this).parents('tr')).data().payment;
        //     let remarks = tableLD.row($(this).parents('tr')).data().remarks;
        //     let price = tableLD.row($(this).parents('tr')).data().price;
        //     let defaultOpt = `<option id="default1" value="${payment}">-- Payment Methods --</option>`
        //     $('#modal_edit_title_modal').text('Edit ' + description)
        //     $('#modal_edit_modal').appendTo("body").modal("show");
        //     backdrop = $('<div class="modal-backdrop fade show" id="cobaModal"></div>');
        //     $('#modal_edit').prepend(backdrop);
        //     $('#editOrder').val(order);
        //     $('#vf').val(id_vform);
        //     $('#editUnit').val(unit);
        //     $('#editPayment').append(defaultOpt);
        //     $('#editRemarks').val(remarks);
        //     $('#editPrice').val(price);
        //     VIEW_INPUT_EDIT_PRICE.val(parseFloat(price).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //     let def = $('#default1').val();
        //     $('#modal_edit_modal').on('hidden.bs.modal', function() {
        //         $("#cobaModal").remove();
        //         $("#default1").remove();
        //         $("#opt1").remove();
        //         $("#opt2").remove();
        //     });
        //     if (def == 'T') {
        //         $('#default1').text('PO');
        //     } else if (def == 'C') {
        //         $('#default1').text('Cash');
        //     };
        //     let p = parseFloat($('#editPrice').val());
        //     let totalBeforeKeyUp = parseFloat(p * order).toFixed(2);
        //     $('#editTotal').val(totalBeforeKeyUp);
        //     VIEW_INPUT_EDIT_TOTAL.val(totalBeforeKeyUp.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //     $('#editOrder').on('keyup', function() {
        //         let totalEmodal = $('#editTotal');
        //         let f = parseFloat(price);
        //         let o = parseInt($(this).val());
        //         let totalHarga = (f * o).toFixed(2);
        //         totalEmodal.val(totalHarga);
        //         VIEW_INPUT_EDIT_TOTAL.val(totalHarga.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //         VIEW_INPUT_EDIT_PRICE.val(parseFloat(f).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        //         console.log(f, o, totalEmodal.val());
        //         console.log(VIEW_INPUT_EDIT_TOTAL.val(), VIEW_INPUT_EDIT_PRICE.val());
        //     });
        // });

        // $('#btn-save-modal-edit-modal').on('click', function() {
        //     let date = new Date();
        //     let month = date.getMonth() + 1;
        //     let today = date.getFullYear() + "-" + month + "-" + 0 + date.getDate();
        //     let now = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
        //     let timeNow = today + " " + now;
        //     let dmf = $('#dmf');
        //     dmf.val(timeNow);
        //     let ord = $('#editOrder').val();
        //     let rmrks = $('#editRemarks').val();
        //     let dmfi = $('#dmf').val();
        //     let id_m = $('#id_mform').val();
        //     let no_po = $('#editNopo').val();
        //     let idvf = $('#vf').val();
        //     let uni = $('#editUnit').val();
        //     let prc = $('#editPrice').val();
        //     let pym = $('#editPayment').val();
        //     if (ord == "") {
        //         Swal.fire(
        //             'Warning!',
        //             "Please input order",
        //             "warning"
        //         )
        //     } else if (rmrks == "") {
        //         Swal.fire(
        //             'Warning!',
        //             "Please input remarks",
        //             "warning"
        //         )
        //     } else {
        //         $.ajax({
        //             type: "POST",
        //             url: "<?= site_url('Form/u_modal') ?>",
        //             dataType: 'JSON',
        //             data: {
        //                 appMan: 1,
        //                 appAccp: 1,
        //                 appGm: 1,
        //                 active: 1,
        //                 id_mform: id_m,
        //                 id: idvf,
        //                 order: ord,
        //                 remarks: rmrks,
        //                 date_modified: dmfi,
        //                 no_po: no_po,
        //                 unit: uni,
        //                 price: prc,
        //                 payment: pym
        //             },
        //             success: function(data) {
        //                 Swal.fire({
        //                     title: 'Success',
        //                     text: 'Data Has Been Saved!',
        //                     icon: 'success'
        //                 });
        //                 tableLD.ajax.reload();
        //                 tabelMForm.ajax.reload();
        //                 tableT.ajax.reload();
        //             }
        //         })
        //     }
        // })

        // $('#load_details tbody').on('click', '#delDetails', function() {
        //     let id_vform = tableLD.row($(this).parents('tr')).data().id;
        //     let id_mform = $('#id_mform').val();
        //     Swal.fire({
        //         icon: 'warning',
        //         title: 'Warning!',
        //         html: '<p>' + 'Are you sure?' + '<br>' + "this action can't be undo" + '</p>',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, Delete!',
        //         cancelButtonText: 'No',
        //     }).then(function(result) {
        //         if (result.value) {
        //             $.ajax({
        //                 url: '<?= base_url('Form/del_vform') ?>',
        //                 type: 'POST',
        //                 data: {
        //                     id: id_vform,
        //                     id_mform: id_mform
        //                 },
        //                 success: function(data) {
        //                     Swal.fire('Success!', 'Data Deleted', 'success').then(function() {
        //                         tableLD.ajax.reload();
        //                         tableT.ajax.reload();
        //                         tabelMForm.ajax.reload();
        //                     })
        //                 }
        //             })
        //         }
        //     })
        // });

    })
</script>
</body>

</html>