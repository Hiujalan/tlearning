<?php

namespace App\Models;

use CodeIgniter\Model;

class SubTemaModel extends Model
{
    protected $table      = 'tbl_subtema';
    protected $primaryKey = 'id';
    protected $allowedFields = ['telp', 'subtema', 'url', 'kunci', 'status', 'created_at'];
}
