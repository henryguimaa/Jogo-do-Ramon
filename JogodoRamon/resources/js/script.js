// Continuação do JavaScript completo...

function checkCharacterCreationReady() {
  const createBtn = document.getElementById('create-character-btn');
  const isReady = gameData.playerName && 
                 gameData.selectedRace && 
                 gameData.selectedClass && 
                 gameData.selectedSubclass && 
                 gameData.selectedPassive;
  
  if (isReady) {
      createBtn.classList.remove('hidden');
  } else {
      createBtn.classList.add('hidden');
  }
}

function createCharacter() {
  const baseStats = {
      hp: 100,
      maxHp: 100,
      attack: 20,
      defense: 15,
      speed: 10,
      mana: 50,
      maxMana: 50
  };

  // Aplica bônus da raça
  Object.keys(gameData.selectedRace.bonus).forEach(stat => {
      baseStats[stat] += gameData.selectedRace.bonus[stat];
      if (stat === 'hp') baseStats.maxHp += gameData.selectedRace.bonus[stat];
      if (stat === 'mana') baseStats.maxMana += gameData.selectedRace.bonus[stat];
  });

  // Aplica bônus da classe
  Object.keys(gameData.selectedClass.stats).forEach(stat => {
      baseStats[stat] += gameData.selectedClass.stats[stat];
      if (stat === 'hp') baseStats.maxHp += gameData.selectedClass.stats[stat];
      if (stat === 'mana') baseStats.maxMana += gameData.selectedClass.stats[stat];
  });

  // Aplica bônus da passiva
  if (gameData.selectedPassive.effect) {
      Object.keys(gameData.selectedPassive.effect).forEach(stat => {
          if (['attack', 'defense', 'speed', 'hp'].includes(stat)) {
              baseStats[stat] += gameData.selectedPassive.effect[stat];
              if (stat === 'hp') baseStats.maxHp += gameData.selectedPassive.effect[stat];
          }
      });
  }

  // Atualiza dados do jogador
  gameData.playerData = {
      ...gameData.playerData,
      name: gameData.playerName,
      race: gameData.selectedRace.name,
      class: gameData.selectedClass.name,
      subclass: gameData.selectedSubclass,
      passive: gameData.selectedPassive,
      classId: gameData.selectedClass.id,
      ...baseStats
  };

  // Atualiza sprite do jogador
  updatePlayerSprite();
  
  // Inicia o jogo
  gameData.gameState = 'gameplay';
  showScreen('gameplay-screen');
  updateHUD();
  startGameplay();
}

// Sistema de Sprites
function updatePlayerSprite() {
  const playerSprite = document.getElementById('player-sprite');
  const battleSprite = document.getElementById('player-sprite-battle');
  
  // Remove classes antigas
  playerSprite.className = 'player-sprite';
  battleSprite.className = 'player-battle-sprite';
  
  // Adiciona classe baseada na classe do personagem
  if (gameData.playerData.classId) {
      playerSprite.classList.add(`${gameData.playerData.classId}-sprite`);
      battleSprite.classList.add(`battle-${gameData.playerData.classId}`);
  }
}

function createEnemySprite(enemyType) {
  const enemySprite = document.createElement('div');
  enemySprite.className = `enemy-battle-sprite`;
  return enemySprite;
}

function updateNPCSprite() {
  const npcSprite = document.getElementById('npc-sprite');
  if (gameData.storyProgress === 1) {
      npcSprite.className = 'npc-sprite npc-quest';
      npcSprite.style.display = 'block';
  } else {
      npcSprite.style.display = 'none';
  }
}

function createEffectSprite(effectType) {
  const effect = document.createElement('div');
  effect.className = `effect-${effectType}`;
  effect.style.position = 'absolute';
  effect.style.top = '50%';
  effect.style.left = '50%';
  effect.style.transform = 'translate(-50%, -50%)';
  effect.style.zIndex = '1000';
  return effect;
}

// Sistema de Diálogo
function nextIntroDialogue() {
  const introDialogue = document.getElementById('intro-dialogue');
  
  if (introDialogue.querySelector('.text').textContent.includes('Em um mundo com poderes')) {
      introDialogue.querySelector('.text').textContent = 'Você, meu caro cavaleiro, vai ter uma missão muito importante. Dounia precisa de sua ajuda.';
  } else {
      showScreen('character-creation');
  }
}

