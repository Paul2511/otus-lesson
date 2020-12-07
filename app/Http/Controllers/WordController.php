<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\Context;
use Illuminate\Http\Request;

class WordController extends Controller
{
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
        $word = new Word();
        $word->dictionary_id = $request->dictionary_id;
        $word->value = $request->value;
        $word->translation = $request->translation;
        $word->save();

        $context = new Context();
        $context->word_id = $word->id;
        $context->value = $request->context;
        $context->prefix = '';
        $context->postfix = '';
        $context->save();

        return redirect(route('dictionaries.show', [$request->dictionary_id]));
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
        Context::where('word_id', $word->id)
            ->delete();

        $dictionary_id = $word->dictionary_id;

        $word->delete();

        return redirect(route('dictionaries.show', [$dictionary_id]));
    }
}
