<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{
    protected $table      = 'tbl_email_gateway';
    protected $primaryKey = 'id';
    protected $allowedFields = ['server', 'email', 'password', 'status', 'created_at'];

    public function getEmailConfig()
    {
        // Menggunakan Model Query untuk mengambil data konfigurasi email dari tabel
        $result = $this->db->table('tbl_email_gateway')->get()->getRowArray();

        return $result;
    }

    public function getLatestEmail()
    {
        return $this->db->table('tbl_email_gateway')->orderBy('created_at', 'desc')->limit(1)->get()->getRow();
    }
}
