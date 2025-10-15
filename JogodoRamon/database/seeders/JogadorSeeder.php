<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JogadorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jogador')->insert([
            'nome' => 'Ramon',
            'genero' => 'masculino',
            'nivel' => 1,
            'experiencia' => 0,
            'vida_atual' => 100,
            'vida_maxima' => 100,
            'ataque' => 10,
            'defesa' => 5,
            'velocidade' => 5,
            'local_atual' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
