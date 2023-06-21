<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalModel extends Model
{
    protected $table      = 'tbl_soal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['telp', 'soal_id', 'soal', 'jawaban', 'opsi1', 'opsi2', 'opsi3', 'opsi4', 'jam', 'menit', 'detik','pembelajaran', 'url', 'kunci','status', 'created_at'];

    public function getLastRow($urltema)
    {
        $builder = $this->db->table('tbl_soal');

        // melakukan query untuk mengambil baris terakhir
        $query = $builder->where('url', $urltema)->orderBy('soal_id', 'DESC')->limit(1)->get();

        // mengembalikan hasil query sebagai objek row
        $result = $query->getRow();

        return $result;
    }
}
