<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ItemModel extends Model
{
    protected $db;
    protected $table = 'alat_kemah';
    // protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'total_stock', 'price', 'availability', 'description', 'specifications', 'image'];
    protected $useTimestamps = false;
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
    public function getCount() {
        return $this->select('*')->table($this->table)->countAllResults();
    }  
    public function deleteItem($item_id){
        return $this ->where(['id'=> $item_id])->delete();
    }  
    public function getLastItemId() {
        $query = $this->selectMax('id', 'last_id')
                      ->get();
        return $query->getRow()->last_id;
    }
    //DELETE FROM Customers WHERE CustomerName='Alfreds Futterkiste';
}