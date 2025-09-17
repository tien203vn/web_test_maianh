<?php
namespace App\Classes;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Paypal
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
