<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
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

        return view('game.selection', compact('characters', 'dbError'));
    }

    public function customize()
    {
        return view('game.customize');
    }

    // 🔥 História agora recebe o personagem escolhido
    public function story($id)
    {
        $character = Character::findOrFail($id);
        return view('game.story', compact('character'));
    }

    // 🔥 Mapa também recebe o personagem
    public function map($id)
    {
        $character = Character::findOrFail($id);
        return view('game.map', compact('character'));
    }

    // Rota de setup (migration)
    public function runMigrations(Request $request)
    {
        $allowed = app()->environment('local') || config('app.debug') === true;
        $providedKey = $request->query('key', null);
        $setupKey = env('SETUP_KEY', null);

        if (!$allowed && (!$setupKey || $providedKey !== $setupKey)) {
            return redirect()->back()->with('error', 'Execução de setup bloqueada.');
        }

        try {
            Artisan::call('migrate', ['--force' => true]);

            return redirect()->route('characters.index')->with('success', "Migrations executadas com sucesso.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Erro ao rodar migrations: " . $e->getMessage());
        }
    }
}
