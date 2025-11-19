@extends('layouts.app')

@section('title', 'História — Introdução')

@section('content')
    <h2>História — Introdução</h2>

    <p>
        Bem-vindo à história do jogo do Ramon!
        Antes de começar, escolha um personagem.
    </p>

    <a href="{{ route('game.selection') }}" class="btn">
        Escolher Personagem
    </a>
@endsection
