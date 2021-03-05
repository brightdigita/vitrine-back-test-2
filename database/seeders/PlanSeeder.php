<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('rinvex.subscriptions.plan')->create([
            'name' => 'Privilege',
            'description' => 'Privilege plan',
            'price' => 500,
            'signup_fee' => 0,
            'invoice_period' => 1,
            "merchant_plan_id" => "dddd",
            'invoice_interval' => 'month',
            'trial_period' => 15,
            'trial_interval' => 'day',
            'sort_order' => 1,
            "currency" => "XAF"
        ]);

        app('rinvex.subscriptions.plan')->create([
            'name' => 'Privilege Plus',
            'description' => 'Privilege plus plan',
            'price' => 1500,
            'signup_fee' => 0,
            'invoice_period' => 1,
            "merchant_plan_id" => "dddd",
            'invoice_interval' => 'month',
            'trial_period' => 15,
            'trial_interval' => 'day',
            'sort_order' => 1,
            "currency" => "XAF"
        ]);
    }
}
