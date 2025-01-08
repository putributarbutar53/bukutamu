<?php

namespace App\Models;

use CodeIgniter\Model;

class PengunjungModel extends Model
{
    protected $table = 'pengunjung'; // Nama tabel yang digunakan di database
    protected $primaryKey = 'id'; // Primary key dari tabel

    protected $allowedFields = [
        'nik',
        'tujuan',
        'kepentingan',
        'created_at',
        'tanggal_keluar',
        'foto',
        'tanda_tangan',
        'nama',
        'asal'
    ]; // Kolom-kolom yang diizinkan untuk diisi/dimodifikasi

    protected $returnType = 'array'; // Tipe data yang dikembalikan adalah array

    // Fungsi untuk mencari data pengunjung berdasarkan NIK
    public function getDataByNik($nik)
    {
        return $this->where('nik', $nik)->first();
    }

    // Fungsi untuk mendapatkan semua data pengunjung
    public function getAllData()
    {
        return $this->findAll();
    }

    // Fungsi untuk menghapus data pengunjung berdasarkan ID
    public function deleteData($id)
    {
        // Menghapus data pengunjung berdasarkan ID
        return $this->delete($id);
    }
    public function getPengunjungWithData()
    {
        // Query untuk mengambil data pengunjung dan menggabungkannya dengan data dari tabel db_data
        $builder = $this->db->table('pengunjung');
        $builder->select('pengunjung.*, db_data.nama, db_data.alamat, db_data.kecamatan');  // Pilih kolom yang diperlukan
        $builder->join('db_data', 'db_data.nik = pengunjung.nik', 'left');  // Join dengan db_data berdasarkan nik
        $builder->orderBy('pengunjung.created_at', 'DESC');  // Mengurutkan berdasarkan created_at, terbaru di atas
        $query = $builder->get();

        return $query->getResultArray();
    }
}
