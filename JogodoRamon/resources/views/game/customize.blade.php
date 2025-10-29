@extends('layouts.app')

@section('content')
	<h2>Customização</h2>
	<p>Escolha uma passiva para testar em um personagem (atribua depois na ficha).</p>
	<ul>
		@foreach($passives as $p)
			<li><strong>{{ $p->name }}</strong> — {{ $p->description }}</li>
		@endforeach
	</ul>
	<p>Para atribuir, abra a ficha do personagem e use o formulário de atribuição.</p>
@endsection
