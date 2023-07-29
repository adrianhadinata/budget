<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo base_url() ?>assets/img/logo/logo_saja_GI.png">
    <title>Login Page</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/output.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/all.min.621.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/output.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.523.css" />
    <script src="<?= base_url() ?>assets/js/lottie-player.js"></script>
</head>

<body>
    <div class="w-screen h-screen flex flex-col justify-center items-center lg:grid lg:grid-cols-2">
        <div id="lottie">
            <lottie-player src="<?= base_url() ?>assets/img/style/95590-finance-animation.json" mode="bounce" background="transparent" speed="1" style="width: 350px; height: 350px;" class="hidden lg:block w-auto transform mx-auto" loop autoplay></lottie-player>
        </div>
        <form class="flex flex-col justify-center items-center w-1/2" style=" margin: auto;" method="post" action="<?= base_url() ?>Dashboard">
            <img class="" src="<?php echo base_url() ?>assets/img/logo/logo.png" />
            <h5 class="my-4 font-display text-center">E - Budgeting</h5>
            <?= $this->session->flashdata('message'); ?>
            <div class="relative form-group">
                <i class="fa fa-user absolute" style="font-size: 14px; line-height: 28px; margin-left: 10px;"></i>
                <input value="<?= set_value('username') ?>" name="username" type="text" placeholder="username" style="border-radius: 15px;" class="pl-8 border-b-2 font-display focus:outline-none capitalize text-lg" />
            </div>
            <small class="text-danger"><?= form_error('username') ?></small>
            <div class="relative" style="margin-top: 4px;">
                <i class="fa fa-lock absolute" style="font-size: 14px; line-height: 28px; margin-left: 10px;"></i>
                <input name="password" type="password" placeholder="password" class="pl-8 mt-1 border-b-2 font-display focus:outline-none capitalize text-lg" style="border-radius: 15px;" />
            </div>
            <small class="text-danger"><?= form_error('password') ?></small>
            <div class="relative" style="margin-top: 4px;">
                <button type="submit" class="mt-4 px-10 py-1 bg-blue-600 rounded-full font-bold text-white transform hover:translate-y-1 transition-all duration-500">Login</button>
            </div>
        </form>

        <div class="text-center" style="justify-content:center; width:100vw; display:flex; flex-direction: column;">
            <span>© 2023, MIS - PT. Globalindo Intimates.</span>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="<?= base_url() ?>/assets/js/bootstrap.bundle.min.523.js" crossorigin="anonymous"></script>
</body>
<!--   Core JS Files   -->
<script src="<?= base_url() ?>assets/js/jquery.3.2.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $("#lottie").css("margin-left", "150px");
    })
</script>

</html>