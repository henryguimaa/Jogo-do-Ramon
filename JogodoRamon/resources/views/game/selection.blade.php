@extends('layouts.app')

@section('content')
	<h2>Seleção de Boneco</h2>

	@if($characters->isEmpty())
		<p>Nenhum personagem criado ainda. <a href="{{ route('characters.create') }}">Criar personagem</a></p>
	@else
		<ul class="char-list">
			@foreach($characters as $c)
				<li>
					<strong>{{ $c->name }}</strong> — {{ $c->race }} {{ $c->char_class }}
					<br>
					<a href="{{ route('characters.show',$c->id) }}">Ver</a>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
