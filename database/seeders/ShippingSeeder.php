<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippings')->insert([
            ['postcode_fr' => '01000', 'postcode_to' => '86999', 'weight_fr' => 100, 'weight_to' => 500, 'fee' => 956], //sm
            ['postcode_fr' => '87000', 'postcode_to' => '88999', 'weight_fr' => 100, 'weight_to' => 500, 'fee' => 1673], //kk
            ['postcode_fr' => '89000', 'postcode_to' => '92999', 'weight_fr' => 100, 'weight_to' => 500, 'fee' => 1719], //sb
            ['postcode_fr' => '93000', 'postcode_to' => '93999', 'weight_fr' => 100, 'weight_to' => 500, 'fee' => 1481], //ku
            ['postcode_fr' => '94000', 'postcode_to' => '99999', 'weight_fr' => 100, 'weight_to' => 500, 'fee' => 1719], //sr
            //501-1000
            ['postcode_fr' => '01000', 'postcode_to' => '86999', 'weight_fr' => 501, 'weight_to' => 1000, 'fee' => 1244], //sm
            ['postcode_fr' => '87000', 'postcode_to' => '88999', 'weight_fr' => 501, 'weight_to' => 1000, 'fee' => 2190], //kk
            ['postcode_fr' => '89000', 'postcode_to' => '92999', 'weight_fr' => 501, 'weight_to' => 1000, 'fee' => 2417], //sb
            ['postcode_fr' => '93000', 'postcode_to' => '93999', 'weight_fr' => 501, 'weight_to' => 1000, 'fee' => 1723], //ku
            ['postcode_fr' => '94000', 'postcode_to' => '99999', 'weight_fr' => 501, 'weight_to' => 1000, 'fee' => 2417], //sr
            //1001-2000
            ['postcode_fr' => '01000', 'postcode_to' => '86999', 'weight_fr' => 1001, 'weight_to' => 2000, 'fee' => 1480], //sm
            ['postcode_fr' => '87000', 'postcode_to' => '88999', 'weight_fr' => 1001, 'weight_to' => 2000, 'fee' => 3836], //kk
            ['postcode_fr' => '89000', 'postcode_to' => '92999', 'weight_fr' => 1001, 'weight_to' => 2000, 'fee' => 4416], //sb
            ['postcode_fr' => '93000', 'postcode_to' => '93999', 'weight_fr' => 1001, 'weight_to' => 2000, 'fee' => 3142], //ku
            ['postcode_fr' => '94000', 'postcode_to' => '99999', 'weight_fr' => 1001, 'weight_to' => 2000, 'fee' => 4416], //sr
            //2001-3000
            ['postcode_fr' => '01000', 'postcode_to' => '86999', 'weight_fr' => 2001, 'weight_to' => 3000, 'fee' => 1718], //sm
            ['postcode_fr' => '87000', 'postcode_to' => '88999', 'weight_fr' => 2001, 'weight_to' => 3000, 'fee' => 5484], //kk
            ['postcode_fr' => '89000', 'postcode_to' => '92999', 'weight_fr' => 2001, 'weight_to' => 3000, 'fee' => 6412], //sb
            ['postcode_fr' => '93000', 'postcode_to' => '93999', 'weight_fr' => 2001, 'weight_to' => 3000, 'fee' => 4560], //ku
            ['postcode_fr' => '94000', 'postcode_to' => '99999', 'weight_fr' => 2001, 'weight_to' => 3000, 'fee' => 6412], //sr
            //3001-4000
            ['postcode_fr' => '01000', 'postcode_to' => '86999', 'weight_fr' => 3001, 'weight_to' => 4000, 'fee' => 1955], //sm
            ['postcode_fr' => '87000', 'postcode_to' => '88999', 'weight_fr' => 3001, 'weight_to' => 4000, 'fee' => 7131], //kk
            ['postcode_fr' => '89000', 'postcode_to' => '92999', 'weight_fr' => 3001, 'weight_to' => 4000, 'fee' => 8411], //sb
            ['postcode_fr' => '93000', 'postcode_to' => '93999', 'weight_fr' => 3001, 'weight_to' => 4000, 'fee' => 5980], //ku
            ['postcode_fr' => '94000', 'postcode_to' => '99999', 'weight_fr' => 3001, 'weight_to' => 4000, 'fee' => 8411], //sr
            //4001-5000
            ['postcode_fr' => '01000', 'postcode_to' => '86999', 'weight_fr' => 4001, 'weight_to' => 5000, 'fee' => 2194], //sm
            ['postcode_fr' => '87000', 'postcode_to' => '88999', 'weight_fr' => 4001, 'weight_to' => 5000, 'fee' => 8778], //kk
            ['postcode_fr' => '89000', 'postcode_to' => '92999', 'weight_fr' => 4001, 'weight_to' => 5000, 'fee' => 10407], //sb
            ['postcode_fr' => '93000', 'postcode_to' => '93999', 'weight_fr' => 4001, 'weight_to' => 5000, 'fee' => 7397], //ku
            ['postcode_fr' => '94000', 'postcode_to' => '99999', 'weight_fr' => 4001, 'weight_to' => 5000, 'fee' => 10407], //sr
            //5001-6000
            ['postcode_fr' => '01000', 'postcode_to' => '86999', 'weight_fr' => 5001, 'weight_to' => 6000, 'fee' => 2430], //sm
            ['postcode_fr' => '87000', 'postcode_to' => '88999', 'weight_fr' => 5001, 'weight_to' => 6000, 'fee' => 10425], //kk
            ['postcode_fr' => '89000', 'postcode_to' => '92999', 'weight_fr' => 5001, 'weight_to' => 6000, 'fee' => 12404], //sb
            ['postcode_fr' => '93000', 'postcode_to' => '93999', 'weight_fr' => 5001, 'weight_to' => 6000, 'fee' => 8815], //ku
            ['postcode_fr' => '94000', 'postcode_to' => '99999', 'weight_fr' => 5001, 'weight_to' => 6000, 'fee' => 12404], //sr
            //6001-7000
            ['postcode_fr' => '01000', 'postcode_to' => '86999', 'weight_fr' => 6001, 'weight_to' => 7000, 'fee' => 2668], //sm
            ['postcode_fr' => '87000', 'postcode_to' => '88999', 'weight_fr' => 6001, 'weight_to' => 7000, 'fee' => 12070], //kk
            ['postcode_fr' => '89000', 'postcode_to' => '92999', 'weight_fr' => 6001, 'weight_to' => 7000, 'fee' => 14403], //sb
            ['postcode_fr' => '93000', 'postcode_to' => '93999', 'weight_fr' => 6001, 'weight_to' => 7000, 'fee' => 10233], //ku
            ['postcode_fr' => '94000', 'postcode_to' => '99999', 'weight_fr' => 6001, 'weight_to' => 7000, 'fee' => 14403], //sr
            //7001-8000
            ['postcode_fr' => '01000', 'postcode_to' => '86999', 'weight_fr' => 7001, 'weight_to' => 8000, 'fee' => 2904], //sm
            ['postcode_fr' => '87000', 'postcode_to' => '88999', 'weight_fr' => 7001, 'weight_to' => 8000, 'fee' => 13717], //kk
            ['postcode_fr' => '89000', 'postcode_to' => '92999', 'weight_fr' => 7001, 'weight_to' => 8000, 'fee' => 16400], //sb
            ['postcode_fr' => '93000', 'postcode_to' => '93999', 'weight_fr' => 7001, 'weight_to' => 8000, 'fee' => 11651], //ku
            ['postcode_fr' => '94000', 'postcode_to' => '99999', 'weight_fr' => 7001, 'weight_to' => 8000, 'fee' => 16400], //sr
            //8001-9000
            ['postcode_fr' => '01000', 'postcode_to' => '86999', 'weight_fr' => 8001, 'weight_to' => 9000, 'fee' => 3142], //sm
            ['postcode_fr' => '87000', 'postcode_to' => '88999', 'weight_fr' => 8001, 'weight_to' => 9000, 'fee' => 15365], //kk
            ['postcode_fr' => '89000', 'postcode_to' => '92999', 'weight_fr' => 8001, 'weight_to' => 9000, 'fee' => 18395], //sb
            ['postcode_fr' => '93000', 'postcode_to' => '93999', 'weight_fr' => 8001, 'weight_to' => 9000, 'fee' => 13070], //ku
            ['postcode_fr' => '94000', 'postcode_to' => '99999', 'weight_fr' => 8001, 'weight_to' => 9000, 'fee' => 18395], //sr
            //9001-10000
            ['postcode_fr' => '01000', 'postcode_to' => '86999', 'weight_fr' => 9001, 'weight_to' => 10000, 'fee' => 3378], //sm
            ['postcode_fr' => '87000', 'postcode_to' => '88999', 'weight_fr' => 9001, 'weight_to' => 10000, 'fee' => 17012], //kk
            ['postcode_fr' => '89000', 'postcode_to' => '92999', 'weight_fr' => 9001, 'weight_to' => 10000, 'fee' => 20393], //sb
            ['postcode_fr' => '93000', 'postcode_to' => '93999', 'weight_fr' => 9001, 'weight_to' => 10000, 'fee' => 14488], //ku
            ['postcode_fr' => '94000', 'postcode_to' => '99999', 'weight_fr' => 9001, 'weight_to' => 10000, 'fee' => 20393], //sr
        ]);
    }
}
