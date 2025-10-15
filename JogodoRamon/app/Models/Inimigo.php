<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inimigo extends Model
{
    protected $table = 'inimigo';
    protected $primaryKey = 'id_inimigo';
    protected $fillable = ['nome', 'vida', 'ataque', 'defesa', 'velocidade', 'experiencia_drop', 'id_mapa'];

    public function mapa()
    {
        return $this->belongsTo(Mapa::class, 'id_mapa');
    }

    public function batalhas()
    {
        return $this->hasMany(Batalha::class, 'id_inimigo');
    }
}
