<?php

namespace App\Controllers;
use App\Models\ItemModel;

class HomeController extends BaseController
{
    protected $itemModel;

    public function __construct() {

        $db = db_connect();
        $this->itemModel = new ItemModel($db);
    }
    public function index() {
        // if (!session()->has('isLoggedIn')) {
        //     return redirect()->to('/login');
        // }
        $username = session()->get('username');

        $items = $this->itemModel->getAllItems();
        $data = ['username' => $username, 'items' => $items];
        return view('landingpage', $data);

    }
}
