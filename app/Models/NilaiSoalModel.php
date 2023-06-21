<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiSoalModel extends Model
{
    protected $table      = 'tbl_nilai_soal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['telp', 'nama', 'jumlah_soal', 'penyelesaian', 'benar', 'salah', 'skor', 'pembelajaran', 'url', 'kunci', 'status', 'created_at'];
}
