<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AuthTableSeeder::class);
        $this->call(AdminSettingsSeeder::class);
        $this->call(CompareCoinsSeeder::class);
        $this->call(LocalCoinSeeder::class);
        $this->call(LocalCurrencySeeder::class);
        $this->call(OfferTypeSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(ExchangeRateSeeder::class);

        Model::reguard();
    }
}
