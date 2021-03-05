<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Sector;
use App\Models\SubSector;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectors = json_decode(file_get_contents(__DIR__ . '/data/sectors.json'), true);
        /* $deepl = new \ChrisKonnertz\DeepLy\DeepLy();
        try {
            $translatedText = $deepl->translate('Hello world!', \ChrisKonnertz\DeepLy\DeepLy::LANG_EN, \ChrisKonnertz\DeepLy\DeepLy::LANG_AUTO);

            dd($translatedText);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
        die() */
        $s = null;
        $ss = null;

        foreach ($sectors['sectors'] as $sector) {

            if (isset($sector['SECTEURS'])) {
                $s = Sector::create([
                    'name' => ucfirst(strtolower($sector['SECTEURS'])),
                    "slug" => Sector::slug($sector['SECTEURS'])
                ]);
            }

            if (isset($sector['SOUS-SECTEURS'])) {
                $ss = $s->subSectors()->create([
                    'name' => $sector['SOUS-SECTEURS'],
                    'slug' => SubSector::slug($sector['SOUS-SECTEURS']),
                ]);

                $ss->plan()->create([
                    'name' => $sector['BOUQUET'],
                    'description' => $sector['BOUQUET'],
                    'slug' => Plan::slug($sector['BOUQUET']),
                    'price' => $sector['COÛT MENSUEL'],
                    'signup_fee' => 0,
                    'invoice_period' => 1,
                    'invoice_interval' => 'month',
                    'trial_period' => 7,
                    'trial_interval' => 'day',
                    'sort_order' => 1,
                    "currency" => "XAF"
                ]);
            }
        }
    }
}
