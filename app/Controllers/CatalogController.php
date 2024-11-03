<?php

namespace App\Controllers;
use App\Models\ItemModel;

class CatalogController extends BaseController
{
    protected $itemModel;
    public function __construct() {

        $db = db_connect();
        $this->itemModel = new ItemModel($db);
    }
    public function viewCatalog(): string
    {
        return view('catalog');
    }
    public function viewRent(): string
    {
        
        $items = $this->itemModel->getAllItems();
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
}
