<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\CURLRequest;

class RajaOngkirModel extends Model
{
    protected $CI;

    public function __construct()
    {
        $this->CI = \Config\Services::curlrequest();
    }

    public function getProvinces()
    {
        $response = $this->CI->request('GET', 'https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => config('RajaOngkir')->apiKey,
            ]
        ]);
        return json_decode($response->getBody())->rajaongkir->results;
    }

    public function getCities($provinceId)
    {
        $response = $this->CI->request('GET', 'https://api.rajaongkir.com/starter/city', [
            'headers' => [
                'key' => config('RajaOngkir')->apiKey,
            ],
            'query' => [
                'province' => $provinceId
            ]
        ]);
        return json_decode($response->getBody())->rajaongkir->results;
    }

    public function getAllNames($params)
    {
        $url = 'https://api.rajaongkir.com/starter/city';

        if ($params !== null) {
            $url .= '?id=' . urlencode($params);
        }

        $response = $this->CI->request('GET', $url, [
            'headers' => [
                'key' => config('RajaOngkir')->apiKey,
            ]
        ]);

        return json_decode($response->getBody())->rajaongkir->results;
    }

    public function getShippingCost($origin, $destination, $weight, $courier)
    {
        $response = $this->CI->request('POST', 'https://api.rajaongkir.com/starter/cost', [
            'headers' => [
                'key' => config('RajaOngkir')->apiKey,
            ],
            'form_params' => [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier,
            ]
        ]);
        return json_decode($response->getBody())->rajaongkir->results;
    }
}
