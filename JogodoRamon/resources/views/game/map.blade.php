@extends('layouts.app')

@section('content')
    <h2>Mapa do Mundo — {{ $character->name }}</h2>

    <p>Selecione uma área para explorar.</p>

    <ul>
        <li>
            <strong>Floresta Nebulosa</strong> — perigo baixo  
            <br>
            <a href="{{ route('game.area', ['id' => $character->id, 'area' => 'floresta']) }}" class="btn">
                Entrar
            </a>
        </li>

        <li>
            <strong>Caverna Ecoante</strong> — perigo médio  
            <br>
            <a href="{{ route('game.area', ['id' => $character->id, 'area' => 'caverna']) }}" class="btn">
                Entrar
            </a>
        </li>

        <li>
            <strong>Ruínas Antigas</strong> — perigo alto  
            <br>
            <a href="{{ route('game.area', ['id' => $character->id, 'area' => 'ruinas']) }}" class="btn">
                Entrar
            </a>
        </li>
    </ul>

    <br>

    {{-- Voltar para a história --}}
    <a href="{{ route('game.story', $character->id) }}">Voltar</a>
@endsection
