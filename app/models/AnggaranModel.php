<?php

class AnggaranModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllDataByStatus($status)
    {
        $query = "
                SELECT 
                    sum(p.biaya) as total_sum 
                FROM anggaran p 
                    WHERE p.status =:status
                ";
        $this->db->query($query);
        $this->db->bind('status', $status);
        $allData = $this->db->single();
        return $allData;
    }

    public function getAllData()
    {
        $allData = [];
        $this->db->query(" SELECT * FROM anggaran ");
        $allData = $this->db->resultset();
        return $allData;
    }

    public function getDataPemasukan()
    {
        $allData = [];
        $this->db->query(" SELECT * FROM anggaran WHERE type_anggaran = '" . UANG_MASUK . "'");
        $allData = $this->db->resultset();
        return $allData;
    }

    public function getDataByIdKegiatan($id_kegiatan, $type_anggaran)
    {
        $allData = [];
        $this->db->query(" SELECT * FROM anggaran WHERE id_kegiatan =:id_kegiatan && type_anggaran =:type_anggaran");
        $this->db->bind('id_kegiatan', $id_kegiatan);
        $this->db->bind('type_anggaran', $type_anggaran);
        $allData = $this->db->resultset();
        return $allData;
    }

    public function tambahData($data)
    {
        $query = " INSERT INTO 
                anggaran(id_anggaran, tanggal, nominal, no_rekening, keterangan, type_anggaran, id_kegiatan, status)  
                VALUES ('', :tanggal, :nominal, :no_rekening, :keterangan, :type_anggaran, :id_kegiatan, :status)
            ";
        $this->db->query($query);
        $this->db->bind('tanggal', $data['tanggal']);
        $this->db->bind('nominal', $data['nominal']);
        $this->db->bind('no_rekening', $data['no_rekening']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('type_anggaran', $data['type_anggaran']);
        $this->db->bind('id_kegiatan', $data['id_kegiatan']);
        $this->db->bind('status', $data['status']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahData($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        $query = "  UPDATE anggaran SET 
                        tanggal         =:tanggal,
                        nominal         =:nominal,
                        no_rekening     =:no_rekening,
                        keterangan      =:keterangan,
                        type_anggaran   =:type_anggaran,
                        id_kegiatan     =:id_kegiatan,
                        status          =:status 
                    WHERE 
                        id_anggaran =:id_anggaran
            ";
        $this->db->query($query);
        $this->db->bind('id_anggaran', $data['id_anggaran']);
        $this->db->bind('tanggal', $data['tanggal']);
        $this->db->bind('nominal', $data['nominal']);
        $this->db->bind('no_rekening', $data['no_rekening']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('type_anggaran', $data['type_anggaran']);
        $this->db->bind('id_kegiatan', $data['id_kegiatan']);
        $this->db->bind('status', $data['status']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahStatusByIdKegiatan($id_kegiatan, $status)
    {

        $query = " UPDATE anggaran
                   SET
                       status      =:status 
                   WHERE 
                       id_kegiatan =:id_kegiatan
           ";
        $this->db->query($query);
        $this->db->bind('status', $status);
        $this->db->bind('id_kegiatan', $id_kegiatan);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahStatusById($id, $status)
    {

        $query = " UPDATE anggaran
                   SET
                       status      =:status 
                   WHERE 
                    id_anggaran =:id
           ";
        $this->db->query($query);
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getOneData($id)
    {
        $this->db->query(" SELECT * FROM anggaran WHERE id_anggaran =:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function cekingData($id)
    {
        $allData = [];
        $query = " SELECT count(*) AS CountData FROM anggaran WHERE id_anggaran =:id ";

        $this->db->query($query);
        $this->db->bind('id_anggaran', $id);
        $allData = $this->db->single();
        return $allData;
    }

    public function hapusData($id)
    {
        $query = " DELETE FROM anggaran WHERE id_anggaran =:id ";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataByKegiatan($id_kegiatan)
    {
        $query = " DELETE FROM anggaran WHERE id_kegiatan =:id_kegiatan ";
        $this->db->query($query);
        $this->db->bind('id_kegiatan', $id_kegiatan);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getRemainingAnggaranByKegiatan()
    {
        $query = "SELECT 
                    a.*,k.*,
                    CASE
                        WHEN a.no_rekening is null THEN '-'
                        WHEN a.no_rekening = '' THEN '-'
                        ELSE a.no_rekening
                    END as no_rekening_result,  
                    CASE
                        WHEN k.nama_kegiatan is null THEN '-'
                        ELSE k.nama_kegiatan
                    END as nama_kegiatan_result, 
                    CASE 
                        WHEN a.type_anggaran = 0 THEN a.nominal 
                        ELSE '0'
                    END as kredit, 
                    CASE 
                        WHEN a.type_anggaran = 1 THEN a.nominal 
                        ELSE '0' 
                    END as debit 
                FROM dinkop.anggaran a LEFT JOIN dinkop.kegiatan k on a.id_kegiatan = k.id_kegiatan ";
        $this->db->query($query);
        $allData = $this->db->resultset();
        return $allData;
    }

    public function getBatasPengeluaran($id_kegiatan)
    {
        $query = "SELECT
                    ((SELECT sum(nominal) FROM anggaran a where type_anggaran = 1) - (SELECT sum(nominal) FROM anggaran a WHERE type_anggaran = 0)) AS sisa 
                FROM 
                    kegiatan k JOIN anggaran a ON k.id_kegiatan = a.id_kegiatan
                WHERE a.type_anggaran = ".UANG_MASUK." and k.id_kegiatan =:id_kegiatan
                GROUP BY k.id_kegiatan ";
        $this->db->query($query);
        $this->db->bind('id_kegiatan', $id_kegiatan);
        $allData = $this->db->single();
        return $allData;
    }

    public function getTotalPengeluaran($id_kegiatan)
    {
        $query = "SELECT
                    sum(nominal) as total_sum
                FROM 
                    kegiatan k JOIN anggaran a ON k.id_kegiatan = a.id_kegiatan
                WHERE a.type_anggaran = ".UANG_KELUAR." and k.id_kegiatan =:id_kegiatan
                GROUP BY k.id_kegiatan ";
        $this->db->query($query);
        $this->db->bind('id_kegiatan', $id_kegiatan);
        $allData = $this->db->single();
        return (empty($allData))?$allData['total_sum'] = 0 : $allData;
    }

    public function getIdKegiatanByIdAnggaran($id_aggaran)
    {
        $query = "SELECT DISTINCT id_kegiatan  from anggaran a where id_anggaran =:id_aggaran ";
        $this->db->query($query);
        $this->db->bind('id_aggaran', $id_aggaran);
        $allData = $this->db->single();
        return $allData;
    }
}

/* define('WAITING','0');
define('PROCESS','1');
define('FINISH','2');
define('APPROVE','3'); */