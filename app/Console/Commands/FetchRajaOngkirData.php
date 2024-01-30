<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Providers\StoreDataRajaOngkirService;

class FetchRajaOngkirData extends Command
{
    protected $signature = 'rajaongkir:fetch';

    protected $description = 'Fetch and store Rajaongkir data';

    public function handle(StoreDataRajaOngkirService $storeDataRajaOngkirService)
    {
        $storeDataRajaOngkirService->fetchDataAndStore();

        $this->info('Data fetched and stored successfully.');
    }
}
