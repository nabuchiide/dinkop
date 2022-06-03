<?php

class PegawaiModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllData()
    {
        $allData = [];
        $this->db->query(" SELECT * FROM pegawai ORDER BY id_pegawai  DESC ");
        $allData = $this->db->resultset();
        for ($i = 0; $i < count($allData); $i++) {
            $jabatan_loop = $allData[$i]['jabatan'];
            if ($jabatan_loop == KEPALA) {
                $jabatan_loop = "PPTK";
            } else  if ($jabatan_loop == BENDAHARA) {
                $jabatan_loop = "Bendahara";
            }else if ($jabatan_loop == STAF) {
                $jabatan_loop = "Staff";
            }else if ($jabatan_loop == PENGGUNA){
                $jabatan_loop = "Pengguna Anggaran";
            }else{
                $jabatan_loop = "Tidak ada jabatan";
            }
            $allData[$i]['jabatan'] = $jabatan_loop;
        }
        return $allData;
    }

    public function getOneData($id)
    {
        $this->db->query('select * from pegawai where id_pegawai =:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahData($data)
    {
        $query = " INSERT INTO pegawai
                    VALUES
                    ('', :nama_pegawai, :nip, :jabatan) 
                ";
        $this->db->query($query);
        $this->db->bind('nama_pegawai', $data['nama_pegawai']);
        $this->db->bind('nip', $data['nip']);
        $this->db->bind('jabatan', $data['jabatan']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapus($id)
    {
        $query = " DELETE  FROM pegawai WHERE id=:id ";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahData($data)
    {
        $query = " UPDATE pegawai SET 
                        nama_pegawai    =:nama_pegawai,
                        nip             =:nip,
                        jabatan         =:jabatan
                    WHERE 
                        id_pegawai =:id_pegawai
                ";
        $this->db->query($query);
        $this->db->bind('nama_pegawai', $data['nama_pegawai']);
        $this->db->bind('nip', $data['nip']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('id_pegawai', $data['id_pegawai']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDataByJabatan($jabatan)
    {
        $this->db->query("  SELECT nama_pegawai, nip FROM pegawai WHERE jabatan =:jabatan ORDER BY id_pegawai DESC limit 1 ");
        $this->db->bind('jabatan', $jabatan);
        return $this->db->single();
    }


    public function countNoPegawai($nip){
        $this->db->query("  SELECT count(*) AS CountData FROM pegawai WHERE nip =:nip ");
        $this->db->bind('nip', $nip);
        return $this->db->single();
    }

    public function getNamaByJabatan($jabatan)
    {
        $this->db->query("  SELECT nama_pegawai, nip FROM pegawai WHERE jabatan =:jabatan ORDER BY id_pegawai DESC limit 1 ");
        $this->db->bind('jabatan', $jabatan);
        return $this->db->single();
    }

    public function getDataCountJabatan($jabatan)
    {
        $this->db->query("  SELECT count(*) AS CountData FROM pegawai WHERE jabatan =:jabatan ");
        $this->db->bind('jabatan', $jabatan);
        return $this->db->single();
    }
}
