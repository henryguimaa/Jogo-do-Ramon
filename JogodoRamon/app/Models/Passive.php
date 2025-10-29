<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passive extends Model
{
	protected $table = 'passives';
	protected $fillable = ['key','name','description','effect'];
}
