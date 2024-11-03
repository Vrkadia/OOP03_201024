<?php

namespace App\Controllers;
use App\Models\OrderModel;
use App\Models\ItemModel;

class CatalogController extends BaseController
{
    protected $itemModel;
    protected $orderModel;
    public function __construct() {

        $db = db_connect();
        $this->orderModel = new OrderModel($db);
        $this->itemModel = new ItemModel($db);

    }
    public function viewCatalog()
    {
        return view("catalog");
    }
    public function viewRent(): string
    {
        
        $items = $this->orderModel->getAllOrder();
        $data = ['items' => $items];
        return view('rentform', $data);
    }
    public function viewCart(): string
    {
        return view('cart');
    }
    public function viewHistory(): string
    {
        return view('history');
    }
    public function saveRent()
    {
        $username = session()->get('username');
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

        $this->orderModel->save($data);

        return redirect()->to('/rent')->with('success', 'Pesanan teracatat. Terimakasih.');
    }
}
