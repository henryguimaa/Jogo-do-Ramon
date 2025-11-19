<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(Character $character)
    {
        // Exemplo de mapa simples (poderia ser levels, áreas, etc)
        $areas = [
            ['name' => 'Vilarejo Inicial', 'danger' => 'Baixo'],
            ['name' => 'Floresta Sombria',  'danger' => 'Médio'],
            ['name' => 'Ruínas Antigas',    'danger' => 'Alto'],
            ['name' => 'Montanha do Dragão', 'danger' => 'Extremo'],
        ];

        return view('map.index', compact('character', 'areas'));
    }
}
