<?php include APPPATH . 'views/template/header.php' ?>
<?php include APPPATH . 'views/template/sidebar.php' ?>
<style>

</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-7">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>
                    </div>
                </div>
                <div class="col-5">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <a href='' data-bs-dismiss="alert" style='color: green;'>
                            <p style="display: contents;"> Hi, <?= $this->session->userdata['username'] ?> Welcome!</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">

            </div>
        </div>
    </div>

    <?php include APPPATH . 'views/template/footer.php' ?>
</div>
<?php include APPPATH . 'views/template/welcome.php' ?>