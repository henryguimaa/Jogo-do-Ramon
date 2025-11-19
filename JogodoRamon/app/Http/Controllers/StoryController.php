<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index(Character $character)
    {
        // Exemplo de narrativa automática baseada nos atributos
        $storyText = $this->generateStory($character);

        return view('story.index', compact('character', 'storyText'));
    }

    private function generateStory(Character $character)
    {
        return "
            {$character->name}, um(a) {$character->race} da classe {$character->char_class},
            iniciava sua jornada carregando o poder do elemento {$character->element}.
            Após anos de treinamento, atingiu força {$character->atk} e velocidade {$character->spd}.
            Seu destino agora o leva para a próxima etapa da aventura...
        ";
    }
}
