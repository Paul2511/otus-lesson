<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Word;
use App\Services\Dictionaries\DictionaryDestroyService;
use App\Services\Dictionaries\DictionaryStoreService;
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
            ->orderByDesc('id')
            ->paginate(10);

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        DictionaryStoreService::store($request->name, Auth::id());

        return redirect(route('dictionaries.index'));
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
            ->paginate(10);

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Dictionary $dictionary)
    {
        DictionaryDestroyService::destroyDictionaryWithRelations($dictionary);

        return redirect(route('dictionaries.index'));
    }
}
