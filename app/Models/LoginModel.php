<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'tbl_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_google', 'id_facebook', 'nama', 'email', 'telp', 'foto', 'role', 'kode','status', 'created_at'];

    public function getLatestUser()
    {
        return $this->db->table('tbl_user')->orderBy('created_at', 'desc')->limit(1)->get()->getRow();
    }
}
