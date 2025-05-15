<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Word;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Word::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function getWordById(string $id)
    {
        // Regresamos la palabra con sus respuestas
        $word = Word::with('responses')->find($id);

        $playerId = Auth::check() ? Auth::user()->id : null;

        DB::table('logs')->insert([
        'word_id' => $word->id,
        'registered_at' => now(),
        'event' => 'GET',
        'user_id' => $playerId,
        ]);

        if (!$word) {
            return response()->json(['message' => 'Word Pingas'], 404);
        }

        return response()->json($word, 200);
    }

    public function getWords(int $categoryId, int $wordsCount, string $order = 'asc')
    {

        // Validamos el parametro
        if (!in_array(strtolower($order), ['asc', 'desc'])) {
            return response()->json(['message' => 'Invalid order parameter. Use "asc" or "desc".'], 400);
        }

        //Obtencion
        $words = Word::with('responses')
        ->where('category_id', $categoryId)
        ->orderBy('id', $order) 
        ->take($wordsCount)
        ->get();

        // Si hay palabras
        if ($words->isEmpty()) {
            return response()->json(['message' => 'No words found'], 404);
        }

        return response()->json($words, 200);
    }

    public function verifyResponse(Request $request, string $wordId)
    {
        // validamos el request
        $request->validate([
            'response_id' => 'required|integer',
        ]);

        // regresamos la palabra con sus respuestas
        $word = Word::with('responses')->find($wordId);

        // checamos si la palabra existe
        if (!$word) {
            return response()->json(['message' => 'Word not found'], 404);
        }

        // buscamos la respuesta
        $response = $word->responses->find($request->response_id);

        // Chequeamos si la respuesta existe y si es correcta
        if (!$response) {
            return response()->json(['message' => 'Response not found'], 404);
        }
        if ($response->is_correct) {
            return response()->json(['message' => 'Correct response'], 200);
        }

        return response()->json(['message' => 'Incorrect response'], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
