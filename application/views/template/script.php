</div>
<?php include APPPATH . 'views/template/plugin_bottom.php' ?>

<script>
    $(document).ready(function() {

        // Tabel list form number
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

        // Buat Form number baru
        $('#addNew').on('click', function() {
            $('#modal_new_title').text('Input New Form');
            $('#modal_new').prependTo("body").modal("show");
        });

        // Save Form number baru
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

        // Tambah atau hapus item / description yang ada di form number
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

        // Save item / description baru
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
        });

        // Aksi saat modal edit item / description di close
        $('#modal_edit_modal').on('hidden.bs.modal', function() {
            $("#cobaModal").remove();
            $("#default1").remove();
            $("#opt1").remove();
            $("#opt2").remove();
            $('#modal_edit').prependTo("body").modal("show");
        });

        // Edit item / description dan budget
        $('#load_details tbody').on('click', '#editDetails', function() {
            let id_vform = tableLD.row($(this).parents('tr')).data().id;
            let id_mform = tableLD.row($(this).parents('tr')).data().id_mform;
            let description = tableLD.row($(this).parents('tr')).data().description;
            let budget = tableLD.row($(this).parents('tr')).data().budget;

            $('#modal_edit').modal("hide");
            $('#modal_edit_title_modal').text('Edit ' + description)
            $('#modal_edit_modal').appendTo("body").modal("show");

            $('#vf').val(id_vform);
            $('#idMform').val(id_mform);
            $('#editPrice').val(budget);
            $('#editDescription').val(description);
        });

        // Save hasil edit item / description
        $('#btn-save-modal-edit-modal').on('click', function() {
            let budget = $('#editPrice').val();
            let description = $('#editDescription').val();
            let id_vform = $('#vf').val();
            let id_mform = $('#idMform').val();

            if (budget == "") {
                Swal.fire(
                    'Warning!',
                    "Please input budget",
                    "warning"
                )
            } else if (description == "") {
                Swal.fire(
                    'Warning!',
                    "Please input description",
                    "warning"
                )
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('Form/u_modal') ?>",
                    dataType: 'JSON',
                    data: {
                        id_mform: id_mform,
                        id_vform: id_vform,
                        description: description,
                        budget: budget,
                        date_modified: "<?= Date('Y-m-d H:i:s') ?>",
                        app: 0,
                        app1: "<?= Date('Y-m-d H:i:s') ?>"
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
        });

        // Hapus item / description
        $('#load_details tbody').on('click', '#delDetails', function() {
            let id_vform = tableLD.row($(this).parents('tr')).data().id;
            let id_mform = $('#id_mform').val();

            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                html: '<p>' + 'Are you sure?' + '<br>' + "this action can't be undo" + '</p>',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'No',
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url('Form/del_vform') ?>',
                        type: 'POST',
                        data: {
                            id_vform: id_vform,
                            id_mform: id_mform,
                            app: 0,
                            app1: "<?= Date('Y-m-d H:i:s') ?>"

                        },
                        success: function(data) {
                            Swal.fire('Success!', 'Data Deleted', 'success').then(function() {
                                tableLD.ajax.reload();
                                tableT.ajax.reload();
                                tabelMForm.ajax.reload();
                            })
                        }
                    })
                }
            })
        });

        // expand / minimize sidebar
        $('#vertical-menu-btn').on('click', function() {
            tabelMForm.columns.adjust().draw();
        });

    })
</script>
</body>

</html>