<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Province;
use App\Models\City;
use GuzzleHttp\Client;

class StoreDataRajaOngkirService extends ServiceProvider
{
    protected $apiKey;
    protected $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => 'https://api.rajaongkir.com/starter/',
            'headers' => [
                'key' => $apiKey,
            ],
        ]);
    }

    public function fetchDataAndStore()
    {
        $provinces = $this->fetchProvinces();
        $cities = $this->fetchCities();

        $this->storeProvinces($provinces);
        $this->storeCities($cities);
    }

    public function fetchProvinces()
    {
        $response = $this->client->get('province');
        return json_decode($response->getBody(), true)['rajaongkir']['results'];
    }

    protected function fetchCities()
    {
        $response = $this->client->get('city');
        return json_decode($response->getBody(), true)['rajaongkir']['results'];
    }

    protected function storeProvinces($provinces)
    {
        foreach ($provinces as $province) {
            Province::updateOrCreate(
                ['province_id' => $province['province_id']],
                ['province' => $province['province']]
            );
        }
    }

    protected function storeCities($cities)
    {
        foreach ($cities as $city) {
            City::updateOrCreate(
                ['city_id' => $city['city_id']],
                ['city' => $city['city_name']]
            );
        }
    }
}
