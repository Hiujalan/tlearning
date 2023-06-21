<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelajaranModel extends Model
{
    protected $table      = 'tbl_pembelajaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['telp', 'pembelajaran', 'judul_video', 'video', 'nama_video', 'judul_materi', 'materi', 'nama_materi', 'diskusi', 'url', 'kunci', 'status', 'created_at'];

    public function getLatestUser()
    {
        return $this->db->table('tbl_pembelajaran')->orderBy('created_at', 'desc')->limit(1)->get()->getRow();
    }
}
