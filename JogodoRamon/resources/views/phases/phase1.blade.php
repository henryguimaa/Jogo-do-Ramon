@extends('layouts.app')

@section('title', 'Fase 1 - Jogo do Ramon')
@section('body-class', 'phase phase-1')

@section('content')
	<h1>Fase 1</h1>
	<p>Bem vindo à primeira fase.</p>
	<div class="stage">
		<!-- Conteúdo do jogo: inimigos, obstáculos, etc. -->
		<p>Conteúdo da fase 1</p>
	</div>
	<a class="btn" href="{{ route('phase.show', ['number' => 2]) }}">Ir para Fase 2</a>
	<a class="btn" href="{{ route('home') }}">Voltar ao Início</a>
@endsection
