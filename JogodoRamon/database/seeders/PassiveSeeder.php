<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Passive;

class PassiveSeeder extends Seeder
{
	public function run()
	{
		$items = [
			[
				'key' => 'cronos',
				'name' => 'Cronos',
				'description' => 'Menos attack, mais spd',
				'effect' => json_encode(['atk_multiplier' => 0.9, 'spd_bonus' => 10]),
			],
			[
				'key' => 'bloodrush',
				'name' => 'BloodRush',
				'description' => 'Se HP < 15%, adicional de dano por 2 turnos',
				'effect' => json_encode(['trigger_hp_pct' => 15, 'extra_damage_turns' => 2, 'extra_damage_pct' => 0.2]),
			],
			[
				'key' => 'flame_heart',
				'name' => 'Flame Heart',
				'description' => '20% de dano adicional para elemento fogo; se crítico com probabilidade de morrer, fica com 1 de vida',
				'effect' => json_encode(['fire_damage_pct' => 0.2, 'crit_survive_with_1hp' => true]),
			],
			[
				'key' => 'ancient',
				'name' => 'Ancient',
				'description' => 'Dano adicional em magia +30%, debuff -20% em vida e defesa (ataque físico)',
				'effect' => json_encode(['magic_atk_pct' => 0.3, 'hp_multiplier' => 0.8, 'def_multiplier' => 0.8]),
			],
			[
				'key' => 'sede_de_sangue',
				'name' => 'Sede de Sangue',
				'description' => 'Ativa quando <=25% HP: +10% de ATK por turno e perde 2.5% de vida a cada turno',
				'effect' => json_encode(['trigger_hp_pct' => 25, 'atk_pct_per_turn' => 0.10, 'hp_loss_pct_per_turn' => 2.5]),
			],
		];

		foreach ($items as $data) {
			Passive::updateOrCreate(['key' => $data['key']], $data);
		}
	}
}
