<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title ?? 'Dounia' }}</title>

    <!-- fonte pixel art -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/game.css') }}">
</head>

<body class="@yield('body-class','pixel')">

    <header class="site-header">

        {{-- TÍTULO DO TOPO (PADRÃO = Dounia) --}}
        <h1>{{ $title ?? 'Dounia' }}</h1>

        {{-- MENU SÓ APARECE SE $hideMenu NÃO FOR TRUE --}}
        @unless(isset($hideMenu) && $hideMenu === true)
        <nav>
            <a href="{{ route('game.home') }}">Home</a> |
            <a href="{{ route('game.selection') }}">Seleção</a> |
            <a href="{{ route('game.customize') }}">Customizar</a> |
            @if(isset($character))
                <a href="{{ route('game.story', $character->id) }}">História</a> |
            @endif
            <a href="{{ route('characters.index') }}">Personagens</a>
        </nav>
        @endunless

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

	@if(!isset($hideMenu))
    <footer class="site-footer">
        <p>Dounia — Demo</p>
    </footer>
	@endif

</body>
</html>