<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapa extends Model
{
    protected $table = 'mapa';
    protected $primaryKey = 'id_mapa';
    protected $fillable = ['nome', 'descricao', 'tipo'];

    // Relacionamentos
    public function jogadores()
    {
        return $this->hasMany(Jogador::class, 'local_atual');
    }

    public function npcs()
    {
        return $this->hasMany(Npc::class, 'id_mapa');
    }

    public function inimigos()
    {
        return $this->hasMany(Inimigo::class, 'id_mapa');
    }
}
