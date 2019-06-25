<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotel')->insert([
            'name' => 'New World',
            'address' => '2974  Burwell Heights Road',
            'city' => 'Beaumont',
            'state' => 'Texas',
            'country' => 'US',
            'zip_code' => '77701',
            'phone_number' => '409-546-7010',
            'email' => 'info@hotel.com',
            'image_url' => '/images/hotel.jpg',
        ]);
    }
}
