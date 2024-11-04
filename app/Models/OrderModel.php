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
    public function getCount() {
        return $this->db->table($this->table)->countAllResults();
    }
    public function getMostOrderedItem() {
        $query = $this->asArray()
                  ->select('alat, COUNT(*) as order_count')
                  ->groupBy('alat')
                  ->orderBy('order_count', 'DESC')
                  ->limit(1)
                  ->get(); // Executes the query
    return $query->getRowArray();
    }
    public function countOrdersLastWeek() {
        $query = $this->asArray()
                  ->select('COUNT(*) as week_count')
                  ->where('schedule_date_time >=', 'NOW() - INTERVAL 7 DAY', false)
                  ->get(); // Executes the query
    return $query->getRowArray();
    }
    public function countOrdersLastMonth() {
        $query = $this->asArray()
                  ->select('COUNT(*) as month_count')
                  ->where('schedule_date_time >=', 'NOW() - INTERVAL 1 MONTH', false)
                  ->get(); // Executes the query
    return $query->getRowArray();
    }
    public function countOrdersLastYear() {
        $query = $this->asArray()
                  ->select('COUNT(*) as year_count')
                  ->where('schedule_date_time >=', 'NOW() - INTERVAL 1 YEAR', false)
                  ->get(); // Executes the query
    return $query->getRowArray();
    }
    public function countOrdersGroupedByDate() {
    $query = $this->asArray()
                  ->select('DATE(schedule_date_time) as date, COUNT(*) as count')
                  ->groupBy("DATE(schedule_date_time)")
                  ->orderBy("date", "ASC")
                  ->findAll();  // This is assuming that findAll() retrieves all rows; the actual method name might vary based on the framework.

    return $query;
    }
}