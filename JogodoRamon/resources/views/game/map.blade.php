@extends('layouts.app')

@section('content')
    <h2>Mapa do Mundo — {{ $character->name }}</h2>

    <p>Selecione uma área para explorar.</p>

    <ul>
        <li>
            <strong>Floresta Nebulosa</strong> — perigo baixo  
            <br>
            <button>Entrar</button>
        </li>

        <li>
            <strong>Caverna Ecoante</strong> — perigo médio  
            <br>
            <button>Entrar</button>
        </li>

        <li>
            <strong>Ruínas Antigas</strong> — perigo alto  
            <br>
            <button>Entrar</button>
        </li>
    </ul>

    <br>

    <a href="{{ route('characters.show', $character->id) }}">Voltar para a Ficha</a>
@endsection