function startGameplay() {
  showDialogue('Narrador', 'Muito bom, meu cavaleiro. Agora você está pronto para ir e se tornar um grande herói para o povo de Dounia. Agora vá!!!', () => {
      showDialogue('Narrador', 'Você chega como um viajante no belo Vilarejo de Lúmen, uma cidade rodeada de mana de luz...', () => {
          showDialogue('Estranho Misterioso', 'Cuidado, jovem. Essa vila pode ser muito agradável, mas esconde algo que poucos sabem. Você sente essa mana forte?', () => {
              showChoices([
                  {
                      text: 'Sim, sinto essa mana muito forte',
                      action: meetHalren
                  },
                  {
                      text: 'Não, acho que você está ficando louco',
                      action: rejectHalren
                  }
              ]);
          });
      });
  });
}

function showDialogue(speaker, text, nextCallback = null) {
  gameData.dialogue = { speaker, text, next: nextCallback };
  
  const overlay = document.getElementById('dialogue-overlay');
  const speakerElem = document.getElementById('dialogue-speaker');
  const textElem = document.getElementById('dialogue-text');
  const continueBtn = document.getElementById('dialogue-continue');
  
  speakerElem.textContent = speaker;
  textElem.textContent = text;
  
  if (nextCallback) {
      continueBtn.style.display = 'block';
      continueBtn.onclick = handleDialogueContinue;
  } else {
      continueBtn.style.display = 'none';
  }
  
  overlay.classList.remove('hidden');
}

function handleDialogueContinue() {
  if (gameData.dialogue && gameData.dialogue.next) {
      gameData.dialogue.next();
  } else {
      document.getElementById('dialogue-overlay').classList.add('hidden');
      gameData.dialogue = null;
  }
}

function showChoices(choices) {
  gameData.choices = choices;
  
  const overlay = document.getElementById('choices-overlay');
  const container = document.getElementById('choices-container');
  
  container.innerHTML = '';
  choices.forEach(choice => {
      const button = document.createElement('button');
      button.className = 'choice-btn';
      button.textContent = choice.text;
      button.addEventListener('click', choice.action);
      container.appendChild(button);
  });
  
  overlay.classList.remove('hidden');
}

function meetHalren() {
  hideChoices();
  gameData.storyProgress = 1;
  showDialogue('Halren', `Prazer ${gameData.playerData.name}, me chamo Halren. Venha, vou te mostrar onde pode treinar.`, exploreVillage);
}

function rejectHalren() {
  hideChoices();
  showDialogue('Estranho', 'Tenha cuidado então...', exploreVillage);
}

function hideChoices() {
  document.getElementById('choices-overlay').classList.add('hidden');
  gameData.choices = [];
}

function exploreVillage() {
  showDialogue('Narrador', 'Use as setas do teclado para se mover. Aproxime-se do centro da vila (❗) e pressione ENTER.', () => {
      document.getElementById('dialogue-overlay').classList.add('hidden');
      updateNPCSprite();
      setupMovement();
  });
}

// Sistema de Movimento
function setupMovement() {
  document.addEventListener('keydown', handleKeyPress);
}

function handleKeyPress(e) {
  if (gameData.gameState !== 'gameplay') return;
  
  const speed = 5;
  const playerSprite = document.getElementById('player-sprite');
  const newPos = { ...gameData.playerData.position };

  switch(e.key) {
      case 'ArrowUp':
          newPos.y = newPos.y - speed;
          break;
      case 'ArrowDown':
          newPos.y = newPos.y + speed;
          break;
      case 'ArrowLeft':
          newPos.x = newPos.x - speed;
          break;
      case 'ArrowRight':
          newPos.x = newPos.x + speed;
          break;
      case 'Enter':
          if (gameData.storyProgress === 1 && 
              newPos.x > 350 && newPos.x < 450 && 
              newPos.y > 200 && newPos.y < 300) {
              gameData.storyProgress = 2;
              triggerFirstBoss();
          }
          return;
      default:
          return;
  }

  if (!checkCollision(newPos.x, newPos.y, 40, 50)) {
      gameData.playerData.position = newPos;
      playerSprite.style.left = `${newPos.x}px`;
      playerSprite.style.top = `${newPos.y}px`;
  }
}

function checkCollision(x, y, width, height) {
  for (let obstacle of obstacles) {
      if (
          x < obstacle.x + obstacle.width &&
          x + width > obstacle.x &&
          y < obstacle.y + obstacle.height &&
          y + height > obstacle.y
      ) {
          return true;
      }
  }
  return false;
}

function triggerFirstBoss() {
  showDialogue('Narrador', 'Uma pessoa está no chão com marcas vermelhas! Ela ataca todos! Sua primeira batalha!', startBattle);
}

