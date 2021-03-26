<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Country $countryModel
     * @return void
     */
    public function run(Country $countryModel)
    {
        $countries = config('default.countries');

        foreach ($countries as $country) {
            $countryModel->create($country);
        }
    }
}
