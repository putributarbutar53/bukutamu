<?php

namespace App\Models;

use CodeIgniter\Model;

class PengunjungModel extends Model
{
    protected $table = 'pengunjung'; // Nama tabel yang digunakan di database
    protected $primaryKey = 'id'; // Primary key dari tabel

    protected $allowedFields = [
        'nik', 'tujuan', 'kepentingan', 'created_at', 'foto', 'tanda_tangan'
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
}
