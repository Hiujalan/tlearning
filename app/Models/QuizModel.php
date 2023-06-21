<?php

namespace App\Models;

use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $table      = 'tbl_quiz';
    protected $primaryKey = 'id';
    protected $allowedFields = ['telp', 'soal', 'soal_id', 'jawaban1', 'jawaban2', 'opsi1', 'opsi2', 'opsi3', 'opsi4', 'jam', 'menit', 'detik', 'pembelajaran', 'url', 'kunci', 'status', 'created_at'];

    public function getSoal($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getLastRow($urltema)
    {
        $builder = $this->db->table('tbl_quiz');

        // melakukan query untuk mengambil baris terakhir
        $query = $builder->where('url', $urltema)->orderBy('soal_id', 'DESC')->limit(1)->get();

        // mengembalikan hasil query sebagai objek row
        $result = $query->getRow();

        return $result;
    }
}
