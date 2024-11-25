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
            background-image: url('<?= base_url() ?>assets/img/toba.jpg');
            background-size: cover; /* Menjaga gambar agar selalu menutupi seluruh layar */
            background-position: center center; /* Memastikan gambar tetap terpusat */
            background-repeat: no-repeat; /* Menghindari pengulangan gambar */
            background-attachment: fixed; /* Gambar tetap terpasang ketika scroll */
            min-height: 100vh; /* Memastikan konten mengisi layar penuh */
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            text-align: center;
            color: white;
            padding: 20px;
            border-radius: 15px;
            width: 280%;
            max-width: 400px;
        }

        h5 {
            font-family: 'Times New Roman', sans-serif;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-control {
            width: 100%;
            background: none;
            border: 2px solid;
            color: white;
            padding: 5px;
            font-size: 18px;
            cursor: pointer;
            margin: 12px 0;
        }

        .form-control:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 1);
        }

        .btn-primary {
            width: 100%;
            background: none;
            border: 1px solid;
            color: white;
            padding: 5px;
            font-size: 18px;
            cursor: pointer;
            margin: 12px 0;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #9013fe, #4a90e2);
            transform: translateY(-2px);
        }

        .text-600 a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: 500;
        }

        .text-600 a:hover {
            text-decoration: underline;
        }

        /* Animasi teks berjalan */
        .marquee {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .marquee span {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 15s linear infinite;
            color: white;
            font-size: 30px;
            font-weight: bold;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
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
                    <div class="login-container">
                        <div class="marquee">
                            <span>BUKU TAMU DINAS KOMUNIKASI DAN INFORMATIKA KABUPATEN TOBA</span>
                        </div>
                        <form method="POST" action="<?php echo site_url('admin0503/login') ?>">
                            <div class="form-group">
                                <input class="form-control" type="text" name="username" placeholder="Username" value="<?php if ($session->getFlashdata('username')) echo $session->getFlashdata('username') ?>" />
                            </div>
                            <div class="form-group">
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
    </main>

    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/theme.js"></script>
</body>

</html>
