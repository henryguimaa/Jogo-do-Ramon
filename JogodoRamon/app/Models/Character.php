<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $table = 'characters';

    protected $fillable = [
        'name',
        'race',
        'char_class',
        'subclass',
        'passive_id',
        'hp',
        'atk',
        'def',
        'spd',
        'element',
    ];

    public function passive()
    {
        return $this->belongsTo(Passive::class, 'passive_id');
    }
}