// Sistema de Batalha
function startBattle() {
  gameData.gameState = 'battle';
  gameData.currentEnemy = {
      name: 'Morador Corrompido',
      hp: 150,
      maxHp: 150,
      attack: 25,
      defense: 18,
      speed: 12,
      type: 'corrupted'
  };
  gameData.battleLog = ['A batalha começou!'];
  gameData.turnCount = 0;
  gameData.battleMenu = 'main';
  
  showScreen('battle-screen');
  
  // Atualizar sprites
  updatePlayerSprite();
  
  const enemyArea = document.querySelector('.enemy-area');
  const oldEnemySprite = document.querySelector('.enemy-battle-sprite');
  if (oldEnemySprite) oldEnemySprite.remove();
  
  const enemySprite = createEnemySprite(gameData.currentEnemy.type);
  enemyArea.appendChild(enemySprite);
  
  updateBattleUI();
  showMainMenu();
}

function updateBattleUI() {
  // Atualiza informações do jogador
  document.getElementById('battle-player-name').textContent = gameData.playerData.name;
  document.getElementById('level-badge').textContent = `Nv${gameData.playerData.level}`;
  updatePlayerHealthBar();
  updatePlayerManaBar();
  
  // Atualiza informações do inimigo
  document.getElementById('enemy-name').textContent = gameData.currentEnemy.name;
  updateEnemyHealthBar();
  
  // Atualiza log de batalha
  const battleLog = document.getElementById('battle-log');
  battleLog.innerHTML = gameData.battleLog.slice(-3).map(log => 
      `<div class="battle-log-text">${log}</div>`
  ).join('');
}

function updatePlayerHealthBar() {
  const hpPercent = (gameData.playerData.hp / gameData.playerData.maxHp) * 100;
  const hpBar = document.getElementById('player-hp-bar');
  const hpNumbers = document.getElementById('player-hp-numbers');
  
  hpBar.style.width = `${hpPercent}%`;
  hpBar.style.background = hpPercent > 50 ? '#10b981' : 
                          hpPercent > 20 ? '#f59e0b' : '#ef4444';
  hpNumbers.textContent = `${gameData.playerData.hp}/${gameData.playerData.maxHp}`;
}

function updatePlayerManaBar() {
  const manaPercent = (gameData.playerData.mana / gameData.playerData.maxMana) * 100;
  const manaBar = document.getElementById('player-mana-bar');
  const manaNumbers = document.getElementById('player-mana-numbers');
  
  manaBar.style.width = `${manaPercent}%`;
  manaNumbers.textContent = `${gameData.playerData.mana}/${gameData.playerData.maxMana}`;
}

function updateEnemyHealthBar() {
  const hpPercent = (gameData.currentEnemy.hp / gameData.currentEnemy.maxHp) * 100;
  const hpBar = document.getElementById('enemy-hp-bar');
  
  hpBar.style.width = `${hpPercent}%`;
  hpBar.style.background = hpPercent > 50 ? '#10b981' : 
                          hpPercent > 20 ? '#f59e0b' : '#ef4444';
}

function showMainMenu() {
  document.getElementById('battle-main-menu').classList.remove('hidden');
  document.getElementById('battle-skills-menu').classList.add('hidden');
  gameData.battleMenu = 'main';
}

function showSkillsMenu() {
  document.getElementById('battle-main-menu').classList.add('hidden');
  document.getElementById('battle-skills-menu').classList.remove('hidden');
  gameData.battleMenu = 'skills';
  
  const skillsContainer = document.getElementById('skills-container');
  skillsContainer.innerHTML = '';
  
  const skills = classSkills[gameData.playerData.classId] || [];
  skills.forEach((skill, index) => {
      const skillBtn = document.createElement('button');
      skillBtn.className = 'skill-btn';
      skillBtn.innerHTML = `
          <div class="skill-name">${skill.name}</div>
          <div class="skill-info">
              <span>Dano: ${skill.damage}</span>
              <span class="mana-cost">MP: ${skill.manaCost}</span>
          </div>
      `;
      skillBtn.addEventListener('click', () => useSkill(skill));
      skillsContainer.appendChild(skillBtn);
  });
}

