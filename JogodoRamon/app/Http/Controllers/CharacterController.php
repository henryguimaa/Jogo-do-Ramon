<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Illuminate\Database\QueryException;

class CharacterController extends Controller
{
    // Lista de personagens
    public function index()
    {
        try {
            $characters = Character::all();
            $dbError = false;
        } catch (QueryException $e) {
            $characters = collect();
            $dbError = true;
        }
        return view('characters.index', compact('characters','dbError'));
    }

    // Formulário de criação
    public function create()
    {
        $races = ['Humano','Demônio','Híbrido','Elfo','Anjo','Oni'];
        $classes = ['Paladino','Grappler','Cavaleiro','Mago'];
        $subclasses = [
            'Paladino' => ['Paladino Sombrio','Paladino Divino','Hammer'],
            'Grappler' => ['Berserk','Tanker','Ghost Dagger'],
            'Cavaleiro' => ['Assassino','Samurai','Great Sword'],
            'Mago' => ['Bardo','Necromante','Elemental','Invocador'],
        ];
        $elements = ['neutral','fire','water','earth','wind','dark','light'];

        return view('characters.create', compact('races','classes','subclasses','elements'));
    }

    // Salvar novo personagem
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'race' => 'required|string|max:100',
            'char_class' => 'required|string|max:100',
            'subclass' => 'nullable|string|max:100',
        ]);

        try {
            $character = Character::create([
                'name' => $request->input('name'),
                'race' => $request->input('race'),
                'char_class' => $request->input('char_class'),
                'subclass' => $request->input('subclass'),
                'hp' => 100,
                'atk' => 10,
                'def' => 5,
                'spd' => 5,
                'element' => $request->input('element', 'neutral'),
            ]);
        } catch (QueryException $e) {
            $code = $e->getCode();
            if (strpos($code, '42S02') !== false || $code === '42S02') {
                $msg = "Tabela 'characters' não encontrada. Rode: php artisan migrate";
            } else {
                $msg = "Erro ao salvar personagem: " . $e->getMessage();
            }
            return redirect()->back()->withInput()->with('error', $msg);
        }

        // 🔥 Depois de criar → vai direto para a ficha
        return redirect()
            ->route('characters.show', $character->id)
            ->with('success', 'Personagem criado com sucesso!');
    }

    // Mostrar ficha do personagem
    public function show($id)
    {
        $character = Character::findOrFail($id);
        return view('characters.show', compact('character'));
    }

    // Formulário de edição
    public function edit($id)
    {
        $character = Character::findOrFail($id);

        $races = ['Humano','Demônio','Híbrido','Elfo','Anjo','Oni'];
        $classes = ['Paladino','Grappler','Cavaleiro','Mago'];
        $subclasses = [
            'Paladino' => ['Paladino Sombrio','Paladino Divino','Hammer'],
            'Grappler' => ['Berserk','Tanker','Ghost Dagger'],
            'Cavaleiro' => ['Assassino','Samurai','Great Sword'],
            'Mago' => ['Bardo','Necromante','Elemental','Invocador'],
        ];
        $elements = ['neutral','fire','water','earth','wind','dark','light'];

        return view('characters.edit', compact('character','races','classes','subclasses','elements'));
    }

    // Atualizar personagem
    public function update(Request $request, $id)
    {
        $character = Character::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'race' => 'required|string|max:100',
            'char_class' => 'required|string|max:100',
            'subclass' => 'nullable|string|max:100',
        ]);

        $character->update($request->only([
            'name','race','char_class','subclass','element'
        ]));

        return redirect()
            ->route('characters.index')
            ->with('success', 'Personagem atualizado.');
    }

    // Excluir personagem
    public function destroy($id)
    {
        $character = Character::findOrFail($id);
        $character->delete();

        return redirect()
            ->route('characters.index')
            ->with('success', 'Personagem excluído.');
    }

    // Função simples de batalha (demo)
    public function battle(Request $request, $id)
    {
        $character = Character::findOrFail($id);

        $boss = [
            'name' => 'Nazaroth (Corrompido)',
            'hp' => 1000,
            'atk' => 40,
            'def' => 20,
            'element' => 'dark',
        ];

        $charDamage = max(0, $character->atk - $boss['def']);
        $bossDamage = max(0, $boss['atk'] - $character->def);

        return response()->json([
            'character' => $character->only(['id','name','hp','atk','def','spd','element']),
            'boss' => $boss,
            'turn_result' => [
                'to_boss' => $charDamage,
                'to_character' => $bossDamage,
            ],
        ]);
    }
}
