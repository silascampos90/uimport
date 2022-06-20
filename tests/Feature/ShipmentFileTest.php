<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShipmentFileTest extends TestCase
{

    const DEFAULT_FILE_HEADER = ['from_postcode', 'to_postcode', 'from_weight', 'to_weight', 'cost'];   
  
    /** @test */
    public function check_valid_column_file()
    {        

        $file = __DIR__ . '/Resource/price-table-redu.csv';

        if (($open = fopen($file, "r")) !== FALSE) {

            $fileHeader = explode(';', fgetcsv($open)[0]);

            $this->assertEquals($fileHeader, ShipmentFileTest::DEFAULT_FILE_HEADER);
           
        }
    }
    
}
