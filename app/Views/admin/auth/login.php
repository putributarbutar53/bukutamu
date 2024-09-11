<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>SIRAMA | Login</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/img/favicons/favicon.ico">
    <link rel="manifest" href="<?= base_url() ?>assets/img/favicons/manifest.json">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="msapplication-TileImage" content="<?= base_url() ?>assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <script src="<?= base_url() ?>assets/js/config.navbar-vertical.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="<?= base_url() ?>assets/lib/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/theme.css" rel="stylesheet">

</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">


        <div class="container" data-layout="container">
            <div class="row flex-center min-vh-100 py-6">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <?php
                    $session = \Config\Services::session();
                    if ($session->getFlashdata('warning')) {
                    ?>
                        <?php
                        foreach ($session->getFlashdata('warning') as $val) {
                        ?><div class="alert alert-warning alert-dismissible mb-1 fade show" role="alert"><?= $val ?>
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="font-weight-light" aria-hidden="true">×</span></button>
                            </div>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    if ($session->getFlashdata('success')) {
                    ?>
                        <div class="alert alert-success"><?php echo $session->getFlashdata('success') ?></div>
                    <?php
                    }
                    ?>
                    <div class="card">
                        <div class="card-body p-4 p-sm-5">
                            <div class="row text-left justify-content-between align-items-center mb-2">
                                <div class="col-auto">
                                    <h5>Log in</h5>
                                </div>
                                <div class="col-auto">
                                    <p class="fs--1 text-600 mb-0">or <a href="<?php echo site_url("register") ?>">Create an account</a></p>
                                </div>
                            </div>
                            <form method="POST" action="<?php echo site_url('admin0503/login') ?>">
                                <div class="form-group">
                                    <label for="email">Username</label>
                                    <input class="form-control" type="text" name="username" placeholder="Username" value="<?php if ($session->getFlashdata('username')) echo $session->getFlashdata('username') ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="Password" />
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block mt-3" type="submit" name="submit">Log in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/@fortawesome/all.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/stickyfilljs/stickyfill.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/sticky-kit/sticky-kit.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/is_js/is.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/lodash/lodash.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/perfect-scrollbar/perfect-scrollbar.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <script src="<?= base_url() ?>assets/js/theme.js"></script>

</body>

</html>