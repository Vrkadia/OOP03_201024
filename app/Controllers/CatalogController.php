<?php

namespace App\Controllers;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\ItemModel;

class CatalogController extends BaseController
{
    protected $itemModel;
    protected $orderModel;
    protected $cartModel;
    public function __construct() {

        $db = db_connect();
        $this->cartModel = new CartModel($db);
        $this->orderModel = new OrderModel($db);
        $this->itemModel = new ItemModel($db);

    }
    public function viewCatalog()
    {
        return view("catalog");
    }
    public function viewRent(): string
    {
        
        $items = $this->itemModel->getAllItems();
        $data = ['items' => $items];
        return view('rentform', $data);
    }
    public function viewCart(): string
    {
        $username = session()->get('username');
        $cart = $this->cartModel->getAllCartItemFromUser($username);
        $data = ['cart' => $cart];
        return view('cart', $data);
    }
    public function viewHistory(): string
    {
        $username = session()->get('username');
    
        $cart = $this->cartModel->getAllCartItemFromUser($username);
        
        foreach ($cart as $item) {
            $this->orderModel->save([
                'username' => $item['username'],
                'phone_number' => $item['phone_number'],
                'alat' => $item['alat'],
                'rental_duration' => $item['rental_duration'],
                'schedule_date_time' => $item['schedule_date_time'],
                'payment_method' => $item['payment_method']
            ]);
        }
        
        $this->cartModel->deleteByUsername($username);
        
        // Retrieve all order history for the current user to display
        $history = $this->orderModel->getAllOrderFromUser($username);
        
        // Pass the history data to the view
        $data = ['history' => $history];
        
        return view('history', $data);
    }
    public function saveRent()
    {
        
    }
    public function inputCartRent(){
        $username = session()->get('username');
        if (!$username) return redirect()->back()->with('error', 'Silahkan Login dulu');
        $phone = session()->get('phone_number');
        $alat = $this->request->getPost('i_alat');
        $durasi = $this->request->getPost('i_rentalDuration');
        $pembayaran = $this->request->getPost('i_paymentMethod');
        $tanggal_peminjaman = $this->request->getPost('i_scheduleDateTime');

        $data = [
            'alat'    => $alat,
            'username'    => $username,
            'phone_number'    => $phone,
            'rental_duration' => $durasi,
            'schedule_date_time'     => $tanggal_peminjaman,
            'payment_method'     => $pembayaran
        ];

        $this->cartModel->save($data);

        return redirect()->to('/rent')->with('success', 'Pesanan teracatat. Terimakasih.');
    }
}
