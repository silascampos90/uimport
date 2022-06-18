<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShipmentFile;

class FilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShipmentFile::factory(100)->create();
    }
}
