<?php

namespace App\Controllers;
use App\Models\ItemModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    protected $itemModel;
    protected $orderModel;
    protected $userModel;


    public function __construct() {

        $db = db_connect();
        $this->itemModel = new ItemModel($db);
        $this->orderModel = new OrderModel($db);
        $this->userModel = new UserModel($db);
    }
    public function index() {
        
        $username = session()->get('username');

        $items = $this->itemModel->getAllItems();
        $data = ['username' => $username, 'items' => $items];
        return view('landingpage', $data);

    }
    public function viewDashboard()
    {
        $username = session()->get('username');
        $orders = $this->orderModel->getAllOrder();
        $item_count = $this->itemModel->getCount();
        $order_count = $this->orderModel->getCount();
        $user_count = $this->userModel->getCount();
        $most_ordered = $this->orderModel->getMostOrderedItem();
        $week_stats = $this->orderModel->countOrdersLastWeek();
        $month_stats = $this->orderModel->countOrdersLastMonth();
        $year_stats = $this->orderModel->countOrdersLastYear();
        $statistics = $this->orderModel->countOrdersGroupedByDate();
        $kemah_stock = $this->itemModel->getAllItems();


        $data = [
            'username' => $username, 
            'item_count' => $item_count, 
            'order_count' => $order_count, 
            'user_count' => $user_count, 
            'most_ordered' => $most_ordered,
            'orders' => $orders,
            'week_stats' => $week_stats,
            'month_stats' => $month_stats,
            'year_stats' => $year_stats,
            'statistics' => $statistics,
            'kemah_stock' => $kemah_stock
        ];
        return view('dashboard', $data);
    }
}
