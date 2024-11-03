<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ItemModel extends Model
{
    protected $db;
    protected $table = 'alat_kemah';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'total_stock', 'price', 'availability', 'description', 'specifications', 'image'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    public function __construct(ConnectionInterface &$db) {
        $this->db =& $db;
    }

    function add($data) {
        return $this->db
            ->table('alat_kemah')
            ->insert($data);
    }

    public function getItemId($item)
    {
        return $this->asArray()
            ->where(['name' => $item])
            ->first();
    }
    public function getItemAvailability($item)
    {
        return $this->asArray()
            ->where(['name' => $item])
            ->first();
    }
    public function getAllItems(){
        return $this->asArray()
            ->findAll();
    }
    public function insertItem($data)
    {
        return $this->insert($data);
    }
}