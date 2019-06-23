<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_types')->insert([
            ['id' => 1, 'name' => 'Standard'],
            ['id' => 2, 'name' => 'Deluxe'],
            ['id' => 3, 'name' => 'Superior'],
            ['id' => 4, 'name' => 'Villa'],
            ['id' => 5, 'name' => 'Bungalow']
        ]);

        DB::table('room_capacities')->insert([
            ['id' => 1, 'name' => 'Single'],
            ['id' => 2, 'name' => 'Double'],
            ['id' => 3, 'name' => 'Triple'],
            ['id' => 4, 'name' => 'Family'],
        ]);

        DB::table('rooms')->insert([
            ['name' => 'Room 1', 'type_id' => 1, 'capacity_id' => 1],
            ['name' => 'Room 2', 'type_id' => 1, 'capacity_id' => 2],
            ['name' => 'Room 3', 'type_id' => 2, 'capacity_id' => 3],
            ['name' => 'Room 4', 'type_id' => 2, 'capacity_id' => 4],
            ['name' => 'Room 5', 'type_id' => 3, 'capacity_id' => 1],
            ['name' => 'Room 6', 'type_id' => 3, 'capacity_id' => 2],
            ['name' => 'Room 7', 'type_id' => 4, 'capacity_id' => 3],
            ['name' => 'Room 8', 'type_id' => 5, 'capacity_id' => 4],
            ['name' => 'Room 9', 'type_id' => 5, 'capacity_id' => 1],
            ['name' => 'Room 10', 'type_id' => 5, 'capacity_id' => 2],
        ]);
    }
}
