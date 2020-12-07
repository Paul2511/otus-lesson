<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DictionaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $dictionaries = Dictionary::with('words')
            ->get();

        return view('dictionaries')->with('dictionaries', $dictionaries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $dictionary = new Dictionary();
        $dictionary->name = $request->name;
        $dictionary->user_id = Auth::id();
        $dictionary->save();

        return response()->json([
            'status' => 'ok',
            'id'     => $dictionary->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Dictionary $dictionary
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Dictionary $dictionary)
    {
        $words = Word::where('dictionary_id', $dictionary->id)
            ->with('contexts')
            ->paginate(5);

        return view('dictionary')->with([
            'dictionary' => $dictionary,
            'words'      => $words
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Dictionary $dictionary
     * @return \Illuminate\Http\Response
     */
    public function edit(Dictionary $dictionary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dictionary $dictionary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dictionary $dictionary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Dictionary $dictionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dictionary $dictionary)
    {
        $words = Word::where('dictionary_id', $dictionary->id)
            ->with('contexts')
            ->get();

        foreach ($words as $word) {
            $word->contexts()->delete();
        }

        Word::where('dictionary_id', $dictionary->id)
            ->delete();

        $dictionary->delete();

        return 'Dictionary ' . $dictionary->id . ' with all words and contexts has been successfully deleted';
    }
}
