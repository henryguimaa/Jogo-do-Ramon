<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogador extends Model
{
    protected $table = 'jogador';
    protected $primaryKey = 'id_jogador';
    protected $fillable = [
        'nome', 'genero', 'nivel', 'experiencia', 'vida_atual', 'vida_maxima',
        'ataque', 'defesa', 'velocidade', 'local_atual'
    ];

    public function mapa()
    {
        return $this->belongsTo(Mapa::class, 'local_atual');
    }

    public function inventario()
    {
        return $this->hasMany(Inventario::class, 'id_jogador');
    }

    public function quests()
    {
        return $this->belongsToMany(Quest::class, 'jogador_quest', 'id_jogador', 'id_quest')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function batalhas()
    {
        return $this->hasMany(Batalha::class, 'id_jogador');
    }
}
