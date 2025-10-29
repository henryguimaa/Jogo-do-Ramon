<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mapa - JOGO DO RAMON</title>
	<link rel="stylesheet" href="/css/game.css">
</head>
<body>
	<header class="game-header">
		<h1>Mapa - Vilarejo de Lúmen</h1>
		<nav><a href="{{ route('home') }}" class="btn">Voltar</a></nav>
	</header>

	<main class="container">
		<div class="map">
			<!-- mapa estático por enquanto -->
			<div class="map-tile">Vilarejo</div>
			<div class="map-tile">Floresta de Zarviel</div>
			<div class="map-tile">Cume Gravemir</div>
			<div class="map-tile">Montanha de Draemora</div>
			<div class="map-tile">Reino de Volkaris (santuário)</div>
		</div>
		<p class="hint">Clique em uma área para explorar (funcionalidade futura).</p>
	</main>
</body>
</html>
