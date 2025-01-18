<?php

namespace App\Libraries;

use Midtrans\Snap;
use Midtrans\Config;

class MidtransLibrary
{
    public function __construct()
    {
        // Load Midtrans configuration
        $config = config('Midtrans');

        Config::$serverKey = $config->serverKey;
        Config::$clientKey = $config->clientKey;
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createSnapToken($orderData)
    {
        try {
            $snapToken = Snap::getSnapToken($orderData);
            return $snapToken;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
