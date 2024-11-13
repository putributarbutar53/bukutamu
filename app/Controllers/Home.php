<?php

namespace App\Controllers;

use App\Models\PengunjungModel;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    var $pengunjung, $validation;
    use ResponseTrait;

    function __construct()
    {
        $this->pengunjung = new PengunjungModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    public function index()
    {
        $today = date('Y-m-d');
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $startOfYear = date('Y-01-01');

        // Menghitung jumlah pengunjung
        $totalVisitors = $this->pengunjung->countAllResults();
        $dailyVisitors = $this->pengunjung->where('DATE(created_at)', $today)->countAllResults();
        $weeklyVisitors = $this->pengunjung
            ->where('created_at >=', $startOfWeek . ' 00:00:00')
            ->where('created_at <=', $today . ' 23:59:59')
            ->countAllResults();
        $yearlyVisitors = $this->pengunjung
            ->where('created_at >=', $startOfYear . ' 00:00:00')
            ->where('created_at <=', $today . ' 23:59:59')
            ->countAllResults();

        // Mengambil data pengunjung terbaru beserta foto dan tanda tangan
        $pengunjungList = $this->pengunjung->findAll();

        // Mengirim data ke tampilan
        $data = [
            'totalVisitors' => $totalVisitors,
            'dailyVisitors' => $dailyVisitors,
            'weeklyVisitors' => $weeklyVisitors,
            'yearlyVisitors' => $yearlyVisitors,
            'pengunjungList' => $pengunjungList,
        ];

        return view('web/index', $data);
    }

    public function submit()
    {
        // Ambil data input dari form
        $nik = $this->request->getPost('nik');
        $tujuan = $this->request->getPost('tujuan');
        $kepentingan = $this->request->getPost('kepentingan');
        $fotoBase64 = $this->sanitizeBase64($this->request->getPost('foto'));
        $tandaTanganBase64 = $this->sanitizeBase64($this->request->getPost('tanda_tangan'));

        // Cek apakah data base64 valid
        if (!$fotoBase64 || !$tandaTanganBase64) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data foto atau tanda tangan tidak valid.',
            ]);
        }

        // Dapatkan MIME type untuk foto dan tanda tangan
        $fotoMimeType = $this->getMimeType($fotoBase64);
        $tandaTanganMimeType = $this->getMimeType($tandaTanganBase64);

        // Tentukan ekstensi file berdasarkan MIME type
        $fotoExt = ($fotoMimeType == 'image/jpeg') ? 'jpg' : 'png';
        $tandaTanganExt = ($tandaTanganMimeType == 'image/jpeg') ? 'jpg' : 'png';

        // Konversi Base64 menjadi biner
        $fotoBinary = base64_decode($fotoBase64, true);
        $tandaTanganBinary = base64_decode($tandaTanganBase64, true);

        // Periksa apakah decoding berhasil
        if ($fotoBinary === false || $tandaTanganBinary === false) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mendekode foto atau tanda tangan.',
            ]);
        }

        // Direktori penyimpanan foto dan tanda tangan
        $fotoDir = 'uploads/foto/';
        $tandaTanganDir = 'uploads/tanda_tangan/';

        // Membuat direktori jika belum ada
        if (!is_dir($fotoDir)) {
            if (!mkdir($fotoDir, 0777, true)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal membuat direktori foto.',
                ]);
            }
        }
        if (!is_dir($tandaTanganDir)) {
            if (!mkdir($tandaTanganDir, 0777, true)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal membuat direktori tanda tangan.',
                ]);
            }
        }

        // Nama file unik
        $fotoPath = $fotoDir . time() . '_foto.' . $fotoExt;
        $tandaTanganPath = $tandaTanganDir . time() . '_tanda_tangan.' . $tandaTanganExt;

        // Simpan file foto dan tanda tangan ke folder
        if (file_put_contents($fotoPath, $fotoBinary) === false || file_put_contents($tandaTanganPath, $tandaTanganBinary) === false) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menyimpan foto atau tanda tangan.',
            ]);
        }

        // Simpan data ke database
        $data = [
            'nik' => $nik,
            'tujuan' => $tujuan,
            'kepentingan' => $kepentingan,
            'foto' => $fotoPath,
            'tanda_tangan' => $tandaTanganPath,
        ];

        // Insert data ke tabel pengunjung
        if ($this->pengunjung->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil disimpan.',
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menyimpan data pengunjung.',
            ]);
        }
    }

    // Fungsi untuk sanitasi base64
    private function sanitizeBase64($base64String)
    {
        // Cek apakah ada prefiks base64
        if (strpos($base64String, 'base64,') !== false) {
            $base64String = explode('base64,', $base64String)[1];
        }
        return $base64String;
    }

    // Fungsi untuk mendapatkan MIME type dari base64
    private function getMimeType($base64String)
    {
        $binary = base64_decode($base64String, true);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($finfo, $binary);
        finfo_close($finfo);
        return $mimeType;
    }

    // Fungsi untuk menghapus pengunjung
    public function delete($id)
    {
        if ($this->pengunjung->delete($id)) {
            return redirect()->to('admin0503/pengunjung')->with('success', 'Data pengunjung berhasil dihapus.');
        } else {
            return redirect()->to('admin0503/pengunjung')->with('error', 'Gagal menghapus data pengunjung.');
        }
    }
}
