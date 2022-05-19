<?php
class Pengeluaran extends Controller
{
    public function index()
    {
        $data['judul'] = 'Pengeluaran';
        $data['kegiatan'] = $this->model("KegiatanModel")->getAllDataStatusWiting();
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('anggaran/pengeluaran/index', $data);
        $this->view('templates/footer');
    }

    public function getByKegitanAnggaran()
    {
        $allData = [];
        $allData = $this->model("AnggaranModel")->getDataByIdKegiatan($_POST['id']);
        echo json_encode($allData);
    }
}
