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
        // Pastikan form ini hanya dapat diakses dengan metode POST
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request method.']);
        }
    
        // Validasi input
        $nik = $this->request->getPost('nik');
        $tujuan = $this->request->getPost('tujuan');
        $kepentingan = $this->request->getPost('kepentingan');
    
        if (!$nik || !$tujuan || !$kepentingan) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please complete all fields.']);
        }
    
        // Proses upload file foto
        $foto = $this->request->getFile('foto');
        $tanda_tangan = $this->request->getFile('tanda_tangan');
    
        // Pastikan file foto dan tanda tangan tersedia dan valid
        if (!$foto->isValid() || !$tanda_tangan->isValid()) {
            return $this->response->setJSON(['success' => false, 'message' => 'File upload failed.']);
        }
    
        // Tentukan folder penyimpanan berdasarkan path yang diberikan
        $fotoUploadPath = FCPATH . 'uploads/foto/';
        $ttdUploadPath = FCPATH . 'uploads/tanda_tangan/';
    
        // Cek apakah folder penyimpanan ada, jika tidak buat foldernya
        if (!is_dir($fotoUploadPath)) {
            mkdir($fotoUploadPath, 0755, true);
        }
        if (!is_dir($ttdUploadPath)) {
            mkdir($ttdUploadPath, 0755, true);
        }
    
        // Simpan file foto dan tanda tangan
        try {
            $fotoName = $foto->getRandomName();
            $foto->move($fotoUploadPath, $fotoName);
    
            $ttdName = $tanda_tangan->getRandomName();
            $tanda_tangan->move($ttdUploadPath, $ttdName);
        } catch (\Exception $e) {
            log_message('error', 'File saving failed: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'File saving failed: ' . $e->getMessage()]);
        }
    
        // Siapkan data untuk disimpan di database
        $data = [
            'nik' => $nik,
            'tujuan' => $tujuan,
            'kepentingan' => $kepentingan,
            'foto' => $fotoName,
            'tanda_tangan' => $ttdName
        ];
    
        // Coba simpan ke database menggunakan try-catch
        try {
            if ($this->pengunjung->insert($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil disimpan.']);
            } else {
                $dbError = $this->pengunjung->errors();
                log_message('error', 'Database Error: ' . json_encode($dbError));
                return $this->response->setJSON(['success' => false, 'message' => 'Database insertion failed.', 'errors' => $dbError]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Exception: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Server Error: ' . $e->getMessage()]);
        }
    }
    

    public function delete($id)
    {
        if ($this->pengunjung->delete($id)) {
            return redirect()->to('admin0503/pengunjung')->with('success', 'Data pengunjung berhasil dihapus.');
        } else {
            return redirect()->to('admin0503/pengunjung')->with('error', 'Gagal menghapus data pengunjung.');
        }
    }
}
