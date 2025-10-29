<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dounnia RPG</title>
  <link rel="stylesheet" src="style.css">
</head>
<body>
  <div id="game-container" class="game-container">
    <!-- Tela de Introdução -->
    <div id="intro-screen" class="intro-screen">
      <div class="intro-content">
        <h1 class="game-title">DOUNIA</h1>
        <p class="game-subtitle">Uma Jornada Épica</p>
        <div id="dialogue-box" class="dialogue-box hidden">
          <div id="dialogue-speaker" class="speaker"></div>
          <div id="dialogue-text" class="text"></div>
          <button id="continue-btn" class="continue-btn">Continuar →</button>
        </div>
      </div>
    </div>

    <!-- Tela de Criação de Personagem -->
    <div id="character-creation" class="character-creation hidden">
      <h2 class="creation-title">Crie Seu Cavaleiro</h2>
      <div class="creation-form">
        <div class="form-section">
          <label class="label">Nome do Cavaleiro:</label>
          <input type="text" id="player-name" class="name-input" placeholder="Digite seu nome">
        </div>
        <div class="form-section">
          <label class="label">Escolha sua Raça:</label>
          <div id="races-grid" class="options-grid"></div>
        </div>
        <div class="form-section">
          <label class="label">Escolha sua Classe:</label>
          <div id="classes-grid" class="options-grid"></div>
        </div>
        <div class="form-section">
          <label class="label">Escolha sua Passiva:</label>
          <div id="passives-grid" class="options-grid"></div>
        </div>
        <div id="classes-grid" class="options-grid">
    <button class="option-card">
        <div class="option-name">Guerreiro</div>
    </button>
    <button class="option-card">
        <div class="option-name">Mago</div>
    </button>
    <button class="option-card">
        <div class="option-name">Arqueiro</div>
    </button>
</div>
<div id="passives-grid" class="options-grid">
    <button class="option-card">
        <div class="option-name">Regeneração</div>
    </button>
    <button class="option-card">
        <div class="option-name">Velocidade</div>
    </button>
    <button class="option-card">
        <div class="option-name">Força Bruta</div>
    </button>
</div>
        <button id="create-character-btn" class="create-character-btn hidden">Começar Aventura!</button>
      </div>
    </div>

    <!-- Tela de Gameplay -->
    <div id="gameplay-screen" class="gameplay-screen hidden">
      <div class="game-world">
        <div class="map-area">
          <div id="player-sprite" class="player-sprite"></div>
        </div>
      </div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>