<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->text(20);
        return [
            'name' => $name,
            "about" => $this->faker->longText(),
            "sub_sector_id" => random_int(1, 400),
            "slug" => Company::slug($name),
            "phone" => $this->faker->phoneNumber
        ];
    }
}
