@extends('layouts.app')

@section('content')
	<h2>Ficha — {{ $character->name }}</h2>
	<p>Raça: {{ $character->race }} | Classe: {{ $character->char_class }} | Sub: {{ $character->subclass }}</p>
	<p>HP: {{ $character->hp }} ATK: {{ $character->atk }} DEF: {{ $character->def }} SPD: {{ $character->spd }} Elemento: {{ $character->element }}</p>
	<p>Passiva atual: {{ optional($character->passive)->name ?? 'Nenhuma' }}</p>

	<h3>Atribuir passiva</h3>
	<form method="POST" action="{{ route('characters.assignPassive', $character->id) }}">
		@csrf
		<select name="passive_id">
			<option value="">-- Nenhuma --</option>
			@foreach(\App\Models\Passive::all() as $p)
				<option value="{{ $p->id }}" @if($character->passive_id == $p->id) selected @endif>{{ $p->name }}</option>
			@endforeach
		</select>
		<button type="submit">Atribuir</button>
	</form>

	<h3>Testar batalha (demo)</h3>
	<form method="POST" action="{{ route('characters.battle', $character->id) }}">
		@csrf
		<button type="submit">Iniciar combate (turno único demo)</button>
	</form>
@endsection
