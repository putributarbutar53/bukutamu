<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<!-- Page content goes here -->

<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h6 class="mb-0">Data Pengunjung</h6>
            </div>
            <br>
            <div class="col-lg-12">
                <a href="<?= site_url('admin0503/pengunjung/printPDF') ?>" class="btn btn-danger btn-sm mr-1" target="_blank">
                    <i class="fas fa-file-pdf"></i> Print PDF
                </a>
                <br>
                <br>
                <table class="table table-sm table-dashboard fs--1 data-table border-bottom" data-options='{"responsive":false,"pagingType":"simple","lengthChange":false,"searching":false,"pageLength":10,"columnDefs":[{"targets":[0,9],"orderable":false}],"language":{"info":"_START_ to _END_ Items of _TOTAL_ — <a href=\"#!\" class=\"font-weight-semi-bold\"> view all <span class=\"fas fa-angle-right\" data-fa-transform=\"down-1\"></span> </a>"},"buttons":["copy","excel"]}'>
                    <thead class="bg-200">
                        <tr>
                            <th class="sort">No</th>
                            <th class="sort">Nama/NIK Pengunjung</th>
                            <th class="sort">Alamat</th>
                            <th class="sort">Kec.</th>
                            <th class="sort">Tujuan</th>
                            <th class="sort">Kepentingan</th>
                            <th class="sort">Tanggal Kunjungan</th>
                            <th class="sort">Foto</th>
                            <th class="sort">Tanda Tangan</th>
                            <th class="sort">Aksi</th> <!-- Tambahkan kolom aksi -->
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php if (!empty($pengunjung)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($pengunjung as $row) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= !empty($row['nama']) ? $row['nama'] : $row['nik'] . ' (Bukan Warga Toba)'; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td><?= $row['kecamatan']; ?></td>
                                    <td><?= $row['tujuan']; ?></td>
                                    <td><?= $row['kepentingan']; ?></td>
                                    <td class="text-center"><?= $row['created_at']; ?></td>
                                    <td class="text-center">
    <?php if (!empty($row['foto']) && file_exists($row['foto'])) : ?>
        <img src="<?= base_url($row['foto']); ?>" alt="Foto Pengunjung" style="width: 50px; height: auto;">
    <?php else : ?>
        -
    <?php endif; ?>
</td>
<td class="text-center">
    <?php if (!empty($row['tanda_tangan']) && file_exists($row['tanda_tangan'])) : ?>
        <img src="<?= base_url($row['tanda_tangan']); ?>" alt="Tanda Tangan Pengunjung" style="width: 50px; height: auto;">
    <?php else : ?>
        -
    <?php endif; ?>
</td>

                                    <td class="text-center">
                                        <a href="<?= site_url('admin0503/pengunjung/delete/' . $row['id']) ?>" 
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="10" class="text-center">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->endsection() ?>
