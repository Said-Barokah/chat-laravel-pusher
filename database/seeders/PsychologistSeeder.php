<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Psychologist;
class PsychologistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Psychologist::create([
            'name' => 'Said - Psychologist',
            'email' => 'said@psychologist.com',
            'password' => bcrypt('12202474'),
        ]);
    }
}
