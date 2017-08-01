<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PurchaseTableSeeder extends Seeder
{

    public function run()
    {

        App\Purchase::create([
            'id' => 1,
            'purchase_date' => '2017-07-01',
            'count' => 15,
            'total' => 30,
            'user_id' => 2
        ]);

        App\Purchase::create([
            'id' => 2,
            'purchase_date' => '2017-07-10',
            'count' => 10,
            'total' => 20,
            'user_id' => 2
        ]);

        App\Purchase::create([
            'id' => 3,
            'purchase_date' => '2017-07-15',
            'count' => 15,
            'total' => 15,
            'user_id' => 2
        ]);

        App\Purchase::create([
            'id' => 4,
            'purchase_date' => '2017-07-17',
            'count' => 25,
            'total' => 25,
            'user_id' => 4
        ]);

        App\Purchase::create([
            'id' => 5,
            'purchase_date' => '2017-07-05',
            'count' => 25,
            'total' => 50,
            'user_id' => 6
        ]);

        App\Purchase::create([
            'id' => 6,
            'purchase_date' => '2017-07-20',
            'count' => 15,
            'total' => 15,
            'user_id' => 7
        ]);

        App\Purchase::create([
            'id' => 7,
            'purchase_date' => '2017-07-25',
            'count' => 17,
            'total' => 17,
            'user_id' => 8
        ]);

        App\Purchase::create([
            'id' => 8,
            'purchase_date' => '2017-08-01',
            'count' => 15,
            'total' => 30,
            'user_id' => 9
        ]);

        App\Purchase::create([
            'id' => 9,
            'purchase_date' => '2017-08-01',
            'count' => 15,
            'total' => 30,
            'user_id' => 10
        ]);

        App\Purchase::create([
            'id' => 10,
            'purchase_date' => '2017-06-01',
            'count' => 15,
            'total' => 30,
            'user_id' => 13
        ]);


        App\Purchase::create([
            'id' => 11,
            'purchase_date' => '2017-06-05',
            'count' => 15,
            'total' => 30,
            'user_id' => 12
        ]);

        App\Purchase::create([
            'id' => 12,
            'purchase_date' => '2017-06-11',
            'count' => 25,
            'total' => 50,
            'user_id' => 7
        ]);


    }

}
