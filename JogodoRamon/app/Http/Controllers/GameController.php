<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Passive;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Artisan;

class GameController extends Controller
{
	public function home()
	{
		return view('game.home');
	}

	public function selection()
	{
		try {
			$characters = Character::all();
			$dbError = false;
		} catch (QueryException $e) {
			$characters = collect();
			$dbError = true;
		}
		return view('game.selection', compact('characters','dbError'));
	}

	public function customize()
	{
		try {
			$passives = Passive::all();
			$dbError = false;
		} catch (QueryException $e) {
			$passives = collect();
			$dbError = true;
		}
		return view('game.customize', compact('passives','dbError'));
	}

	public function story()
	{
		return view('game.story');
	}

	public function map()
	{
		return view('game.map');
	}

	// Rota temporária para rodar migrations + seed via navegador
	public function runMigrations(Request $request)
	{
		// Permitir apenas em ambiente local ou quando chave válida for fornecida
		$allowed = app()->environment('local') || config('app.debug') === true;
		$providedKey = $request->query('key', null);
		$setupKey = env('SETUP_KEY', null);

		if (!$allowed && (!$setupKey || $providedKey !== $setupKey)) {
			return redirect()->back()->with('error', 'Execução de setup bloqueada. (defina APP_ENV=local ou SETUP_KEY no .env)');
		}

		try {
			// força execução (use com cautela)
			Artisan::call('migrate', ['--force' => true]);
			Artisan::call('db:seed', ['--class' => 'PassiveSeeder', '--force' => true]);

			$msg = "Migrations e seeders executados com sucesso.";
			return redirect()->route('characters.index')->with('success', $msg);
		} catch (\Exception $e) {
			return redirect()->back()->with('error', "Erro ao rodar migrations: " . $e->getMessage());
		}
	}
}
