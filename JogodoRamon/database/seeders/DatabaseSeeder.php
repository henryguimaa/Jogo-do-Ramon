<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MapaSeeder::class,
            NpcSeeder::class,
            ItemSeeder::class,
            JogadorSeeder::class,
            QuestSeeder::class,
            InimigoSeeder::class,
            BatalhaSeeder::class,
        ]);
    }
}
