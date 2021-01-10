<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Word;
use App\Services\Contexts\ContextStoreService;
use App\Services\Dictionaries\Providers\Routes;
use App\Services\Words\WordDestroyService;
use App\Services\Words\WordStoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WordController extends Controller
{
    private $wordDestroyService;
    private $wordStoreService;
    private $contextStoreService;

    public function __construct(
        WordDestroyService $wordDestroyService,
        WordStoreService $wordStoreService,
        ContextStoreService $contextStoreService
    )
    {
        $this->wordDestroyService = $wordDestroyService;
        $this->wordStoreService = $wordStoreService;
        $this->contextStoreService = $contextStoreService;

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $dictionary = Dictionary::findOrFail($request->dictionary_id);

        if (!Gate::allows('store-word', $dictionary)) {
            abort(403);
        }

        // Добавим слово
        $word_id = $this->wordStoreService->store($dictionary->id, $request->value, $request->translation);

        // Добавим контекст использования слова
        if ($word_id) {
            $this->contextStoreService->store($word_id, '', $request->context, '');
        }

        return redirect(route(Routes::DICTIONARIES_SHOW, [$dictionary->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Word $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Word $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Word $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Word $word
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Word $word)
    {
        $dictionary = Dictionary::findOrFail($word->dictionary_id);

        if (!Gate::allows('destroy-word', $dictionary)) {
            abort(403);
        }

        $this->wordDestroyService->destroyWithRelations($word);

        return redirect(route(Routes::DICTIONARIES_SHOW, [$dictionary->id]));
    }
}
