<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>@yield('title', 'Jogo do Ramon')</title>
	<!-- adiciona fonte pixel art (Press Start 2P) -->
	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/game.css') }}">
</head>
<body class="@yield('body-class','pixel')">
	<header class="site-header">
		<h1>JOGO DO RAMON</h1>
		<nav>
			<a href="{{ route('game.home') }}">Home</a> |
			<a href="{{ route('game.selection') }}">Seleção</a> |
			<a href="{{ route('game.customize') }}">Customizar</a> |
			<a href="{{ route('game.story') }}">História</a> |
			<a href="{{ route('characters.index') }}">Personagens</a>
		</nav>
	</header>
	<main class="site-main">
		{{-- mensagens flash --}}
		@if(session('error'))
			<div class="errors" style="margin-bottom:12px;">{{ session('error') }}</div>
		@endif
		@if(session('success'))
			<div class="notice" style="margin-bottom:12px;">{{ session('success') }}</div>
		@endif

		@yield('content')
	</main>
	<footer class="site-footer">
		<p>Jogo do Ramon — Demo</p>
	</footer>
</body>
</html>
