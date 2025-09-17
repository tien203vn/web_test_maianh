<?php
namespace App\Classes;

class Vnpay
{
    public function __construct()
    {
    }

    public function payment($order)
    {
        try {
            throw new \Exception('Fake error');
        } catch (\Exception $e) {
            return redirect('http://127.0.0.1:8000/cart/create');
        }
    }
}
