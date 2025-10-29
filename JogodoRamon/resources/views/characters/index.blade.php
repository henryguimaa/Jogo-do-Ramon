@extends('layouts.app')

@section('content')
	<h2>Personagens</h2>
	<a class="btn" href="{{ route('characters.create') }}">Criar novo</a>

	<ul>
	@foreach($characters as $char)
		<li>
			<strong>{{ $char->name }}</strong> — {{ $char->race }} {{ $char->char_class }}
			<a href="{{ route('characters.show', $char->id) }}">Ver</a>
		</li>
	@endforeach
	</ul>
@endsection
