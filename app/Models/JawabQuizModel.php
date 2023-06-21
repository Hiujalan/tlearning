<?php

namespace App\Models;

use CodeIgniter\Model;

class JawabQuizModel extends Model
{
    protected $table      = 'tbl_jawab_quiz';
    protected $primaryKey = 'id';
    protected $allowedFields = ['soal_id', 'nama', 'telp', 'jawaban1', 'jawaban2', 'jawaban', 'screenshot', 'pembelajaran', 'url', 'kunci', 'status'];
}
