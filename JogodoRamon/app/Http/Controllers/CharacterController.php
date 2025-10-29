<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Passive;
use Illuminate\Database\QueryException;

class CharacterController extends Controller
{
    // Display a listing of the characters
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

    // Show the form for creating a new character
    public function create()
    {
        // opções baseadas no texto que você forneceu
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

    // Store a newly created character in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'race' => 'required|string|max:100',
            'char_class' => 'required|string|max:100',
            'subclass' => 'nullable|string|max:100',
            'passive' => 'nullable|string|max:255',
        ]);

        try {
            Character::create([
                'name' => $request->input('name'),
                'race' => $request->input('race'),
                'char_class' => $request->input('char_class'),
                'subclass' => $request->input('subclass'),
                'passive' => $request->input('passive'),
                // valores padrão mínimos
                'hp' => 100,
                'atk' => 10,
                'def' => 5,
                'spd' => 5,
                'element' => $request->input('element', 'neutral'),
            ]);
        } catch (QueryException $e) {
            // SQLSTATE 42S02 = Base table or view not found
            $code = $e->getCode();
            if (strpos($code, '42S02') !== false || $code === '42S02') {
                $msg = "Tabela 'characters' não encontrada. Rode no terminal do projeto: php artisan migrate";
            } else {
                $msg = "Erro ao salvar personagem: " . $e->getMessage();
            }
            return redirect()->back()->withInput()->with('error', $msg);
        }

        return redirect()->route('characters.index')->with('success', 'Personagem criado com sucesso!');
    }

    // Display the specified character
    public function show($id)
    {
        $character = Character::with('passive')->findOrFail($id);
        return view('characters.show', compact('character')); // view show pode ser criada depois
    }

    // Show the form for editing the specified character
    public function edit($id)
    {
        $character = Character::findOrFail($id);

        // mesmas opções para o formulário de edição
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

    // Update the specified character in storage
    public function update(Request $request, $id)
    {
        $character = Character::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'race' => 'required|string|max:100',
            'char_class' => 'required|string|max:100',
            'subclass' => 'nullable|string|max:100',
            'passive' => 'nullable|string|max:255',
        ]);

        $character->update($request->only(['name','race','char_class','subclass','passive','element']));

        return redirect()->route('characters.index')->with('success', 'Personagem atualizado.');
    }

    // Remove the specified character from storage
    public function destroy($id)
    {
        $character = Character::findOrFail($id);
        $character->delete();
        return redirect()->route('characters.index')->with('success', 'Personagem excluído.');
    }

    // Assign a passive to a character (by passive id)
    public function assignPassive(Request $request, $id)
    {
        $character = Character::findOrFail($id);
        $request->validate(['passive_id' => 'nullable|exists:passives,id']);
        $character->passive_id = $request->input('passive_id');
        $character->save();
        return redirect()->route('characters.show', $character->id)->with('success', 'Passiva atribuída.');
    }

    // Simple battle stub between character and a boss (returns basic json)
    public function battle(Request $request, $id)
    {
        $character = Character::with('passive')->findOrFail($id);

        // boss básico (final boss stub)
        $boss = [
            'name' => 'Nazaroth (Corrompido)',
            'hp' => 1000,
            'atk' => 40,
            'def' => 20,
            'element' => 'dark',
        ];

        // Simples cálculo de dano de um turno para fins de demo
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
