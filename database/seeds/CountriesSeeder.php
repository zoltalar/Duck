<?php

use App\Country;
use Illuminate\Database\Seeder;

final class CountriesSeeder extends Seeder
{
    /**
     * Countries to import.
     *
     * @return  array
     */
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
