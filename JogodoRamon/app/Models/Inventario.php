<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';
    public $incrementing = false;
    protected $fillable = ['id_jogador', 'id_item', 'quantidade'];

    public function jogador()
    {
        return $this->belongsTo(Jogador::class, 'id_jogador');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }
}
