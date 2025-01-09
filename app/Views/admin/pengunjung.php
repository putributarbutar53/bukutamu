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
                <table class="table table-sm table-dashboard fs--1 data-table border-bottom" data-options='{"responsive":false,"pagingType":"simple","lengthChange":false,"searching":false,"pageLength":10,"columnDefs":[{"targets":[0,10],"orderable":false}],"language":{"info":"_START_ to _END_ Items of _TOTAL_ — <a href=\"#!\" class=\"font-weight-semi-bold\"> view all <span class=\"fas fa-angle-right\" data-fa-transform=\"down-1\"></span> </a>"},"buttons":["copy","excel"]}'>
                    <thead class="bg-200">
                        <tr>
                            <th class="sort">No</th>
                            <th class="sort">Nama/NIK Pengunjung</th>
                            <th class="sort">Alamat</th>
                            <th class="sort"></th>
                            <th class="sort">Tujuan</th>
                            <th class="sort">Kepentingan</th>
                            <th class="sort">Tgl Kunjungan</th>
                            <th class="sort">Foto</th>
                            <th class="sort">Tanda Tangan</th>
                            <th class="sort">Tgl Keluar</th>
                            <th class="sort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php if (!empty($pengunjung)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($pengunjung as $row) : ?>
                                <tr>
                                    <td class="text-center"><?= esc($no++); ?></td>
                                    <td><?= !empty($row['nama_db_data']) ? esc($row['nama_db_data']) : esc($row['nama']); ?></td>
                                    <td><?= !empty($row['alamat']) ? esc($row['alamat']) : esc($row['asal']); ?></td>
                                    <td></td>
                                    <td><?= esc($row['tujuan']); ?></td>
                                    <td><?= esc($row['kepentingan']); ?></td>
                                    <td class="text-center"><?= esc($row['created_at']); ?></td>
                                   <td class="text-center">
                                        <?php
                                        // Path langsung ke folder uploads/foto
                                        $fotoPath = 'uploads/foto/' . esc($row['foto']);
                                    
                                        // Pastikan file foto ada dan dapat ditemukan
                                        if (!empty($row['foto']) && file_exists(FCPATH . $fotoPath)) :
                                        ?>
                                            <!-- Gambar ditampilkan jika file ada -->
                                            <a href="<?= base_url($fotoPath); ?>" data-fancybox="gallery" data-caption="Foto Pengunjung">
                                                <img src="<?= base_url($fotoPath); ?>" alt="Foto Pengunjung" style="width: 50px; height: auto;">
                                            </a>
                                        <?php else : ?>
                                            <!-- Jika tidak ada foto, tampilkan tanda "-" -->
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $ttdPath = 'uploads/tanda_tangan/' . esc($row['tanda_tangan']);

                                        if (!empty($row['tanda_tangan']) && file_exists(FCPATH . $ttdPath)) :
                                        ?>
                                            <a href="<?= base_url($ttdPath); ?>" data-fancybox="gallery" data-caption="Tanda Tangan">
                                                <img src="<?= base_url($ttdPath); ?>" alt="Tanda Tangan" style="width: 50px; height: auto;">
                                            </a>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($row['tanggal_keluar'] === NULL) : ?>
                                            <a href="<?= site_url('admin0503/pengunjung/logout/' . esc($row['id'])) ?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-sign-out-alt"></i> Keluar
                                            </a>
                                        <?php else : ?>
                                            <?= esc(date('d-m-Y H:i', strtotime($row['tanggal_keluar']))); ?>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center">
                                        <a href="<?= site_url('admin0503/pengunjung/delete/' . esc($row['id'])) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="11" class="text-center">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->endsection() ?>