<?php

namespace App\Controllers\Admin0503;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PengunjungModel;
use Dompdf\Dompdf;
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

        // Load view into a variable
        $html = view('admin/pengunjung_pdf', $data);

        // Instantiate Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('letter', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF (1 = download and 0 = preview)
        $dompdf->stream("data_pengunjung.pdf", array("Attachment" => 0));
    }

    public function generatePDF()
    {
        // Memuat TCPDF
        $pdf = new TCPDF();

        // Set properti PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Data Pengunjung');
        $pdf->SetHeaderData('', '', 'Data Pengunjung', 'Dinas Komunikasi dan Informatika Kabupaten Toba');

        // Menambahkan halaman baru
        $pdf->AddPage();

        // Set font untuk teks
        $pdf->SetFont('helvetica', '', 12);

        // Tulis teks atau data lainnya
        $pdf->Cell(0, 10, 'Data Pengunjung', 0, 1, 'C');
        $pdf->Ln();

        // Tabel dengan data pengunjung
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(40, 10, 'Nama', 1);
        $pdf->Cell(40, 10, 'Alamat', 1);
        $pdf->Cell(40, 10, 'Tujuan', 1);
        $pdf->Cell(40, 10, 'Kepentingan', 1);
        $pdf->Cell(40, 10, 'Tanggal', 1);
        $pdf->Ln();

        // Contoh Data Pengunjung, Anda bisa mengganti ini dengan data dari database
        $dataPengunjung = [
            ['nama' => 'PUTRI BUTARBUTAR', 'alamat' => 'RIANIATE', 'tujuan' => 'Tata Usaha', 'kepentingan' => 'halo', 'tanggal' => '2024-11-13 17:44:29', 'foto' => '/uploads/foto/putri_butarbutar.jpg', 'tanda_tangan' => '/uploads/tanda_tangan/putri_butarbutar_ttd.jpg']
        ];

        foreach ($dataPengunjung as $row) {
            $pdf->Cell(40, 10, $row['nama'], 1);
            $pdf->Cell(40, 10, $row['alamat'], 1);
            $pdf->Cell(40, 10, $row['tujuan'], 1);
            $pdf->Cell(40, 10, $row['kepentingan'], 1);
            $pdf->Cell(40, 10, $row['tanggal'], 1);
            $pdf->Ln();

            // Menambahkan gambar foto
            $fotoPath = FCPATH . getenv('dir.uploads.foto') . $row['foto'];
            if (file_exists($fotoPath)) {
                $pdf->Image($fotoPath, 10, $pdf->GetY(), 40, 30, '', '', '', false, 300, '', false, false, 1, false, false, false);
                $pdf->Ln(35); // Mengatur jarak setelah gambar
            }

            // Menambahkan gambar tanda tangan
            $ttdPath = FCPATH . getenv('dir.uploads.ttd') . $row['tanda_tangan'];
            if (file_exists($ttdPath)) {
                $pdf->Image($ttdPath, 60, $pdf->GetY(), 40, 30, '', '', '', false, 300, '', false, false, 1, false, false, false);
                $pdf->Ln(35); // Mengatur jarak setelah gambar
            }
        }

        // Output PDF ke browser
        $pdf->Output('data_pengunjung.pdf', 'I');
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
