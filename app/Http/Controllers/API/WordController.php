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
        // Retrieve the word by ID along with its responses
        $word = Word::with('responses')->find($id);

        // Check if the word exists
        if (!$word) {
            return response()->json(['message' => 'Word Pingas'], 404);
        }

        return response()->json($word, 200);
    }

    public function getWords(string $categoryId, int $wordsCount)
    {

        $words = Word::with('responses')
        ->where('category_id', $categoryId)
        ->inRandomOrder()
        ->take($wordsCount)
        ->get();

        // Check if the words exist
        if ($words->isEmpty()) {
            return response()->json(['message' => 'No words found'], 404);
        }

        return response()->json($words, 200);
    }

    public function verifyResponse(Request $request, string $wordId)
    {
        // Validate the incoming request
        $request->validate([
            'response_id' => 'required|integer',
        ]);

        // Retrieve the word along with its responses
        $word = Word::with('responses')->find($wordId);

        // Check if the word exists
        if (!$word) {
            return response()->json(['message' => 'Word not found'], 404);
        }

        // Find the response by ID
        $response = $word->responses->find($request->response_id);

        // Check if the response exists
        if (!$response) {
            return response()->json(['message' => 'Response not found'], 404);
        }

        // Check if the response is correct
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
