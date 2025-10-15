<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $table = 'quest';
    protected $primaryKey = 'id_quest';
    protected $fillable = ['nome', 'descricao', 'recompensa_xp', 'recompensa_item'];

    public function itemRecompensa()
    {
        return $this->belongsTo(Item::class, 'recompensa_item');
    }

    public function jogadores()
    {
        return $this->belongsToMany(Jogador::class, 'jogador_quest', 'id_quest', 'id_jogador')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
