<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = json_decode(file_get_contents(__DIR__ . '/data/cm.json'), true);

        foreach ($country["states"] as $state) {
            $s = State::create([
                "name" => $state["name"],
                "code" => $state["state_code"],
            ]);

            foreach ($state["cities"] as $city) {

                $s->cities()->create([
                    "name" => $city["name"],
                    "lat" => $city["latitude"],
                    "lng" => $city["longitude"],
                    "slug" => Str::slug($city["name"])
                ]);
            }
        }
    }
}
