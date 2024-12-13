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
        /* Modern Styles for Login Page */
        body {
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)), url('<?= base_url() ?>assets/img/toba.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
        }

        h5 {
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            color: #34495e;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 25px;
            padding: 12px;
            font-size: 15px;
            border: 1px solid #ced4da;
            width: 100%;
            margin-bottom: 15px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.5);
            outline: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6c5ce7, #0984e3);
            color: #fff;
            font-weight: 600;
            border-radius: 25px;
            padding: 12px;
            font-size: 15px;
            border: none;
            width: 100%;
            cursor: pointer;
            transition: 0.3s, transform 0.2s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a4cdb, #0874d3);
            transform: scale(1.05);
        }

        .btn-primary:active {
            transform: scale(1);
        }

        /* Responsive Styles */
        @media (max-width: 480px) {
            .login-card {
                padding: 20px;
                max-width: 90%;
            }

            .logo {
                width: 60px;
            }

            h5 {
                font-size: 18px;
            }

            .form-control {
                font-size: 14px;
            }

            .btn-primary {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Login Content -->
    <div class="login-card">
        <!-- Logo -->
        <div class="logo-container">
            <img class="logo" src="<?= base_url() ?>assets/img/images.png" alt="Logo">
        </div>

        <!-- Heading -->
        <h5>Buku Tamu<br>Dinas Komunikasi dan Informatika<br>Kabupaten Toba</h5>

        <!-- Login Form -->
        <form method="POST" action="<?= site_url('admin0503/login') ?>">
            <div class="form-group">
                <input class="form-control" type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button class="btn-primary" type="submit">Log in</button>
            </div>
        </form>
    </div>
</body>

</html>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/theme.js"></script>
</body>

</html>
