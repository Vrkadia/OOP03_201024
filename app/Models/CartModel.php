<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class CartModel extends Model
{
    protected $db;
    protected $table = 'rentals';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'username', 'phone_number', 'alat', 'rental_duration', 'schedule_date_time', 'created_at', 'payment_method'];
    protected $useTimestamps = false;
    public function __construct(ConnectionInterface &$db) {
        $this->db =& $db;
    }

    function add($data) {
        return $this->db
            ->table('rentals_fix')
            ->insert($data);
    }

    public function getAllCart(){
        return $this->asArray()
            ->findAll();
    }
    public function insertCart($data)
    {
        return $this->insert($data);
    }
    public function getAllCartItemFromUser($username){
        return $this->asArray()
            ->where(['username' => $username])
            ->orderBy('id', 'DESC')
            ->findAll();
    }
    public function deleteByUsername($username){
        return $this ->where(['username'=> $username])->delete();
    }
}