<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Pengunjung</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header img {
            max-height: 60px;
        }

        .header h1 {
            margin: 5px 0;
            font-size: 16px;
        }

        .header p {
            margin: 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-size: 12px;
            text-align: center;
        }

        td {
            font-size: 12px;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }

        .footer p {
            margin: 0;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-logo">
            <?= $imageTag; ?>
        </div>
        <div class="header-text">
            <h1>Data Pengunjung</h1>
            <p>Dinas Komunikasi dan Informatika</p>
            <p>Kabupaten Toba</p>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama/NIK Pengunjung</th>
                <th>Alamat</th>
                <th>Tujuan</th>
                <th>Kepentingan</th>
                <th>Tgl Berkunjung</th>
                <th>Tgl Keluar</th>
                <th class="sort">Foto</th>
                <th class="sort">Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pengunjung)) : ?>
                <?php $no = 1; ?>
                <?php foreach ($pengunjung as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= !empty($row['nama_db_data']) ? $row['nama_db_data'] : $row['nama']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['tujuan']; ?></td>
                        <td><?= $row['kepentingan']; ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                        <td><?= $row['tanggal_keluar'] ? date('d/m/Y H:i', strtotime($row['tanggal_keluar'])) : '-'; ?></td>


                        <!-- Foto -->
                        <td>
                            <?php if ($row['foto_base64']) : ?>
                                <img src="<?= $row['foto_base64']; ?>" alt="Foto Pengunjung" style="width: 40px; height: 40px;">
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>

                        <!-- Tanda Tangan -->
                        <td>
                            <?php if ($row['ttd_base64']) : ?>
                                <img src="<?= $row['ttd_base64']; ?>" alt="Tanda Tangan Pengunjung" style="width: 40px; height: 40px;">
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8" class="text-center">No data available</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>

    <div class="footer">
        <p>&copy; <?= date('Y'); ?> Dinas Komunikasi dan Informatika Kabupaten Toba</p>
    </div>
</body>

</html>