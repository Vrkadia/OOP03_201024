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
    public function deletePesanan(){
        $order_id = $this->request->getPost('order_id');
        $this->orderModel->delete($order_id);

        return redirect()->to('/dashboard')->with('success', 'Penghapusan berhasil.');
    }
    public function deleteItem(){
        $item_id = $this->request->getPost('product_id');
        $this->itemModel->deleteItem($item_id);

        return redirect()->to('/dashboard')->with('success', 'Penghapusan berhasil.');
    }
    public function addItem()
    {
        // Fetch form data
        $name = $this->request->getPost('name');
        $total_stock = $this->request->getPost('total_stock');
        $price = $this->request->getPost('price');
        $description = $this->request->getPost('description');
        $specifications = $this->request->getPost('specifications');
        $target_dir = "assets/images/"; // Directory to save the image
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Image validation
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // File upload and database save
        if ($uploadOk === 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Prepare data for database
                $data = [
                    'name' => $name,
                    'total_stock' => $total_stock,
                    'price' => $price,
                    'description' => $description,
                    'specifications' => $specifications,
                    'image' => $target_file
                ];

                // Try to save data
                if ($this->itemModel->save($data)) {
                    return redirect()->to('/dashboard')->with('success', 'Product added successfully.');
                } else {
                    // Log or display error if save fails
                    log_message('error', 'Database save failed: ' . json_encode($data));
                    echo "Database save failed.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, your file was not uploaded due to validation errors.";
        }
    }


    
}
