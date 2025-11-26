@extends('layouts.app')

@section('body-class', 'story-bg')

@php
    $hideMenu = true;
    $title = "Dounia";
@endphp

@section('content')

<div class="cinematica-container">

    <div class="cinematica-overlay"></div>

    <div class="cinematica-text-box" id="cinematicaBox">

        <p class="cena" data-line="{{ $character->name }} desperta em uma pequena vila cercada por florestas densas."></p>

        <p class="cena" data-line="Rumores dizem que forças antigas despertaram… e algo maligno se aproxima."></p>

        <p class="cena" data-line="Sombras ganham forma, criaturas se erguem na calada da noite."></p>

        <p class="cena" data-line="O reino inteiro clama por um herói… e tudo aponta para você, {{ $character->name }}."></p>

        <p class="cena" data-line="Raça: {{ $character->race }} — Classe: {{ $character->char_class }} — Elemento: {{ $character->element }}"></p>

        <p class="cena" data-line="Sua jornada em Dounia está prestes a começar."></p>

    </div>

    <a href="{{ route('game.map', $character->id) }}" class="map-button">
        Ir para o Mapa →
    </a>
    

</div>

<script src="{{ asset('js/cinematica.js') }}"></script>

@endsection