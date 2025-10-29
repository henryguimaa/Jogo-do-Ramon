@extends('layouts.app')

@section('title', 'Início - Jogo do Ramon')
@section('body-class', 'home')

@section('content')
	<h1>Jogo do Ramon</h1>
	<p>Escolha uma fase para iniciar:</p>
	<div class="buttons">
		<a class="btn" href="{{ route('phase.show', ['number' => 1]) }}">Fase 1</a>
		<a class="btn" href="{{ route('phase.show', ['number' => 2]) }}">Fase 2</a>
		<a class="btn" href="{{ route('phase.show', ['number' => 3]) }}">Fase 3</a>
		<a class="btn" href="{{ route('phase.show', ['number' => 4]) }}">Fase 4</a>
		<a class="btn" href="{{ route('phase.show', ['number' => 5]) }}">Fase 5</a>
	</div>

	<hr>
	<a class="btn" href="{{ route('characters.index') }}">Ver Personagens</a>
	<a class="btn" href="{{ route('characters.create') }}">Criar Personagem</a>
@endsection
