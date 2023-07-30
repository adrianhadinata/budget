</div>
<?php include APPPATH . 'views/template/plugin_bottom.php' ?>

<script>
    $(document).ready(function() {
        let tabelMForm;
        let tableT;
        let tableLD;

        // expand / minimize sidebar
        $('#vertical-menu-btn').on('click', function() {
            tabelMForm.columns.adjust().draw();
        });

        // tabel total
        tableT = $('#tableT').DataTable({
            searching: false,
            info: false,
            paging: false
        });

        // tabel list nomor form
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
                    'data': 'nf'
                },
                {
                    targets: 2,
                    'data': 'detail_created'
                },
                {
                    targets: 3,
                    'data': null,
                    'className': 'text-center',
                    render: function() {
                        return `<label class='btn btn-sm btn-primary waiting'><i class="fas fa-minus"></i></label>`
                    }
                },
                {
                    targets: 4,
                    'data': null,
                    'className': 'text-center',
                    render: function(data, type, row) {
                        return `<label class='btn btn-sm btn-success' id="btnAcc"><i class="fas fa-check"></i></label>  <label class='btn btn-sm btn-info' id="btn-edit" title="Add/Edit Budget"><i class="fas fa-pencil-alt"></i></label>`
                    }
                }
            ]
        });

        // acc nomor form
        $('#table_mform tbody').on('click', '#btnAcc', function() {
            let id = tabelMForm.row($(this).parents('tr')).data().id;
            let nf = tabelMForm.row($(this).parents('tr')).data().nf;

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
                    $.ajax({
                        url: '<?= base_url('Approval/acc') ?>',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id_mform: id,
                            app: 1,
                            app1: '<?= Date("Y-m-d H:i:s") ?>',
                        },
                        success: function() {
                            window.location.reload()
                        }
                    })
                }
            })
        });

        // lihat detail form
        $('#table_mform tbody').on('click', '#btn-edit', function() {
            $('#load_details').DataTable().destroy();
            $('#tableT').DataTable().destroy();

            let id = tabelMForm.row($(this).parents('tr')).data().id;
            let nf = tabelMForm.row($(this).parents('tr')).data().nf;

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
                        'data': 'budget'
                    },

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
        })

    })
</script>
</body>

</html>