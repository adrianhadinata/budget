<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="<?php echo base_url() ?>Home" id="dashboard">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Menu khusus admin-->
                <?php if ($this->session->userdata('username') == 'admin') { ?>
                    <li>
                        <a href="<?php echo base_url() ?>Form" id="form">
                            <i class="ri-pencil-line"></i>
                            <span>Form</span>
                        </a>
                    </li>
                <?php } ?>
                <!-- End of menu khusus admin -->

                <!-- Menu Khusus Head -->
                <?php if ($this->session->userdata('username') == 'head') { ?>
                    <li>
                        <a href="<?php base_url() ?>Approval" id="form">
                            <i class="ri-pencil-line"></i>
                            <span>Approval</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php base_url() ?>Report" id="form">
                            <i class="ri-file-copy-2-line"></i>
                            <span>Report</span>
                        </a>
                    </li>
                <?php } ?>
                <!-- End of menu khusus head -->

                <li>
                    <a href="<?= base_url('Welcome/logout') ?>" class="waves-effect text-danger">
                        <i class="ri-shut-down-line text-danger"></i>
                        <span>Log out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->