<?php

namespace App\Controllers;

use App\Models\PengunjungModel;
use App\Models\DataModel;
use CodeIgniter\Email\Email;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    var $pengunjung, $data, $validation;
    use ResponseTrait;

    function __construct()
    {
        $this->pengunjung = new PengunjungModel();
        $this->data = new DataModel();
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
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request method.']);
        }

        $nik = $this->request->getPost('nik');
        $tujuan = $this->request->getPost('tujuan');
        $kepentingan = $this->request->getPost('kepentingan');

        if (!$nik || !$tujuan || !$kepentingan) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please complete all fields.']);
        }

        $foto = $this->request->getFile('foto');
        $tanda_tangan = $this->request->getFile('tanda_tangan');

        if (!$foto->isValid() || !$tanda_tangan->isValid()) {
            return $this->response->setJSON(['success' => false, 'message' => 'File upload failed.']);
        }

        // Tentukan folder penyimpanan file
        $fotoUploadPath = FCPATH . 'uploads/foto/';
        $ttdUploadPath = FCPATH . 'uploads/tanda_tangan/';

        if (!is_dir($fotoUploadPath)) {
            mkdir($fotoUploadPath, 0755, true);
        }
        if (!is_dir($ttdUploadPath)) {
            mkdir($ttdUploadPath, 0755, true);
        }


        try {
            $fotoName = $foto->getRandomName();
            $foto->move($fotoUploadPath, $fotoName);

            $ttdName = $tanda_tangan->getRandomName();
            $tanda_tangan->move($ttdUploadPath, $ttdName);
        } catch (\Exception $e) {
            log_message('error', 'File saving failed: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'File saving failed: ' . $e->getMessage()]);
        }

        $data = [
            'nik' => $nik,
            'tujuan' => $tujuan,
            'kepentingan' => $kepentingan,
            'foto' => $fotoName,
            'tanda_tangan' => $ttdName
        ];

        try {
            $pengunjungModel = new PengunjungModel();
            if ($pengunjungModel->insert($data)) {
                $this->sendEmail($data);

                return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil disimpan dan email terkirim.']);
            } else {
                $dbError = $pengunjungModel->errors();
                log_message('error', 'Database Error: ' . json_encode($dbError));
                return $this->response->setJSON(['success' => false, 'message' => 'Database insertion failed.', 'errors' => $dbError]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Exception: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Server Error: ' . $e->getMessage()]);
        }
    }

    private function sendEmail($data)
    {

        $nik = $data['nik'];


        $userData = $this->data->where('nik', $nik)->first();
        if ($userData) {
            $nama = $userData['nama'];
            $alamat = $userData['alamat'];
            $kelurahan = $userData['kelurahan'];
            $kecamatan = $userData['kecamatan'];
            $kabupaten = $userData['kabupaten'];
        } else {

            $nama = 'Bukan Warga Toba';
            $alamat = 'Bukan Warga Toba';
            $kelurahan = 'Bukan Warga Toba';
            $kecamatan = 'Bukan Warga Toba';
            $kabupaten = 'Bukan Warga Toba';
        }


        $message = "
    <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    color: #333;
                }
                .header {
                    background-color: #4CAF50;
                    color: white;
                    padding: 10px;
                    text-align: center;
                }
                .content {
                    margin-top: 20px;
                }
                .content table {
                    width: 100%;
                    border-collapse: collapse;
                }
                .content table, .content th, .content td {
                    border: 1px solid #ddd;
                    padding: 8px;
                }
                .content th {
                    background-color: #f2f2f2;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 12px;
                    color: #777;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class='header'>
                <h2>Pemberitahuan Tamu Baru</h2>
            </div>
            <div class='content'>
                <h3>Informasi Tamu:</h3>
                <table>
                    <tr>
                        <th>NIK</th>
                        <td>{$data['nik']}</td>
                    </tr>
                    <tr>
                        <th>Tujuan</th>
                        <td>{$data['tujuan']}</td>
                    </tr>
                    <tr>
                        <th>Kepentingan</th>
                        <td>{$data['kepentingan']}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{$nama}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{$alamat}</td>
                    </tr>
                    <tr>
                        <th>Desa/Kel</th>
                        <td>{$kelurahan}</td>
                    </tr>
                    <tr>
                        <th>Kecamatan</th>
                        <td>{$kecamatan}</td>
                    </tr>
                    <tr>
                        <th>Kabupaten</th>
                        <td>{$kabupaten}</td>
                    </tr>
                </table>
            </div>
            <div class='footer'>
                <p>Terima kasih,</p>
                <p>Dinas Komunikasi dan Informatika</p>
            </div>
        </body>
    </html>
    ";


        $emailTo = '';
        switch ($data['tujuan']) {
            case 'Kepala Dinas':
                $emailTo = 'firgonister@gmail.com';
                break;
            case 'Sekretaris':
                $emailTo = 'lisnapasaribu4@gmail.com';
                break;
            case 'Tata Usaha':
                $emailTo = 'tata.usaha@example.com';
                break;
            case 'Tata Kelola Pemerintahan Berbasis Elektronik':
                $emailTo = 'tata.usaha@example.com';
                break;
            case 'Pengelolaan Informasi dan Komunikasi Publik':
                $emailTo = 'tata.usaha@example.com';
                break;
            case 'Statistik dan Persandian':
                $emailTo = 'tata.usaha@example.com';
                break;
            default:
                $emailTo = 'default@example.com';
                break;
        }

        $email = \Config\Services::email();
        $email->setFrom('lisnapasaribu4@gmail.com', 'Dinas Komunikasi dan Informatika');
        $email->setTo($emailTo);
        $email->setSubject('Pemberitahuan Tamu Baru');
        $email->setMessage($message);

        $fotoPath = FCPATH . getenv('dir.uploads.foto') . $data['foto'];
        $ttdPath = FCPATH . getenv('dir.uploads.ttd') . $data['tanda_tangan'];


        if (file_exists($fotoPath)) {
            $email->attach($fotoPath, 'attachment', $data['foto']);
        }


        if (file_exists($ttdPath)) {
            $email->attach($ttdPath, 'attachment', $data['tanda_tangan']);
        }

        if (!$email->send()) {
            log_message('error', 'Email failed to send: ' . $email->printDebugger());
        } else {
            log_message('info', 'Email successfully sent');
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
