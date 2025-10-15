<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatalhaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('batalha')->insert([
            [
                'id_jogador' => 1,
                'id_inimigo' => 1, // Lobo Sombrio
                'resultado' => 'vitória',
                'data' => now()->subDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jogador' => 1,
                'id_inimigo' => 2, // Slime Verde
                'resultado' => 'vitória',
                'data' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
