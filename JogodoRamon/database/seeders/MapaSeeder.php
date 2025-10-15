<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mapa')->insert([
            [
                'nome' => 'Vila Inicial',
                'descricao' => 'Uma vila pacífica onde a jornada começa.',
                'tipo' => 'vila',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Floresta Sombria',
                'descricao' => 'Uma floresta misteriosa cheia de criaturas estranhas.',
                'tipo' => 'floresta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
