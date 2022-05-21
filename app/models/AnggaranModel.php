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
                anggaran(id, tanggal, nominal, no_rekening, keterangan, type_anggaran, id_kegiatan, status)  
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
        $query = "  UPDATE anggaran SET 
                        tanggal         =:tanggal,
                        nominal         =:nominal,
                        no_rekening     =:no_rekening,
                        keterangan      =:keterangan,
                        type_anggaran   =:type_anggaran,
                        id_kegiatan     =:id_kegiatan,
                        status          =:status 
                    WHERE 
                        id =:id
            ";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
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

    public function ubahStatus($id_kegiatan, $status)
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

    public function getOneData($id)
    {
        $this->db->query(" SELECT * FROM anggaran WHERE id =:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function cekingData($id)
    {
        $allData = [];
        $query = " SELECT count(*) AS CountData FROM anggaran WHERE id =:id ";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $allData = $this->db->single();
        return $allData;
    }

    public function hapusData($id)
    {
        $query = " DELETE FROM anggaran WHERE id =:id ";
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

    /* Laporan */
    public function getLaporan($type_anggaran)
    {
        $query = "  SELECT 
                        a.*, 
                        k.nama_kegiatan, 
                        CASE 
                            WHEN a.type_anggaran = 0 THEN a.nominal 
                            ELSE 0 
                        END as kredit, 
                        CASE 
                            WHEN a.type_anggaran = 1 THEN a.nominal 
                            ELSE 0 
                        END as debit 
                    FROM anggaran a LEFT JOIN kegiatan k on a.id_kegiatan = k.id 
                    WHERE 
                        a.tanggal BETWEEN CAST(DATE_ADD(NOW(), INTERVAL -3 MONTH) AS DATE) AND CAST(NOW() AS DATE) 
                        AND type_anggaran in (:type_anggaran)";
        $this->db->query($query);
        $this->db->bind('type_anggaran', $type_anggaran);
        $allData = $this->db->resultset();
        for ($i = 0; $i < count($allData); $i++) {
            $status_loop = $allData[$i]["status"];
            if ($status_loop == WAITING) {
                $status_loop = "Proses Pemerikasaan";
            } else if ($status_loop == PROCESS) {
                $status_loop = "Telah di Setujui Bendahara";
            } else if ($status_loop == FINISH) {
                $status_loop = "Telah di Setuju PPTK";
            } else {
                $status_loop = " - ";
            }
            $allData[$i]['status'] = $status_loop;
            $allData[$i]['queryData'] = $query;
        }
        return $allData;
    }

    public function getLaporanSummary()
    {
        $query = "  SELECT 
                        a.*, 
                        k.nama_kegiatan, 
                        CASE 
                            WHEN a.type_anggaran = 0 THEN a.nominal 
                            ELSE '-'
                        END as kredit, 
                        CASE 
                            WHEN a.type_anggaran = 1 THEN a.nominal 
                            ELSE '-' 
                        END as debit 
                    FROM anggaran a LEFT JOIN kegiatan k on a.id_kegiatan = k.id 
                    WHERE 
                        a.tanggal BETWEEN CAST(DATE_ADD(NOW(), INTERVAL -3 MONTH) AS DATE) AND CAST(NOW() AS DATE) 
                        AND type_anggaran in ('1','0')";
        $this->db->query($query);
        $allData = $this->db->resultset();
        for ($i = 0; $i < count($allData); $i++) {
            $status_loop = $allData[$i]["status"];
            if ($status_loop == WAITING) {
                $status_loop = "Proses Pemerikasaan";
            } else if ($status_loop == PROCESS) {
                $status_loop = "Telah di Setujui Bendahara";
            } else if ($status_loop == FINISH) {
                $status_loop = "Telah di Setuju PPTK";
            } else {
                $status_loop = " - ";
            }
            $allData[$i]['status'] = $status_loop;
            $allData[$i]['queryData'] = $query;
        }
        return $allData;
    }
}

/* define('WAITING','0');
define('PROCESS','1');
define('FINISH','2');
define('APPROVE','3'); */