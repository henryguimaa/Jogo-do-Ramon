<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Npc extends Model
{
    protected $table = 'npc';
    protected $primaryKey = 'id_npc';
    protected $fillable = ['nome', 'fala_inicial', 'tipo', 'id_mapa'];

    public function mapa()
    {
        return $this->belongsTo(Mapa::class, 'id_mapa');
    }
}
