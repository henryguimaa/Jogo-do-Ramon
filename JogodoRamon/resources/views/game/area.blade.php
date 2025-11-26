@extends('layouts.app')

@section('content')

<h2>{{ $areaName }} — {{ $character->name }}</h2>

<p>{{ $areaDescription }}</p>

<hr>

<h3>Ações Disponíveis</h3>

<ul>
    <li>
        <a href="#" class="btn">Explorar a área</a>
    </li>

    <li>
        <a href="#" class="btn">Procurar inimigos</a>
    </li>

    <li>
        <a href="#" class="btn">Descansar</a>
    </li>
</ul>

<br>

<a href="{{ route('game.map', $character->id) }}" class="btn">
    Voltar ao Mapa
</a>

@endsection
