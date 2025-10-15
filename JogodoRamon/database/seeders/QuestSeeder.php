<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('quest')->insert([
            [
                'nome' => 'O Início da Jornada',
                'descricao' => 'Fale com o Ancião da Vila para começar sua aventura.',
                'recompensa_xp' => 100,
                'recompensa_item' => 1, // Poção de Cura
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
