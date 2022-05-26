<?php
class Home extends Controller
{
    public function index()
    {
        $data['judul'] = 'dashboard';
        $month = date("Y-m");
        $data['anggaran'] = $this->model("LaporanModel")->getLaporanSummary($month);
        $data['totalPemasukanSampaiBulanLalu'] = $this->model("LaporanModel")->getTotalSaldoSampaiBulanLalu($month, UANG_MASUK);
        $data['totalPengeluaranSampaiBulanLalu'] = $this->model("LaporanModel")->getTotalSaldoSampaiBulanLalu($month, UANG_KELUAR);
        $data['totalPemasukanBulanIni'] = $this->model("LaporanModel")->getTotalSaldoBulanIni($month, UANG_MASUK);
        $data['totalPengeluaranBulanIni'] = $this->model("LaporanModel")->getTotalSaldoBulanIni($month, UANG_KELUAR);
        $data['totalKegiatan'] = $this->model("KegiatanModel")->getCountKegiatan();
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
    
}
