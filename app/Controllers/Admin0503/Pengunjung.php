<?php

namespace App\Controllers\Admin0503;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\Email\Email;
use App\Models\PengunjungModel;
use Dompdf\Dompdf;
use TCPDF;
use CodeIgniter\API\ResponseTrait;
use App\Models\DiskusiModel;
use CodeIgniter\Config\Config;

class Pengunjung extends BaseController
{
    use ResponseTrait;
    var $pengunjung, $model, $skt;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->pengunjung = new PengunjungModel();
    }
    public function index()
    {
        $data['pengunjung'] = $this->pengunjung->getPengunjungWithData();
        return view('admin/pengunjung', $data);
    }
    public function printPDF()
    {
        $data['pengunjung'] = $this->pengunjung->getPengunjungWithData();

        $imagePath = FCPATH . 'assets/img/images.png';

        if (file_exists($imagePath)) {
            $imageData = base64_encode(file_get_contents($imagePath));

            $imageTag = '<img src="data:image/png;base64,' . $imageData . '" alt="Logo Toba" style="max-height: 60px;" />';
        } else {
            $imageTag = 'Gambar tidak tersedia';
        }

        $data['imageTag'] = $imageTag;

        foreach ($data['pengunjung'] as &$row) {
            // Foto
            $fotoPath = FCPATH . getenv('dir.uploads.foto') . $row['foto'];
            $row['foto_base64'] = $this->getBase64Image($fotoPath);

            // Tanda Tangan
            $ttdPath = FCPATH . getenv('dir.uploads.ttd') . $row['tanda_tangan'];
            $row['ttd_base64'] = $this->getBase64Image($ttdPath);
        }

        $data['imageTag'] = $imageTag;

        // Load HTML ke Dompdf
        $html = view('admin/pengunjung_pdf', $data);

        // Instantiate Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // Set kertas PDF
        $dompdf->setPaper('letter', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF (Attachment 0 = Preview, 1 = Download)
        $dompdf->stream("data_pengunjung.pdf", array("Attachment" => 0));
    }

    // Fungsi untuk mendapatkan base64 image
    private function getBase64Image($imagePath)
    {
        if (file_exists($imagePath)) {
            return 'data:image/png;base64,' . base64_encode(file_get_contents($imagePath));
        }
        return null;
    }

    public function delete($id)
    {
        $deleted = $this->pengunjung->delete($id);

        if ($deleted) {
            return redirect()->to(site_url('admin0503/pengunjung'))->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->to(site_url('admin0503/pengunjung'))->with('error', 'Ops! ID tidak valid atau data tidak dapat dihapus.');
        }
    }
}
