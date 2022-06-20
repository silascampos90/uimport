<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusImport;

class StatusImportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusImport::create([
            'name'=>'Não Processado',
            'active'=>1
        ]);
        StatusImport::create([
            'name'=>'Em Processamento',
            'active'=>1
        ]);
        StatusImport::create([
            'name'=>'Finalizado',
            'active'=>1
        ]);
        StatusImport::create([
            'name'=>'Error',
            'active'=>1
        ]);
    }
}
