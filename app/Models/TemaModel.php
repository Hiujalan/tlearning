<?php

namespace App\Models;

use CodeIgniter\Model;

class TemaModel extends Model
{
    protected $table      = 'tbl_tema';
    protected $primaryKey = 'id';
    protected $allowedFields = ['telp', 'tema', 'url', 'logo', 'status', 'created_at'];

    public function search($id)
    {
        $builder = $this->table($this->table);

        // Lakukan pencarian dengan query LIKE
        $builder->like('tema', $id);

        $builder->where('status', '0');

        // Ambil hasil pencarian
        $query = $builder->get();

        return $query->getResult();
    }
}
