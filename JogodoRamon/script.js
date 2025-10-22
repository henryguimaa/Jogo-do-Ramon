function abrirHistoria() {
    document.getElementById('menu').style.display = 'none';
    document.getElementById('historia').style.display = 'flex';
  }
  
  function abrirCustomizacao() {
    document.getElementById('historia').style.display = 'none';
    document.getElementById('customizacao').style.display = 'flex';
  }
  
  function iniciarJogo() {
    // Aqui você pode salvar as escolhas do jogador e carregar a próxima parte do jogo
    const nome = document.getElementById('nomePersonagem').value;
    const boneco = document.getElementById('boneco').value;
    const raca = document.getElementById('raca').value;
    const classe = document.getElementById('classe').value;
  
    alert(`Bem-vindo(a) ${nome}!\nBoneco: ${boneco}\nRaça: ${raca}\nClasse: ${classe}\n\n(Continue o desenvolvimento do jogo aqui!)`);
    
    // Exemplo: esconder customização e mostrar próxima tela
  }
  function iniciarJogo() {
    // Salve as escolhas se quiser
    document.getElementById('customizacao').style.display = 'none';
    document.getElementById('mapa').style.display = 'flex';
    iniciarMapa();
  }
  
  function voltarMenu() {
    document.getElementById('mapa').style.display = 'none';
    document.getElementById('menu').style.display = 'flex';
  }
  
  // --- MAPA ---
  let player = { x: 150, y: 100, size: 16 };
  
  function iniciarMapa() {
    const canvas = document.getElementById('mapCanvas');
    const ctx = canvas.getContext('2d');
    
    desenharMapa(ctx);
  
    // Movimentação
    window.onkeydown = function(e) {
      let moved = false;
      if (e.key === "ArrowUp")    { player.y -= 8; moved = true; }
      if (e.key === "ArrowDown")  { player.y += 8; moved = true; }
      if (e.key === "ArrowLeft")  { player.x -= 8; moved = true; }
      if (e.key === "ArrowRight") { player.x += 8; moved = true; }
      if (moved) {
        desenharMapa(ctx);
      }
    };
  }
  
  function desenharMapa(ctx) {
    // Limpa
    ctx.clearRect(0,0,320,240);
  
    // Chão (grama)
    ctx.fillStyle = "#7ec850";
    ctx.fillRect(0,0,320,240);
  
    // Casas (exemplo)
    ctx.fillStyle = "#b5651d";
    ctx.fillRect(40,40,40,40); // Casa1
    ctx.fillRect(220,60,40,40); // Casa2
  
    // Caminho
    ctx.fillStyle = "#e0c068";
    ctx.fillRect(0,120,320,32);
  
    // Personagem (círculo por enquanto)
    ctx.fillStyle = "#222";
    ctx.beginPath();
    ctx.arc(player.x, player.y, player.size/2, 0, Math.PI*2);
    ctx.fill();
  
    // Você pode trocar por um sprite depois!
  }