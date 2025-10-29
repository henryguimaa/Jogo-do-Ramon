@extends('layouts.app')

@section('content')
	<h2>Bem-vindo a Dounia</h2>
	<p>Um RPG inspirado por suas ideias. Comece selecionando um boneco ou criando um novo personagem.</p>
	<a class="btn" href="{{ route('game.selection') }}">Começar</a>
@endsection
