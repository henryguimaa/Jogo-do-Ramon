@extends('layouts.app')

@section('content')
    <h2>Ficha — {{ $character->name }}</h2>

    <p>
        Raça: {{ $character->race }} |
        Classe: {{ $character->char_class }} |
        Sub: {{ $character->subclass }}
    </p>

    <p>
        HP: {{ $character->hp }}
        ATK: {{ $character->atk }}
        DEF: {{ $character->def }}
        SPD: {{ $character->spd }}
        Elemento: {{ $character->element }}
    </p>

    <hr>

    <h3>Ações do Personagem</h3>

    {{-- 🔥 BOTÃO PARA INICIAR O JOGO --}}
    <a href="{{ route('game.story', $character->id) }}" 
       class="btn btn-primary" 
       style="padding: 10px 20px; display: inline-block; margin-bottom: 20px;">
        Iniciar Jogo
    </a>

    <br>

    {{-- Teste de batalha (demo) --}}
    <h4>Testar batalha (demo)</h4>
    <form method="POST" action="{{ route('characters.battle', $character->id) }}">
        @csrf
        <button type="submit" class="btn btn-danger">Iniciar combate (turno único demo)</button>
    </form>
@endsection
