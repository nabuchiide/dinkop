<?php
class Laporan extends Controller
{
    public function index()
    {
        $data['judul'] = 'dashboard';
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }


    public function pemasukan()
    {
        $data['judul'] = 'Laporan Pemasukan';
        $data['anggaran'] = $this->model("AnggaranModel")->getLaporan(UANG_MASUK);
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('laporan/pemasukan/index', $data);
        $this->view('templates/footer');
    }

    public function pengeluaran()
    {
        $data['judul'] = 'Laporan Pengeluaran';
        $data['anggaran'] = $this->model("AnggaranModel")->getLaporan(UANG_KELUAR);
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('laporan/pengeluaran/index', $data);
        $this->view('templates/footer');
    }

    public function summary()
    {
        $data['judul'] = 'Laporan Summary';
        $data['anggaran'] = $this->model("AnggaranModel")->getLaporanSummary();
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('laporan/summary/index', $data);
        $this->view('templates/footer');
    }
}
