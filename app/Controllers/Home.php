<?php

namespace App\Controllers;

use App\Models\ProductModel; 

class Home extends BaseController
{
    protected $produk;

function __construct() 
{
    $this->product = new ProductModel();
}

    public function index(): string
    {
        //return view('v_home');
        $product = $this->product->findAll();
        $data['product'] = $product;
        
        return view('v_home', $data);
    }
}
