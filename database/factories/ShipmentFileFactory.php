<?php

namespace Database\Factories;

use App\Models\ShipmentFile;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFileFactory extends Factory
{

    protected $model = ShipmentFile::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "date_import" => $this->faker->dateTime(),
            "size" => 3212,
            "status_id" => null,
            "execute" => 0,
        ];
    }
}
