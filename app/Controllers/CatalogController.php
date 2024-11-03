<?php

namespace App\Controllers;

class CatalogController extends BaseController
{
    public function viewCatalog(): string
    {
        return view('catalog');
    }
    public function viewRent(): string
    {
        return view('rentform');
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
