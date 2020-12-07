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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
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

        return response()->json([
            'status' => 'ok',
            'id'     => $word->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        Context::where('word_id',$word->id)
            ->delete();
        $word->delete();

        return 'Word ' . $word->id . ' with all contexts has been successfully deleted';
    }
}
