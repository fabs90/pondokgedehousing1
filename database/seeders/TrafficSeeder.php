<?php

namespace Database\Seeders;

use App\Models\Traffic;
use Illuminate\Database\Seeder;

class TrafficSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Traffic::insert(
            [
                'type' => 'whatsApp',
                'counter' => 0,
            ]
        );
    }
}
