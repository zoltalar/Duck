<?php

use App\Country;
use App\State;
use App\Transformers\CsvRowTransformer;
use Illuminate\Database\Seeder;

final class StatesSeeder extends Seeder
{
    /**
     * CSV file to import.
     *
     * @var string
     */
    protected $file = 'states.csv';

    /**
     * Path where CSV file is located.
     *
     * @var string
     */
    protected $path = 'database/seeds/csv/';

    /**
     * Country name to country ID cache.
     *
     * @var array
     */
    protected $cache = [];

    public function run()
    {
        $file = base_path($this->path . $this->file);

        if ( ! is_file($file)) {
            throw new Exception('States CSV file was not found');
        }

        $fh = fopen($file,'r');
        $transformer = new CsvRowTransformer();
        $i = 0;

        while (($row = fgetcsv($fh)) !== false) {
            if ($i == 0) {
                $transformer->setHeaders($row);
            } else {
                $row = $transformer->transformItem($row);

                if ( ! isset($this->cache[$row['country']])) {
                    $country = Country::where('name', $row['country'])
                        ->get()
                        ->first();

                    if ($country !== null) {
                        $this->cache[$row['country']] = $country->id;
                    }
                }

                if (isset($this->cache[$row['country']])) {
                    $state = [
                        'country_id' => $this->cache[$row['country']],
                        'name' => $row['name'],
                        'abbr' => $row['abbr']
                    ];

                    State::firstOrCreate(array_only($state, ['country_id', 'name']), $state);
                }
            }

            $i++;
        }
    }
}
