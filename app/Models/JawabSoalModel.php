<?php

namespace App\Models;

use CodeIgniter\Model;

class JawabSoalModel extends Model
{
    protected $table      = 'tbl_jawab_soal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['soal_id', 'telp', 'nama', 'jawaban', 'koreksi', 'url', 'kunci', 'status'];

    public function getLastRow($urltema)
    {
        $builder = $this->db->table('tbl_jawab_soal');

        // melakukan query untuk mengambil baris terakhir
        $query = $builder->where('url', $urltema)->where('status', '0')->orderBy('soal_id', 'DESC')->limit(1)->get();

        // mengembalikan hasil query sebagai objek row
        $result = $query->getRow();

        return $result;
    }
}
