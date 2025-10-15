
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    protected $primaryKey = 'id_item';
    protected $fillable = ['nome', 'descricao', 'tipo', 'valor', 'efeito'];

    public function jogadores()
    {
        return $this->belongsToMany(Jogador::class, 'inventario', 'id_item', 'id_jogador')
                    ->withPivot('quantidade')
                    ->withTimestamps();
    }

    public function questsRecompensa()
    {
        return $this->hasMany(Quest::class, 'recompensa_item');
    }
}
