<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batalha extends Model
{
    protected $table = 'batalha';
    protected $primaryKey = 'id_batalha';
    protected $fillable = ['id_jogador', 'id_inimigo', 'resultado', 'data'];

    public function jogador()
    {
        return $this->belongsTo(Jogador::class, 'id_jogador');
    }

    public function inimigo()
    {
        return $this->belongsTo(Inimigo::class, 'id_inimigo');
    }
}
