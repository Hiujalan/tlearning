<?php

namespace App\Models;

use CodeIgniter\Model;

class DiskusiModel extends Model
{
    protected $table      = 'tbl_diskusi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_google', 'telp', 'nama', 'pesan', 'foto', 'diskusi', 'url', 'kunci', 'status'];
}
