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
    public function addItem(){
        //Mengambil data dari form
        $id = $this->itemModel->getLastItemId();
        $name = $this->request->getPost('name');
        $total_stock = $this->request->getPost('total_stock');
        $price = $this->request->getPost('price');
        $description = $this->request->getPost('description');
        $specifications = $this->request->getPost('specifications');
        $target_dir = "assets/images/"; // Direktori untuk menyimpan gambar
        $target_file = $target_dir . basename($_FILES["image"]["name"]); // Path lengkap untuk gambar
        $uploadOk = 1; // Indikator untuk status upload
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Mendapatkan tipe file gambar

        // Cek apakah gambar adalah gambar sebenarnya
        $check = getimagesize($_FILES["image"]["tmp_name"]); // Memeriksa apakah file adalah gambar
        if ($check === false) {
            echo "File bukan gambar."; // Pesan jika bukan gambar
            $uploadOk = 0; // Menandakan upload gagal
        }

        // Cek ukuran file
        if ($_FILES["image"]["size"] > 5000000) { // Maksimal ukuran 5 MB
            echo "Maaf, file terlalu besar."; // Pesan jika ukuran terlalu besar
            $uploadOk = 0; // Menandakan upload gagal
        }

        // Izinkan format file tertentu
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan."; // Pesan jika format tidak sesuai
            $uploadOk = 0; // Menandakan upload gagal
        }
        //Memasukkan semua data kedalam satu variable
        $data = [
            'id' => $id,
            'name'    => $name,
            'total_stock' => $total_stock,
            'price' => $price,
            'description' => $description,
            'specifications'     => $specifications,
            'image' => $target_file
        ];

        $this->itemModel->save($data);

        return redirect()->to('/dashboard')->with('success', 'Register barang berhasil.');
    }
    
}
