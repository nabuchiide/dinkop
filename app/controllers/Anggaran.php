<?php
class Anggaran extends Controller
{
    public function index()
    {
        $data['judul'] = 'Anggaran';
        $data['kegiatan'] = $this->model("KegiatanModel")->getAllDataStatusWiting();
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('anggaran/index', $data);
        $this->view('templates/footer');
    }
}
