<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'tbl_admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'telp', 'password', 'foto', 'role', 'status', 'created_at'];
}