function playerAttack() {
  if (!gameData.currentEnemy) return;
  
  animatePlayerAttack();
  showBattleEffect('lightning', false);
  
  setTimeout(() => {
      let attackBonus = 0;
      
      if (gameData.playerData.passive?.id === 'bloodrush' && 
          (gameData.playerData.hp / gameData.playerData.maxHp) < 0.15) {
          attackBonus += 20;
      }
      
      if (gameData.playerData.passive?.id === 'sedesangue' && 
          (gameData.playerData.hp / gameData.playerData.maxHp) < 0.25) {
          attackBonus += Math.floor(gameData.turnCount * 0.1 * gameData.playerData.attack);
      }

      const damage = Math.max(1, gameData.playerData.attack + attackBonus - 
          gameData.currentEnemy.defense + Math.floor(Math.random() * 10) - 5);
      const isCritical = Math.random() < 0.15;
      const finalDamage = isCritical ? damage * 2 : damage;

      gameData.currentEnemy.hp = Math.max(0, gameData.currentEnemy.hp - finalDamage);
      
      animateEnemyHurt();
      showDamageNumber(finalDamage, isCritical, false);
      
      gameData.battleLog.push(
          `${gameData.playerData.name} atacou! ${isCritical ? '⚡CRÍTICO! ' : ''}${finalDamage} de dano!`
      );
      
      gameData.turnCount++;
      updateBattleUI();

      setTimeout(() => {
          resetAnimations();
          
          if (gameData.currentEnemy.hp <= 0) {
              setTimeout(winBattle, 500);
              return;
          }

          setTimeout(enemyAttack, 800);
      }, 600);
  }, 400);
}

function useSkill(skill) {
  if (!gameData.currentEnemy || gameData.playerData.mana < skill.manaCost) return;

  animatePlayerAttack();
  showMainMenu();

  // Determinar efeito baseado na habilidade
  let effectType = 'lightning';
  if (skill.name.includes('Fogo')) effectType = 'fire';
  if (skill.name.includes('Gelo') || skill.name.includes('Congelante')) effectType = 'ice';
  if (skill.name.includes('Cura') || skill.name.includes('Luz')) effectType = 'heal';
  
  showBattleEffect(effectType, false);

  // Reduz mana
  gameData.playerData.mana -= skill.manaCost;
  updatePlayerManaBar();
  
  setTimeout(() => {
      let damage = skill.damage;
      
      // Bônus de passivas
      if (gameData.playerData.passive?.id === 'ancient' && skill.manaCost > 15) {
          damage = Math.floor(damage * 1.3);
      }
      
      if (gameData.playerData.passive?.id === 'flameheart' && skill.name.includes('Fogo')) {
          damage = Math.floor(damage * 1.2);
      }

      const isCritical = Math.random() < 0.2;
      const finalDamage = isCritical ? damage * 2 : damage;

      gameData.currentEnemy.hp = Math.max(0, gameData.currentEnemy.hp - finalDamage);
      
      animateEnemyHurt();
      showDamageNumber(finalDamage, isCritical, false);
      
      gameData.battleLog.push(
          `${gameData.playerData.name} usou ${skill.name}! ${isCritical ? '⚡CRÍTICO! ' : ''}${finalDamage} de dano!`
      );

      gameData.turnCount++;
      updateBattleUI();

      setTimeout(() => {
          resetAnimations();
          
          if (gameData.currentEnemy.hp <= 0) {
              setTimeout(winBattle, 500);
              return;
          }

          setTimeout(enemyAttack, 800);
      }, 600);
  }, 400);
}

function enemyAttack() {
  if (!gameData.currentEnemy || gameData.currentEnemy.hp <= 0) return;

  animateEnemyAttack();
  showBattleEffect('fire', true);

  setTimeout(() => {
      const damage = Math.max(1, gameData.currentEnemy.attack - 
          gameData.playerData.defense + Math.floor(Math.random() * 8) - 4);
      let newPlayerHp = Math.max(0, gameData.playerData.hp - damage);

      if (newPlayerHp === 0 && gameData.playerData.passive?.id === 'flameheart' && 
          gameData.playerData.passive.effect.surviveOnce) {
          newPlayerHp = 1;
          gameData.battleLog.push('🔥 Flame Heart ativado! Sobreviveu com 1 HP!');
          gameData.playerData.passive.effect.surviveOnce = false;
      }

      gameData.playerData.hp = newPlayerHp;
      animatePlayerHurt();
      showDamageNumber(damage, false, true);

      gameData.battleLog.push(
          `${gameData.currentEnemy.name} atacou! ${damage} de dano!`
      );

      updatePlayerHealthBar();
      updateBattleUI();

      setTimeout(() => {
          resetAnimations();
          
          if (newPlayerHp <= 0) {
              setTimeout(loseBattle, 500);
          }
      }, 600);
  }, 400);
}

