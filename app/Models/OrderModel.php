<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class OrderModel extends Model
{
    protected $db;
    protected $table = 'rentals_fix';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'username', 'phone_number', 'alat', 'rental_duration', 'schedule_date_time', 'created_at', 'payment_method'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    public function __construct(ConnectionInterface &$db) {
        $this->db =& $db;
    }

    function add($data) {
        return $this->db
            ->table('rentals_fix')
            ->insert($data);
    }

    public function getOrderId($item)
    {
        return $this->asArray()
            ->where(['name' => $item])
            ->first();
    }
    public function getOrderAvailability($item)
    {
        return $this->asArray()
            ->where(['name' => $item])
            ->first();
    }
    public function getAllOrder(){
        return $this->asArray()
            ->findAll();
    }
    public function insertOrder($data)
    {
        return $this->insert($data);
    }
}