<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NpcSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('npc')->insert([
            [
                'nome' => 'Ancião da Vila',
                'fala_inicial' => 'Bem-vindo, viajante. O destino de Dounia está em suas mãos.',
                'tipo' => 'historia',
                'id_mapa' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Mercador Rurik',
                'fala_inicial' => 'Tenho as melhores poções da região!',
                'tipo' => 'comerciante',
                'id_mapa' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