// Animações de Batalha
function animatePlayerAttack() {
  const playerSprite = document.getElementById('player-sprite-battle');
  playerSprite.style.animation = 'playerAttackAnim 0.6s ease-out';
}

function animateEnemyAttack() {
  const enemySprite = document.querySelector('.enemy-battle-sprite');
  enemySprite.style.animation = 'enemyAttackAnim 0.6s ease-out';
}

function animatePlayerHurt() {
  const playerSprite = document.getElementById('player-sprite-battle');
  playerSprite.style.animation = 'hurtAnim 0.6s ease-out';
}

function animateEnemyHurt() {
  const enemySprite = document.querySelector('.enemy-battle-sprite');
  enemySprite.style.animation = 'hurtAnim 0.6s ease-out';
}

function resetAnimations() {
  const playerSprite = document.getElementById('player-sprite-battle');
  const enemySprite = document.querySelector('.enemy-battle-sprite');
  
  playerSprite.style.animation = '';
  enemySprite.style.animation = '';
}

function showBattleEffect(effectType, isPlayerTarget = false) {
  const targetArea = isPlayerTarget ? '.player-area' : '.enemy-area';
  const container = document.querySelector(targetArea);
  
  const effect = createEffectSprite(effectType);
  container.appendChild(effect);
  
  setTimeout(() => {
      effect.remove();
  }, 1000);
}

function showDamageNumber(damage, isCritical, isPlayer) {
  const containerId = isPlayer ? 'player-damage-numbers' : 'enemy-damage-numbers';
  const container = document.getElementById(containerId);
  
  const damageElem = document.createElement('div');
  damageElem.className = isCritical ? 'damage-number critical-damage' : 'damage-number';
  damageElem.textContent = `-${damage}`;
  if (isCritical) {
      damageElem.textContent = '⚡' + damageElem.textContent;
  }
  
  container.appendChild(damageElem);
  
  setTimeout(() => {
      damageElem.remove();
  }, 1000);
}

function winBattle() {
  gameData.battleLog.push('🏆 VITÓRIA!');
  updateBattleUI();
  
  setTimeout(() => {
      gameData.gameState = 'gameplay';
      gameData.currentEnemy = null;
      gameData.battleLog = [];
      gameData.turnCount = 0;
      
      // Recupera vida e mana, adiciona experiência
      gameData.playerData.hp = gameData.playerData.maxHp;
      gameData.playerData.mana = gameData.playerData.maxMana;
      gameData.playerData.exp += 100;
      
      if (gameData.playerData.exp >= 100) {
          gameData.playerData.level += 1;
          gameData.playerData.exp = 0;
      }
      
      updateHUD();
      showScreen('gameplay-screen');
      
      showDialogue('Narrador', 'Vitória! O povo te agradece. Você ganhou 100 XP e recuperou toda sua vida e mana!');
  }, 2000);
}

function loseBattle() {
  gameData.battleLog.push('💀 Derrotado... Tente novamente!');
  updateBattleUI();
  
  setTimeout(() => {
      // Recupera vida e mana para tentar novamente
      gameData.playerData.hp = gameData.playerData.maxHp;
      gameData.playerData.mana = gameData.playerData.maxMana;
      startBattle();
  }, 2000);
}

// Atualização do HUD
function updateHUD() {
  document.getElementById('hud-title').textContent = 
      `${gameData.playerData.name} - Lvl ${gameData.playerData.level}`;
  
  document.getElementById('hp-text').textContent = 
      `${gameData.playerData.hp}/${gameData.playerData.maxHp}`;
  
  document.getElementById('mana-text').textContent = 
      `${gameData.playerData.mana}/${gameData.playerData.maxMana}`;
  
  document.getElementById('exp-text').textContent = 
      `EXP: ${gameData.playerData.exp}`;
  
  // Atualiza barras
  const hpFill = document.getElementById('hp-fill');
  const manaFill = document.getElementById('mana-fill');
  
  hpFill.style.width = `${(gameData.playerData.hp / gameData.playerData.maxHp) * 100}%`;
  manaFill.style.width = `${(gameData.playerData.mana / gameData.playerData.maxMana) * 100}%`;
}

// Inicializar sprites quando o jogo começar
function initializeGame() {
  showScreen('intro-screen');
  populateRaces();
  populateClasses();
  populatePassives();
  updatePlayerSprite();
  updateNPCSprite();
}
