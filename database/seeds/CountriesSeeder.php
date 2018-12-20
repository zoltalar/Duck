<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    protected function countries()
    {
        return [
            [
                'name' => 'Poland',
                'code' => 'pl'
            ]
        ];
    }

    public function run()
    {
        foreach ($this->countries() as $country) {
            Country::firstOrCreate($country);
        }
    }
}
