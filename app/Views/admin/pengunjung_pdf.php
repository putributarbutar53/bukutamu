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
        <h1>Data Pengunjung</h1>
        <p>Dinas Komunikasi dan Informatika</p>
        <p>Kabupaten Toba</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama/NIK Pengunjung</th>
                <th>Alamat</th>
                <th>Tujuan</th>
                <th>Kepentingan</th>
                <th>Tanggal</th>
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
                        <td><?= !empty($row['nama']) ? $row['nama'] : $row['nik'] . ' (Bukan Warga Toba)'; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['tujuan']; ?></td>
                        <td><?= $row['kepentingan']; ?></td>
                        <td><?= $row['created_at']; ?></td>

                        <!-- Foto -->
                        <td class="text-center">
                            <?php
                            $fotoPath = getenv('dir.uploads.foto') . $row['foto'];
                            if (!empty($row['foto']) && file_exists(FCPATH . $fotoPath)) :
                            ?>
                                <!-- Gunakan Fancybox untuk foto -->
                                <a href="<?= base_url($fotoPath); ?>" data-fancybox="gallery" data-caption="Foto Pengunjung">
                                    <img src="<?= base_url($fotoPath); ?>" alt="Foto Pengunjung" style="width: 50px; height: auto;">
                                </a>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>

                        <!-- Tanda Tangan -->
                        <td class="text-center">
                            <?php
                            $ttdPath = getenv('dir.uploads.ttd') . $row['tanda_tangan'];
                            if (!empty($row['tanda_tangan']) && file_exists(FCPATH . $ttdPath)) :
                            ?>
                                <!-- Gunakan Fancybox untuk tanda tangan -->
                                <a href="<?= base_url($ttdPath); ?>" data-fancybox="gallery" data-caption="Tanda Tangan Pengunjung">
                                    <img src="<?= base_url($ttdPath); ?>" alt="Tanda Tangan Pengunjung" style="width: 50px; height: auto;">
                                </a>
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