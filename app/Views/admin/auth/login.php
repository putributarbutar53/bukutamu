<?php
$session = session(); // Mengambil session
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIRAMA | Login</title>

    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/img/favicons/favicon.ico">
    <link rel="manifest" href="<?= base_url() ?>assets/img/favicons/manifest.json">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="theme-color" content="#ffffff">

    <link href="<?= base_url() ?>assets/lib/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/theme.css" rel="stylesheet">

    <style>
        body {
            background-image: url('<?= base_url() ?>assets/img/0.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px); /* Menambahkan efek blur pada background */
            border-radius: 15px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            margin: 20px;
        }

        h5 {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4a90e2, #9013fe);
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #9013fe, #4a90e2);
        }

        .text-600 a {
            color: #4a90e2;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                padding: 20px;
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <main class="main" id="top">
        <div class="container">
            <div class="row flex-center min-vh-100 py-6">
                <div class="col-12">
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

    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/theme.js"></script>
</body>

</html>
