<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->insert([
            ['type_id' => 1, 'capacity_id' => 1, 'day_type' => 'Weekday', 'price' => 100],
            ['type_id' => 1, 'capacity_id' => 1, 'day_type' => 'Weekend', 'price' => 101],
            ['type_id' => 1, 'capacity_id' => 2, 'day_type' => 'Weekday', 'price' => 200],
            ['type_id' => 1, 'capacity_id' => 2, 'day_type' => 'Weekend', 'price' => 201],
            ['type_id' => 1, 'capacity_id' => 3, 'day_type' => 'Weekday', 'price' => 300],
            ['type_id' => 1, 'capacity_id' => 3, 'day_type' => 'Weekend', 'price' => 301],
            ['type_id' => 1, 'capacity_id' => 4, 'day_type' => 'Weekday', 'price' => 400],
            ['type_id' => 1, 'capacity_id' => 4, 'day_type' => 'Weekend', 'price' => 401],

            ['type_id' => 2, 'capacity_id' => 1, 'day_type' => 'Weekday', 'price' => 100],
            ['type_id' => 2, 'capacity_id' => 1, 'day_type' => 'Weekend', 'price' => 101],
            ['type_id' => 2, 'capacity_id' => 2, 'day_type' => 'Weekday', 'price' => 200],
            ['type_id' => 2, 'capacity_id' => 2, 'day_type' => 'Weekend', 'price' => 201],
            ['type_id' => 2, 'capacity_id' => 3, 'day_type' => 'Weekday', 'price' => 300],
            ['type_id' => 2, 'capacity_id' => 3, 'day_type' => 'Weekend', 'price' => 301],
            ['type_id' => 2, 'capacity_id' => 4, 'day_type' => 'Weekday', 'price' => 400],
            ['type_id' => 2, 'capacity_id' => 4, 'day_type' => 'Weekend', 'price' => 401],

            ['type_id' => 3, 'capacity_id' => 1, 'day_type' => 'Weekday', 'price' => 100],
            ['type_id' => 3, 'capacity_id' => 1, 'day_type' => 'Weekend', 'price' => 101],
            ['type_id' => 3, 'capacity_id' => 2, 'day_type' => 'Weekday', 'price' => 200],
            ['type_id' => 3, 'capacity_id' => 2, 'day_type' => 'Weekend', 'price' => 201],
            ['type_id' => 3, 'capacity_id' => 3, 'day_type' => 'Weekday', 'price' => 300],
            ['type_id' => 3, 'capacity_id' => 3, 'day_type' => 'Weekend', 'price' => 301],
            ['type_id' => 3, 'capacity_id' => 4, 'day_type' => 'Weekday', 'price' => 400],
            ['type_id' => 3, 'capacity_id' => 4, 'day_type' => 'Weekend', 'price' => 401],

            ['type_id' => 4, 'capacity_id' => 1, 'day_type' => 'Weekday', 'price' => 100],
            ['type_id' => 4, 'capacity_id' => 1, 'day_type' => 'Weekend', 'price' => 101],
            ['type_id' => 4, 'capacity_id' => 2, 'day_type' => 'Weekday', 'price' => 200],
            ['type_id' => 4, 'capacity_id' => 2, 'day_type' => 'Weekend', 'price' => 201],
            ['type_id' => 4, 'capacity_id' => 3, 'day_type' => 'Weekday', 'price' => 300],
            ['type_id' => 4, 'capacity_id' => 3, 'day_type' => 'Weekend', 'price' => 301],
            ['type_id' => 4, 'capacity_id' => 4, 'day_type' => 'Weekday', 'price' => 400],
            ['type_id' => 4, 'capacity_id' => 4, 'day_type' => 'Weekend', 'price' => 401],

            ['type_id' => 5, 'capacity_id' => 1, 'day_type' => 'Weekday', 'price' => 100],
            ['type_id' => 5, 'capacity_id' => 1, 'day_type' => 'Weekend', 'price' => 101],
            ['type_id' => 5, 'capacity_id' => 2, 'day_type' => 'Weekday', 'price' => 200],
            ['type_id' => 5, 'capacity_id' => 2, 'day_type' => 'Weekend', 'price' => 201],
            ['type_id' => 5, 'capacity_id' => 3, 'day_type' => 'Weekday', 'price' => 300],
            ['type_id' => 5, 'capacity_id' => 3, 'day_type' => 'Weekend', 'price' => 301],
            ['type_id' => 5, 'capacity_id' => 4, 'day_type' => 'Weekday', 'price' => 400],
            ['type_id' => 5, 'capacity_id' => 4, 'day_type' => 'Weekend', 'price' => 401],
        ]);
    }
}
